<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockOut extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'registration_id',
        'item_id',
        'total'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
