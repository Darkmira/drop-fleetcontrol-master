<?php

namespace Drop\FleetControl;

use PhpAmqpLib\Channel\AMQPChannel;
use PhpAmqpLib\Message\AMQPMessage;

class OrderPusher
{
    /**
     * @var string
     */
    private $exchangeName;

    /**
     * @var AMQPChannel
     */
    private $channel;

    /**
     * @param string $exchangeName
     * @param AMQPChannel $channel
     */
    public function __construct($exchangeName, $channel)
    {
        $this->exchangeName = $exchangeName;
        $this->channel = $channel;
    }

    /**
     * @param string $color
     * @param string $order
     */
    public function publishOrder($color, $order)
    {
        $message = new AMQPMessage($order);

        $this->channel->basic_publish($message, $this->exchangeName, $color);
    }
}
