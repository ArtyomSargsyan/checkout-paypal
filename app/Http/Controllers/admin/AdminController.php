<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Services\AdminService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;


class AdminController extends Controller
{

    protected AdminService $adminService;

    /**
     * @param AdminService $adminService
     */
    public function  __construct(AdminService $adminService)
    {
        $this->middleware('auth');

        $this->adminService = $adminService;
    }


    /**
     * @return Application|Factory|View
     */
    public function checkout(): View|Factory|Application
    {
        $orders = $this->adminService->getAll();

        return view('admin.checkout')->with([
            'orders' => $orders
        ]);
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function delete($id): RedirectResponse
    {
        $this->adminService->deleteById($id);
        return redirect()->back();
    }

}
