<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice #{{ $invoice->id }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>

    <h1>Invoice #{{ $invoice->id }}</h1>
    
    <p><strong>Nama:</strong> {{ $invoice->user->name }}</p>
    <p><strong>Email:</strong> {{ $invoice->user->email }}</p>
    <p><strong>Nama Travel:</strong> {{ $invoice->jadwaltravel->nama }}</p>
    <p><strong>Tujuan:</strong> {{ $invoice->jadwaltravel->tujuan }}</p>
    <p><strong>Waktu Keberangkatan:</strong> {{ $invoice->jadwaltravel->tanggal }} {{ $invoice->jadwaltravel->waktu_berangkat }}</p>

    <table>
        <tr>
            <th>Harga Tiket</th>
            <td>{{ number_format($invoice->harga, 2) }}</td>
        </tr>
        <tr>
            <th>Jumlah Tiket</th>
            <td>{{ $invoice->jumlah_tiket }}</td>
        </tr>
        <tr>
            <th>Total Harga</th>
            <td>{{ number_format($invoice->total_harga, 2) }}</td>
        </tr>
        <tr>
            <th>Status</th>
            <td>{{ $invoice->status }}</td>
        </tr>
    </table>
    
    <p><strong>Terimakasih telah menggunakan layanan kami</strong></p>

</body>

</html>
