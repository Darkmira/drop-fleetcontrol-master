<?php

namespace Drop\FleetControl;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;

class OrderController
{
    /**
     * @var OrderPusher
     */
    private $orderPusher;

    /**
     * @param OrderPusher $orderPusher
     */
    public function __construct($orderPusher)
    {
        $this->orderPusher = $orderPusher;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function postMultiple(Request $request)
    {
        $orders = json_decode($request->getContent());

        foreach ($orders as $order) {
            $this->orderPusher->publishOrder($order->color, $order->order);
        }

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @param string $color
     * @param string $order
     *
     * @return JsonResponse
     */
    public function postSingle($color, $order)
    {
        $this->orderPusher->publishOrder($color, $order);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);
    }
}
