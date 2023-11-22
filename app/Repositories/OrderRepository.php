<?php

namespace App\Repositories;
use App\Models\Order;


class OrderRepository  implements  OrderRepositoryInterface {

    /**
     * @var Order
     */
    protected Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * @return mixed
     */
    public function getAllOrder(): mixed
    {
        return $this->order->get();
    }

    /**
     * @param  $price
     * @param  $name
     * @param  $email
     * @return void
     */
    public function save($price, $name, $email)
    {
        $order = new $this->order;
        $order->price  = $price;
        $order->name = $name;
        $order->email = $email;
        $order->save();
    }

    /**
     * @param  $id
     * @return mixed
     */
    public function delete($id): mixed
    {
        $order = $this->order->find($id);
        return  $order->delete();
    }
}
