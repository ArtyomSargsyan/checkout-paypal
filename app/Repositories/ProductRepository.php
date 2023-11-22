<?php

namespace App\Repositories;
use App\Models\Product;


class ProductRepository implements ProductRepositoryInterface {

    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @return mixed
     */
    public function getAllProduct(): mixed
    {
        return $this->product->get();
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getProductById($id): mixed
    {
        return Product::findOrFail($id);
    }

}
