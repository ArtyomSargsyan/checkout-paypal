<?php

namespace App\Services;

use App\Repositories\OrderRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class AdminService
{

    protected OrderRepository $orderRepository;

    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @return mixed
     */
    public function getAll(): mixed
    {
        return $this->orderRepository->getAllOrder();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function deleteById($id): mixed
    {
        return $this->orderRepository->delete($id);
    }
}
