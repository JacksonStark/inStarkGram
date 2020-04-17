<?php

namespace App\Http\Controllers;

use App\Orders\OrderDetails;
use Illuminate\Http\Request;
use App\Billing\PaymentGatewayContract;

class PayOrderController extends Controller
{
    public function store(OrderDetails $orderDetails, PaymentGatewayContract $paymentGateway)
    {

      $order = $orderDetails->all();

      dd($paymentGateway->charge(25000));
    }
}
