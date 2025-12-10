<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>
    <style>
        body { font-family: Arial, sans-serif; background:#fff; }
        .invoice { width:800px;margin:auto; }
        .header { text-align:center;margin-bottom:30px; }
        table { width:100%; border-collapse:collapse; }
        th,td { border:1px solid #333;padding:8px;text-align:left; }
        th { background:#f0f0f0; }
        .total { text-align:right;font-size:18px;font-weight:bold;}
        .no-print { text-align:center;margin:20px;}
        @media print {
            .no-print{display:none;}
        }
    </style>
</head>
<body>

<div class="invoice">

    <div class="header">
        <h2>EPTHAA AGRO</h2>
        <p>Veterinary & Agricultural Services</p>
        <h3>INVOICE</h3>
    </div>

    <p>
        <strong>Invoice #:</strong> {{ $order->id }} <br>
        <strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}
    </p>

    <p>
        <strong>Customer:</strong> {{ $order->customer_name }} <br>
        <strong>Phone:</strong> {{ $order->customer_phone }} <br>
        <strong>Email:</strong> {{ $order->customer_email }}
    </p>

    <table>
        <thead>
            <tr>
                <th>Item</th>
                <th width="120">Price</th>
                <th width="80">Qty</th>
                <th width="150">Subtotal</th>
            </tr>
        </thead>

        <tbody>
        @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>₦{{ number_format($item->price,2) }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₦{{ number_format($item->price * $item->quantity,2) }}</td>
            </tr>
        @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3" class="total">TOTAL</th>
                <th>₦{{ number_format($order->total,2) }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="no-print">
        <button onclick="window.print()">🖨 Print Invoice</button>
        <br><br>
        <a href="{{ route('admin.orders.show', $order) }}">← Back to order</a>
    </div>

</div>

<script>
    window.onload = () => window.print();
</script>

</body>
</html>
