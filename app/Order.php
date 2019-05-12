<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завешен'
    ];

   protected $fillable = ['client_email','partner_id', 'status'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function orderProducts(){
        return $this->hasMany('App\OrderProduct');
    }
}
