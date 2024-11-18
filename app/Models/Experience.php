<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id',
        'cadre_id',
        'office_id',
        'subject_id',
        'joining_date',
        'relieving_date'
    ];

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function cadre()
    {
        return $this->belongsTo(Cadre::class);
    }

    public function office()
    {
        return $this->belongsTo(Office::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
