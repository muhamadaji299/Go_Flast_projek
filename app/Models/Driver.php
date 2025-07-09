<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $fillable = ['name','photo','telepon','email','location','description','vehicle_type'];
}
