<!DOCTYPE html>
<html>
<head>
    <title>Order Confirmation</title>
</head>
<body>
    <h1>Order Confirmation</h1>
    <p>Thank you for your order. Here are the details:</p>
    <p><strong>Order ID:</strong> {{ $order->id }}</p>
    <p><strong>Name:</strong> {{ $order->name }}</p>
    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Mobile:</strong> {{ $order->mobile }}</p>
    <p><strong>Address:</strong> {{ $order->address_title }}</p>
    <p><strong>Subtotal:</strong> {{ $order->subtotal }}</p>
    <p><strong>Delivery Cost:</strong> {{ $order->delivery_cost }}</p>
    <p><strong>Grand Total:</strong> {{ $order->grand_total }}</p>
    <p><strong>Payment Method:</strong> {{ $order->payment_method }}</p>
</body>
</html>