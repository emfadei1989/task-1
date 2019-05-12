@extends('layouts.app')

@section('content')
    <div class="product_list">
        <div class="container">
            <h1>Товары</h1>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col"></th>

                    <th scope="col">ID</th>
                    <th scope="col">Наименование</th>
                    <th scope="col">Поставщик</th>
                    <th scope="col">Цена</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    @forelse($products as $product)
                        <th scope="row">
                            <div class="dropdown">
                                <button type="button" class="btn btn-toolbar dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                </button>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Редактировать</a></li>
                                </ul>
                            </div>


                        </th>
                        <th scope="row">{{$product->id}}</th>
                        <td>{{$product->name}}</td>
                        <td>{{$product->vendor->name}}</td>
                        <td>{{$product->price}}</td>

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
                            {{$products->links()}}
                        </ul>
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection