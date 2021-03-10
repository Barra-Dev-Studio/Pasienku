<?php

namespace App\Services;

use App\Models\Billing;
use Illuminate\Http\Request;

class BillingService
{
    public function store(Request $request)
    {
        return Billing::create(
            [
                'registration_id' => $request->registration_id,
                'total_price' => $request->total_price,
                'discount' => $request->discount,
                'total_payment' => $request->total_payment,
            ]
        );
    }

    public function storeByRegistrationId($registrationId)
    {
        return Billing::create(
            [
                'registration_id' => $registrationId,
                'total_price' => 0,
                'discount' => 0,
                'total_payment' => 0,
            ]
        );
    }
}
