<!DOCTYPE html>
<html>
<head>
    <title>MODUL ORDER</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <style type="text/css">
        table tr td,
        table tr th{
            font-size: 9pt;
        }
    </style>
    <center>
        <h5>MODUL ORDER</h4>
    </center>

    <table class='table table-bordered'>
        <thead>
            <tr>
                <th>No</th>
                <th>id_user</th>
                <th>kota_asal</th>
                <th>kota_tujuan</th>
                <th>id_tipe_pengiriman</th>
                <th>id_barang_kategori</th>
            </tr>
        </thead>
        <tbody>
            @php $i=1 @endphp
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{$order->id_user}}</td>
                <td>{{$order->kota_asal}}</td>
                <td>{{$order->kota_tujuan}}</td>
                <td>{{$order->id_tipe_pengiriman}}</td>
                <td>{{$order->id_barang_kategori}}</td>
            </tr>
        </tbody>
    </table>

</body>
</html>