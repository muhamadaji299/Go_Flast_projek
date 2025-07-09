<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
   protected $fillable = ['user_id','nama','alamat','metode_pembayaran','detail_pembayaran','status'];

     public function user(){
        return $this->belongsTo(User::class);
    }
}
