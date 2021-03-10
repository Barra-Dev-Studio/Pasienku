<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'billing_id',
        'prescription_id',
        'price',
        'discount'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function prescription()
    {
        return $this->belongsTo(Prescription::class);
    }
}
