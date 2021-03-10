<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Billing extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'total_price',
        'discount',
        'total_payment'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function detail()
    {
        return $this->hasMany(BillingDetail::class);
    }
}
