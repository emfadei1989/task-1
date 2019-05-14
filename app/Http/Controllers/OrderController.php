<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrder;
use App\Order;
use App\Partner;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     *
     */
    public function index()
    {
        $order = new Order();
        $overdueOrders = $order->overdueOrders()->paginate(50);
        $currentOrders = $order->currentOrders()->paginate(50);
        $newOrders = $order->newOrders()->paginate(50);
        $completedOrders = $order->completedOrders()->paginate(50);

        $orders = compact('overdueOrders', 'currentOrders', 'newOrders', 'completedOrders');

        array_map(function ($item) use ($order) {
            return $order->convertStatusToString($item);
        }, $orders);

        return view('orders.index_updated', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Order $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        $partners = Partner::all();
        $histories = $order->orderHistories;
        $statuses = Order::STATUS;
        if (!empty($histories)) {
            $histories->map(function ($item) use ($statuses) {
                if (isset($statuses[$item->status])) {
                    $item->status = $statuses[$item->status];
                }

            });
        }

        return view('orders.edit', compact('order', 'partners', 'statuses', 'histories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrder $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreOrder $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(request(['client_email', 'partner_id', 'status']));

        return redirect('/orders');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
