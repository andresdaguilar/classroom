<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = ['classroom_id', 'start_time', 'end_time', 'attendees'];

    public function classroom()
    {
        return $this->belongsTo(Classroom::class);
    }
}