<?php

namespace App;

use App\Events\OrderUpdated;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    const STATUS = [
        0 => 'Новый',
        10 => 'Подтвержден',
        20 => 'Завешен',
    ];

    protected $dispatchesEvents = [
        'updated' => OrderUpdated::class,
    ];

    protected $fillable = ['client_email', 'partner_id', 'status'];

    public function partner()
    {
        return $this->belongsTo('App\Partner');
    }

    public function orderProducts()
    {
        return $this->hasMany('App\OrderProduct');
    }

    public function orderHistories()
    {
        return $this->hasMany('App\OrderHistory');
    }

    public function overdueOrders(): Builder
    {
        $now = date('Y-m-d H:m:s');

        return $this->where('delivery_dt', '<', $now)
            ->where('status', '=', 10)
            ->orderBy('delivery_dt', 'desc');
    }

    public function currentOrders(): Builder
    {
        $from = Carbon::now()->format('Y-m-d H:m:s');
        $to = Carbon::now()->addDay(1)->format('Y-m-d H:m:s');

        return $this->whereBetween('delivery_dt', [$from, $to])
            ->where('status', '=', 10)
            ->orderBy('delivery_dt', 'asc');
    }

    public function newOrders(): Builder
    {
        $now = date('Y-m-d H:m:s');

        return $this->where('delivery_dt', '>', $now)
            ->where('status', '=', 0)
            ->orderBy('delivery_dt', 'asc');
    }

    public function completedOrders(): Builder
    {
        $from = Carbon::today()->format('Y-m-d H:m:s');
        $to = Carbon::today()->addDay(1)->format('Y-m-d H:m:s');

        return $this->whereBetween('delivery_dt', [$from, $to])
            ->where('status', '=', 20)
            ->orderBy('delivery_dt', 'desc');
    }

    public function convertStatusToString($orders)
    {
        $statuses = self::STATUS;

        return $orders->map(function ($item) use ($statuses) {
            if (isset($statuses[$item->status])) {
                $item->status = $statuses[$item->status];
            }
        });
    }
}
