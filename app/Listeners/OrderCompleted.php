<?php
/**
 * Created by PhpStorm.
 * User: f.emelyanov
 * Date: 13.05.2019
 * Time: 11:38
 */

namespace App\Listeners;


use App\Events\OrderUpdated;
use App\Notifications\OrderCompleted as OrderCompletedNotification;
use App\Order;
use Illuminate\Support\Facades\Notification;

class OrderCompleted
{
    /**
     * @var Order
     */
    protected $order;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderUpdated  $event
     * @return void
     */
    public function handle(OrderUpdated $event)
    {
        $this->order = $event->order;
        $status = $this->order->status;

        if($status == 20){
            $partner = $this->order->partner;

            $vendors = $this->order->orderProducts->map(function ($item){
               return $item->product->vendor;
            });

            $partner->notify(new OrderCompletedNotification($this->order));
            Notification::send($vendors, new OrderCompletedNotification($this->order));
        }

    }
}