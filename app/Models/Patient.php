<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Patient extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $searchable = [
        'name', 'identification_number'
    ];

    protected $fillable = [
        'name', 'identification_number', 'address', 'birthdate', 'gender', 'contact'
    ];

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }
}
