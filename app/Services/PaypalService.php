<?php

namespace App\Services;
use Illuminate\Support\Facades\Redirect;
use App\Repositories\OrderRepository;

use Psr\Http\Message\StreamInterface;
use Srmklive\PayPal\Services\PayPal as PayPalClient;


class PaypalService
{

    protected OrderRepository $orderRepository;

    /**
     * @param OrderRepository $orderRepository
     */
    public function __construct(OrderRepository $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }

    /**
     * @param int $price
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function handleCheck(int $price): StreamInterface|array|string
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        return $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('success.payment'),
                "cancel_url" => route('cancel.payment'),
            ],
            "purchase_units" => [
                0 => [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $price
                    ]
                ]
            ]
        ]);
    }


    /**
     * @throws \Throwable
     */
    public function paySuccess($request): StreamInterface|array|string
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $provider->getAccessToken();

        return $provider->capturePaymentOrder($request['token']);

    }
}
