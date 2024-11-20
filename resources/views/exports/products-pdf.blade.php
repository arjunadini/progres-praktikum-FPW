<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Export</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f8f9fa;
            color: #333;
        }

        header {
            text-align: center;
            margin-bottom: 30px;
        }

        header img {
            max-width: 150px;
            margin-bottom: 10px;
        }

        header p {
            font-size: 12px;
            color: #555;
        }

        .content {
            text-align: left;
            margin-top: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #007bff;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th {
            background-color: #007bff;
            color: white;
            text-align: left;
        }

        th,
        td {
            padding: 12px;
            font-size: 14px;
        }

        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tbody tr:hover {
            background-color: #e9ecef;
        }

        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 12px;
            color: #555;
        }
    </style>
</head>

<body>
    <header>
        <img src="{{ public_path('images/logo.png') }}" alt="Logo">
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</p>
    </header>
    <div class="content">
        <h2>Daftar Produk</h2>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Unit</th>
                    <th>Type</th>
                    <th>Information</th>
                    <th>Qty</th>
                    <th>Producer</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->unit }}</td>
                        <td>{{ $product->type }}</td>
                        <td>{{ $product->information }}</td>
                        <td>{{ $product->qty }}</td>
                        <td>{{ $product->producer }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Terima kasih atas perhatian Anda!</p>
    </div>
</body>

</html>