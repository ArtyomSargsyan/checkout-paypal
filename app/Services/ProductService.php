<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;


class ProductService
{
    /**
     * @var ProductRepository
     */
    protected ProductRepository $productRepository;


    /**
     * @param ProductRepository $productRepository
     */
    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }


    /**
     * @return mixed
     */
    public function getAll()
    {
        return $this->productRepository->getAllProduct();
    }

    /**
     * @param $id
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function getProductById($id)
    {
        $product = $this->productRepository->getProductById($id);

        $cart = session()->get('cart', []);

        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image,
                'id' => $product->id
            ];
        }

        return session()->put('cart', $cart);
    }

    /**
     * @param int $id
     * @param int $quantity
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function update( int $id, int $quantity)
    {
        if($id && $quantity){
            $cart = session()->get('cart');
            $cart[$id]["quantity"] = $quantity;
            session()->put('cart', $cart);
            session()->flash('success', 'Cart updated successfully');
        }
    }


    /**
     * @param $id
     * @return void
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    public function delete($id)
    {
        if($id) {
            $cart = session()->get('cart');
            if(isset($cart[$id])) {
                unset($cart[$id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product removed successfully');
        }
    }



}
