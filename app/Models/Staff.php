<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'name',
        'father_name',
        'email',
        'dob',
        'aadhar_number',
        'phone_number',
        'gender',
        'image'
    ];

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }
}
