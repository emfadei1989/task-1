<?php

namespace App\Listeners;

use App\Events\OrderUpdated;
use App\OrderHistory;


class SaveOrderUpdatedState
{
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
        $originalFields = $event->order->getOriginal();
        $originalFields['order_id'] = $originalFields['id'];
        $orderHistory = OrderHistory::create($originalFields);
    }
}
