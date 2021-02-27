<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name', 'identification_number', 'address', 'birthdate', 'gender'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
