<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Stok Barang</title>
</head>
<body>
    <table align="center">
        <tr>
            <h1>Laporan Stok Barang</h1>
        </tr>
    </table>
    <br>
    <table align="left">
        <tr>
            <td>Periode</td>
            <td>:</td>
            <td>{{ $results['period'] }}</td>
        </tr>
    </table>
    <br>
    <table border="1" class="table table-bordered" width="100%" cellspacing="0">
    <thead>
        <tr>
            <th>No</th>
            <th>Kode Barang</th>
            <th>Stok Awal</th>
            <th>Jumlah Masuk</th>
            <th>Jumlah Keluar</th>
            <th>Stok Akhir</th>
            <th>Tanggal</th>
        </tr>
    </thead>
    <tbody align="center">
        @foreach ($results['data'] as $row)
        <tr {!! $loop->odd ? 'style="background: #F0F5F9;" ' : '' !!}>
            <td class="wrap-all">{{ $loop->index + 1 }}</td>
            <td>{{ $row['kode_barang'] }}</td>
            <td>{{ $row['stok_awal']}}</td>
            <td>{{ $row['stok_masuk'] }}</td>
            <td>{{ $row['stok_keluar'] }}</td>
            <td>{{ $row['stok_akhir'] }}</td>
            <td>{{ $row['tanggal'] }}</td>
        </tr>
        @endforeach
    </tbody>
    </table>
    <br>
</body>
</html>