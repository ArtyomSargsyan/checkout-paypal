<?php

namespace  App\Repositories;


interface ProductRepositoryInterface
{
    public function getAllProduct();
    public function getProductById($id);
}
