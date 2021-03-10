<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Registration extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'patient_id', 'registration_number', 'diagnosis', 'status'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function diagnose()
    {
        return $this->hasOne(Diagnosis::class, 'registration_id', 'id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'registration_id', 'id');
    }
}
