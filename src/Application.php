<?php

namespace Drop\FleetControl;

use PhpAmqpLib\Connection\AMQPStreamConnection;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Application as SilexApplication;
use Drop\FleetControl\OrderController;

class Application extends SilexApplication
{
    /**
     * {@InheritDoc}
     */
    public function __construct(array $values = array())
    {
        parent::__construct($values);

        $this->register(new ServiceControllerServiceProvider());

        $this['app.order_pusher'] = function () {
            $connection = new AMQPStreamConnection(
                getenv('RABBITMQ_HOST'),
                getenv('RABBITMQ_PORT'),
                getenv('RABBITMQ_USER'),
                getenv('RABBITMQ_PASS')
            );

            $channel = $connection->channel();
            $channel->exchange_declare(getenv('RABBITMQ_EXCHANGE'), 'direct');

            return new OrderPusher(getenv('RABBITMQ_EXCHANGE'), $channel);
        };

        $this['app.controllers.order'] = function () {
            return new OrderController($this['app.order_pusher']);
        };

        $this->post('/orders', 'app.controllers.order:postMultiple');
        $this->post('/orders/{color}/{order}', 'app.controllers.order:postSingle');
    }
}
