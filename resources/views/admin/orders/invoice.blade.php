<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>
</head>

<body>

    <h1>Invoice</h1>
    <p>Order Number: {{ $order->id }}</p>
    <p>Customer Name: {{ $order->user->name }}</p>
    <p>Order Date: {{ $order->created_at }}</p>
    <p>Total Amount: {{ $order->total_amount }}</p>
    <p>Status: {{ $order->status }}</p>
    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    {{ optional($item)->quantity }}
                    <td>{{ $item->price }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
