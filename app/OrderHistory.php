<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $fillable = ['client_email', 'partner_id', 'status', 'order_id', 'delivery_dt'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }
}
