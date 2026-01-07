<!DOCTYPE html>
<html>
<head>
    <title>Invoice #{{ $order->id }}</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f9;
            margin: 0;
            padding: 20px;
        }

        .invoice {
            width: 800px;
            margin: auto;
            background: #fff;
            padding: 30px;
        }

        /* Header */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 4px solid #1e88e5;
            padding-bottom: 15px;
            margin-bottom: 30px;
        }

        .company-info h2 {
            margin: 0;
            color: #1e88e5;
        }

        .company-info p {
            margin: 4px 0;
            font-size: 13px;
            color: #555;
        }

        .company-info i {
            color: #1e88e5;
            margin-right: 6px;
        }

        .logo img {
            max-height: 70px;
        }

        /* Invoice title */
        .invoice-title {
            text-align: right;
            margin-bottom: 20px;
        }

        .invoice-title h1 {
            margin: 0;
            color: #1e88e5;
        }

        .invoice-title p {
            font-size: 13px;
            margin: 3px 0;
        }

        /* Info section */
        .info {
            margin-bottom: 30px;
            font-size: 14px;
        }

        /* Table */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th {
            background: #1e88e5;
            color: #fff;
            padding: 10px;
            font-size: 14px;
            text-align: left;
        }

        td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        tfoot th {
            background: none;
            color: #333;
            text-align: right;
        }

        tfoot td {
            font-weight: bold;
            font-size: 15px;
        }

        /* Footer */
        .footer {
            margin-top: 40px;
            font-size: 13px;
            color: #555;
            display: flex;
            justify-content: space-between;
        }

        .no-print {
            text-align: center;
            margin-top: 20px;
        }

        .no-print button {
            padding: 8px 15px;
            font-size: 14px;
            cursor: pointer;
        }

        @media print {
            body { background: #fff; }
            .no-print { display: none; }
        }
    </style>
</head>

<body>

<div class="invoice">

    <!-- Header -->
    <div class="header">
        <div class="company-info">
            <h2>EPTHAA AGRO</h2>
            <p>Veterinary & Agricultural Services</p>
            <p><i class="fa-solid fa-phone"></i> +234 XXX XXX XXXX</p>
            <p><i class="fa-solid fa-envelope"></i> info@epthaaagro.com</p>
        </div>

        <div class="logo">
            <img src="{{ asset('assets/img/rvs.jpg') }}" alt="Company Logo">
        </div>
    </div>

    <!-- Invoice Title -->
    <div class="invoice-title">
        <h1>INVOICE</h1>
        <p><strong>Invoice #:</strong> {{ $order->id }}</p>
        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y') }}</p>
    </div>

    <!-- Customer Info -->
    <div class="info">
        <strong>Invoice To:</strong><br>
        {{ $order->customer_name }}<br>
        {{ $order->customer_phone }}<br>
        {{ $order->customer_email }}
    </div>

    <!-- Items Table -->
    <table>
        <thead>
            <tr>
                <th>Item Description</th>
                <th width="120">Price</th>
                <th width="80">Qty</th>
                <th width="150">Total</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>₦{{ number_format($item->price, 2) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>₦{{ number_format($item->price * $item->quantity, 2) }}</td>
                </tr>
            @endforeach
        </tbody>

        <tfoot>
            <tr>
                <th colspan="3">Grand Total</th>
                <td>₦{{ number_format($order->total, 2) }}</td>
            </tr>
        </tfoot>
    </table>

    <!-- Footer -->
    <div class="footer">
        <div>
            <strong>Terms & Conditions</strong><br>
            Payment is due upon receipt.<br>
            Thank you for your patronage.
        </div>

        <div>
            <strong>Authorized By</strong><br>
            EPTHAA AGRO
        </div>
    </div>

    <!-- Actions -->
    <div class="no-print">
        <button onclick="window.print()">
            <i class="fa-solid fa-print"></i> Print Invoice
        </button><br><br>

        <a href="{{ route('admin.orders.show', $order) }}">
            <i class="fa-solid fa-arrow-left"></i> Back to order
        </a>
    </div>

</div>

<script>
    window.onload = () => window.print();
</script>

</body>
</html>