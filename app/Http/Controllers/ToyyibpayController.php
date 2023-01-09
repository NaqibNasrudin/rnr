<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ToyyibpayController extends Controller
{
    public function createbill($price) {
        $total = $price*100;
        $option = array(
            'userSecretKey'=>'722r7f8p-zpx3-woka-ws4t-eokz2iqltms2',
            'categoryCode'=>'u0m5wx8h',
            'billName'=>'Rental Service Booking',
            'billDescription'=>'Booking',
            'billPriceSetting'=>1,
            'billPayorInfo'=>1,
            'billAmount'=>$total,
            'billReturnUrl'=>route (name:'home'),
            'billCallbackUrl'=>'http://bizapp.my/paystatus',
            'billExternalReferenceNo' => 'AFR341DFI',
            'billTo'=>'John Doe',
            'billEmail'=>'jd@gmail.com',
            'billPhone'=>'0194342411',
            'billSplitPayment'=>0,
            'billSplitPaymentArgs'=>'',
            'billPaymentChannel'=>0,
            'billContentEmail'=>'Thank you for purchasing our product!',
            'billChargeToCustomer'=>1,
            'billExpiryDays'=>2,
          );

          $url = 'https://dev.toyyibpay.com/index.php/api/createBill';
          $response = Http::asForm()->post($url, $option);
          $billcode = $response[0]['BillCode'];
          return redirect(to:'https://dev.toyyibpay.com/'.$billcode );
    }

    public function paymentstatus(){

    }

    public function callback(){

    }
}
