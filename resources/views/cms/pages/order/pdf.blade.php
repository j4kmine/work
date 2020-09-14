<!DOCTYPE html>
<html>
    <head>
        <title>PO#: {{ $order["order"]->id }}</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    </head>
    <body>
        <style type="text/css">
            table tr td,
            table tr th{
                font-size: 9pt;
            }
        </style>

        <div style="float: right;">
            <p><strong>(PURCHASE ORDER)</strong></p>
            <p><strong>DATE</strong> {{ $order["order"]->created_at }}</p>
            <p><strong>PO#</strong> {{ $order["order"]->id }}</p>
        </div>
        <div>
            <p><strong>MREXPORTIR</strong></p>
            <p>Jalan Senayan</p>
            <p>Jakarta - 000000</p>
            <p><abbr title="Phone">Telp:</abbr> (021) 456-7890</p>
        </div>

        <div class="row">
            <div class="col-6">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">PENGIRIM</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>{{ $order["order"]->pengirim_perusahaan }}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->pengirim_nama }}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->pengirim_alamat }}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->pengirim_kota }},{{ $order["pengirim_negara"]->nama }},{{ $order["order"]->pengirim_kodepos }}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->pengirim_telepon }}</td>
                </tr>
              </tbody>
            </table>
            </div>

            <div class="col-6" style=" float: right;">
            <table class="table table-sm">
              <thead>
                <tr>
                  <th scope="col">PENERIMA</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                    <td>{{ $order["order"]->penerima_perusahaan}}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->penerima_nama}}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->penerima_alamat}}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->penerima_kota}},{{ $order["penerima_negara"]->nama }},{{ $order["order"]->penerima_kodepos}}</td>
                </tr>
                <tr>
                    <td>{{ $order["order"]->penerima_telepon}}</td>
                </tr>
              </tbody>
            </table>
            </div>
        </div>

        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>VIA PENGIRIMAN</th>
                    <th>JENIS PENGIRIMAN</th>
                    <th>TIPE PENGIRIMAN</th>
                    <th>BARANG KATEGORI</th>
                    <th>BARANG JENIS</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ $order["order"]->id_via_pengiriman }}</td>
                    <td>{{ $order["order"]->id_jenis_pengiriman }}</td>
                    <td>{{ $order["order"]->id_tipe_pengiriman }}</td>
                    <td>{{ $order["order"]->id_barang_kategori }}</td>
                    <td>{{ $order["order"]->id_barang_jenis }}</td>
                </tr>
            </tbody>
        </table>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>NO</th>
                    <th>KATEGORI</th>
                    <th>DESKRIPSI</th>
                    <th>PANJANG</th>
                    <th>LEBAR</th>
                    <th>TINGGI</th>
                    <th>BERAT</th>
                    <th>HARGA</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order["rel_item"] as $key => $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>{{ $value->kategori }}</td>
                    <td>{{ $value->deskripsi }}</td>
                    <td>{{ $value->panjang }}</td>
                    <td>{{ $value->lebar }}</td>
                    <td>{{ $value->tinggi }}</td>
                    <td>{{ $value->berat }}</td>
                    <td>{{ $value->harga }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table class='table table-bordered'>
            <thead>
                <tr>
                    <th>ITEMS</th>
                    <th>TITLE</th>
                    <th>JUMLAH</th>
                    <th>HARGA SATUAN</th>
                    <th>HARGA TOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($order["rel_addons"] as $key => $value)
                <tr>
                    <td>{{ $value->id_item }}</td>
                    <td>{{ $value->title }}</td>
                    <td>{{ $value->jumlah }}</td>
                    <td>{{ $value->harga_satuan }}</td>
                    <td>{{ $value->harga_total }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </body>
</html>