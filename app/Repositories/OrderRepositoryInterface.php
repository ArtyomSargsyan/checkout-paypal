<?php

namespace  App\Repositories;

interface OrderRepositoryInterface
{
    public function getAllOrder();
    public function save($price, $name, $email);
    public function delete($id);
}
