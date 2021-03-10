<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;
    protected $fillable = [
        'registration_id', 'item_id', 'name', 'use', 'when', 'total'
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
