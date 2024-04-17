<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        table.static {
            position: relative;
            /* left: 3%; */
            border: 1px solid #543535;
            border-collapse: collapse
        }
    </style>
    <title>K-Means | Cetak Hasil</title>
</head>
<body>
    <div class="form-group">
        <p align="center"><b>Laporan Hasil</b></p>
        <table class="static" align="center" rules="alt" border="1px" style="width: 95%">
            <tr>
                <th>NIS</th>
                <th>NAMA</th>
                <th>JENIS KELAMIN</th>
                <th>JENJANG</th>
                <th>CLUSTER</th>
            </tr>
            @foreach ($dtsantri as $item)
                <tr>
                    <td><center>{{ $item->nis }}</center></td>
                    <td>{{ $item->nama }}</td>
                    <td><center>{{ $item->jk->jenis_kelamin }}</center></td>
                    <td><center>{{ $item->jenjang->jenjang }}</center></td>
                    <td><center>{{ $item->kelompok_hasil }}</center></td>
                </tr>
            @endforeach
        </table>
    </div>
    <script type="text/javascript">
        window.print();
    </script>
</body>
</html>
