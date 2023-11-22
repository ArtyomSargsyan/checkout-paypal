<?php

namespace App\Http\Controllers;


use App\Repositories\OrderRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

use App\Services\PaypalService;


class PaypalController extends Controller
{

    protected PaypalService $paypalService;
    protected OrderRepository $orderRepository;

    /**
     * @param PaypalService $paypalService
     * @param OrderRepository $orderRepository
     */
    public function __construct(PaypalService $paypalService, OrderRepository $orderRepository)
    {
        $this->paypalService = $paypalService;
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function handlePayment(Request $request): RedirectResponse
    {

        $response =  $this->paypalService->handleCheck($request->price);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $links) {
                if ($links['rel'] == 'approve') {
                    return redirect()->away($links['href']);
                }
            }
            return redirect()
                ->route('cancel.payment')
                ->with('error', 'Something went wrong.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }


    /**
     * @return RedirectResponse
     */
    public function paymentCancel()
    {
        return redirect()
            ->route('create.payment')
            ->with('error', $response['message'] ?? 'You have canceled the transaction.');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function paymentSuccess(Request $request): RedirectResponse
    {
        $response =  $this->paypalService->paySuccess($request->all());

        foreach( $response['purchase_units'] as $item)
        {
            foreach($item['payments']['captures'] as $data){
                $price = $data['amount']['value'];
            }
        }

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            $this->orderRepository->save($price, $response['payer']['name']['given_name'], $response['payer']['email_address']);

            session()->flush();

            return redirect()
                ->route('create.payment')
                ->with('success', 'Transaction complete.');
        } else {
            return redirect()
                ->route('create.payment')
                ->with('error', $response['message'] ?? 'Something went wrong.');
        }
    }
}
