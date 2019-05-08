@extends('layouts.app')

@section('content')
    <section class="order_list">
        <div class="order_list">
            <div class="container">
                <h1>Заказы</h1>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col"></th>

                        <th scope="col">ID</th>
                        <th scope="col">Партнер</th>
                        <th scope="col">Стоимость</th>
                        <th scope="col">Состав заказа</th>
                        <th scope="col">Статус</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @forelse($orders as $order)
                            <th scope="row">
                                <div class="dropdown">
                                    <button type="button" class="btn btn-toolbar dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="#">Action</a></li>
                                        <li><a href="#">Another action</a></li>
                                        <li><a href="#">Something else here</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">Separated link</a></li>
                                    </ul>
                                </div>


                            </th>
                        <th scope="row">{{$order->id}}</th>
                        <td>{{$order->partner->name}}</td>
                        <td>{{$order->orderProducts->sum('price')}}</td>
                        <td>

                            {{$order->orderProducts->implode('product.name',', ')}}


                        </td>
                        <td>{{$order->status}}</td>

                    </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">
                                Данные отсутствуют
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="5">
                            <ul class="pagination pull-right">
                                {{$orders->links()}}
                            </ul>
                        </td>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </section>

@endsection