<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'registration_id', 'blood_pressure', 'further_diagnosis'
    ];

    public function registration()
    {
        return $this->belongsTo(Registration::class);
    }
}
