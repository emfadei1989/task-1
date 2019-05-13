
<h2>Заказ № {{$order->id}} завершен</h2>

<h3>Соствав заказа</h3>

<table>
    <tr>
        <th>Наименование</th>
        <th>Кол-во</th>
        <th>Стоимость</th>

    </tr>
    @foreach($order->orderProducts as $orderProduct)
        <tr>
            <td>{{$orderProduct->product->name}}</td>
            <td>{{$orderProduct->quantity}}</td>
            <td>{{$orderProduct->price}}</td>
        </tr>
        @endforeach

<h3>Стоимость заказа: {{$order->orderProducts->sum('price')}} руб.</h3>
</table>