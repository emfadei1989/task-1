@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="title">Редактирование заказа</h1>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{route('orders.update',$order->id)}}" class="form-horizontal">
            {{ csrf_field() }}
            {{method_field('patch')}}

            <div class="form-group row">
                <label for="clientEmail" class="col-sm-2 control-label">Email</label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" id="clientEmail" name="client_email"
                           value="{{$order->client_email}}">
                </div>
            </div>
            <div class="form-group row">
                <label for="partner" class="col-sm-2 control-label">Партнер</label>
                <div class="col-sm-10">

                    <select class="form-control" name="partner_id" id="partner">
                        @foreach ($partners as $partner)
                            <option {{$order->partner_id == $partner->id ? 'selected' : ''}} value="{{$partner->id}}">{{$partner->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="status" class="col-sm-2 control-label">Статус</label>
                <div class="col-sm-10">

                    <select class="form-control" name="status" id="status">
                        @foreach ($statuses as $key => $status)
                            <option {{$order->status == $key ? 'selected' : ''}} value="{{$key}}">{{$status}}</option>
                        @endforeach
                    </select>
                </div>
            </div>


            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Обновить заказ</button>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-sm-6">
                <h2>
                    Товары в заказе
                </h2>
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">Наименование</th>
                        <th scope="col">Кол-во</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($order->orderProducts as $orderProducts)
                        <tr>
                            <th scope="row">{{$orderProducts->product->name}}</th>
                            <td>{{$orderProducts->quantity}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-sm-6">
                <h2>Товаров на сумму: {{$order->orderProducts->sum('price')}} руб.</h2>

            </div>


        </div>

    <div>
        <h2>История заказа</h2>

        <table class="table table-sm">
            <thead>
            <tr>
                <th scope="col">Дата изменения</th>
                <th scope="col">Email покупателя</th>
                <th scope="col">Статус</th>
            </tr>
            </thead>
            <tbody>
            @foreach($histories as $history)
                <tr>
                    <td>{{$history->created_at}}</td>
                    <td>{{$history->client_email}}</td>
                    <td>{{$history->status}}</td>

                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

@endsection