@extends('layouts.app')

@section('content')
    <section class="order_list">
        <div class="order_list">
            <div class="container">
                <editable-field
                        initial-input-type="number"
                        initial-input-name="price"
                        initial-input-value="111111"
                        initial-url="/api/products/1"
                        initial-method="patch"
                >
                </editable-field>
                <h1>Заказы</h1>


                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#overdue">Просроченные</a></li>
                    <li><a data-toggle="tab" href="#current">Текущие</a></li>
                    <li><a data-toggle="tab" href="#new">Новые</a></li>
                    <li><a data-toggle="tab" href="#completed">Выполненные</a></li>

                </ul>

                <div class="tab-content">
                    <div id="overdue" class="tab-pane fade in active">
                        <h3>Просроченные заказы</h3>
                        @include('partials.orders.table',['orders' => $orders['overdueOrders']])
                    </div>
                    <div id="current" class="tab-pane fade">
                        <h3>Текущие заказы</h3>
                        @include('partials.orders.table',['orders' => $orders['currentOrders']])
                    </div>
                    <div id="new" class="tab-pane fade">
                        <h3>Новые заказы</h3>
                        @include('partials.orders.table',['orders' => $orders['newOrders']])
                    </div>
                    <div id="completed" class="tab-pane fade">
                        <h3>Выполненные заказы</h3>
                        @include('partials.orders.table',['orders' => $orders['completedOrders']])
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection