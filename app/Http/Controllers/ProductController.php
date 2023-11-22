<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Services\ProductService;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{

    protected ProductService $productService;

    /**
     * @param ProductService $productService
     */
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $products = $this->productService->getAll();

        return view('products', compact('products'));
    }


    /**
     * @return Application|Factory|View
     */
    public function cart(): Application|Factory|View
    {
        return view('cart');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function addToCart($id): RedirectResponse
    {

        $this->productService->getProductById($id);

        return redirect()->back()->with('success', 'Product added to cart successfully!');

    }

    /**
     * @param Request $request
     * @return void
     */
    public function update(Request $request)
    {
        $this->productService->update($request->id, $request->quantity);
    }

    /**
     * @param Request $request
     * @return void
     */
    public function remove(Request $request)
    {
        $this->productService->delete($request->id);
    }
}
