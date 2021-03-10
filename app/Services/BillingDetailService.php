<?php

namespace App\Services;

use App\Models\BillingDetail;
use Illuminate\Http\Request;
use App\Services\ItemService;

class BillingDetailService
{
    protected $itemService;

    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }

    public function store(Request $request)
    {
        return BillingDetail::create(
            [
                'billing_id' => $request->billing_id,
                'prescription_id' => $request->prescription_id,
                'price' => $request->price,
                'discount' => $request->discount,
            ]
        );
    }

    public function storeMultiple(Request $request, $prescriptionId, $index)
    {
        $price = ($request->item_id[$index] == 0) ? 0 : $this->itemService->getPrice($request->item_id[$index]);
        return BillingDetail::create(
            [
                'billing_id' => $request->billing_id,
                'prescription_id' => $prescriptionId,
                'price' => $price,
                'discount' => 0,
            ]
        );
    }

    public function delete($billingId)
    {
        return BillingDetail::where('billing_id', $billingId)->delete();
    }

    public function deleteFromRegistration(Request $request)
    {
        return BillingDetail::where('billing_id', $request->billing_id)->delete();
    }

    public function updateMultiple($request, $index)
    {
        return BillingDetail::where('id', $request->id[$index])->update(
            [
                'price' => $request->price[$index]
            ]
        );
    }
}
