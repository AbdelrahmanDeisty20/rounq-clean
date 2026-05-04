<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['name', 'phone', 'city', 'service', 'date', 'notes', 'status'];
}
