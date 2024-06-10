<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function getSnapToken(Request $request)
    {

        // return 'test';
        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Yoki',
                'last_name' => 'Ferdinand Situmorang',
                'email' => 'yokisitumorang@gmail.com',
                'phone' => '08111222333',
            ],
        ];

        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            // return $snapToken;
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
