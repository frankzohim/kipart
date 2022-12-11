<?php

namespace App\Http\Controllers\test;

use Stripe;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TestPaymentController extends Controller
{
    public function index(){

        return view('test.payments.payment');
    }

    public function paymentTest(Request $request)
    {
        dd($request->all());
    }
}
