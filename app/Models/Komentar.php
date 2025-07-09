<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Komentar extends Model
{
    protected $fillable = ['user_id','isi' ,'rating'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
