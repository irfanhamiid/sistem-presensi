<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekap Presensi</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <style>
        .text {
            font-family: Helvetica, sans-serif;
            font-size: 11px;
        }

        table.no td,
        table.no th {
            border: 1px;
        }

        .cek {
            margin-bottom: 100px;
        }
    </style>
</head>

<body>
    <table>
        <thead>
            <tr>
                <th colspan="5" style="text-align: center">
                    <h3>Rekap Presensi</h3>
                </th>
            </tr>
        </thead>
    </table>
    <table class="table">
        <thead>
            <tr>
                <th style="text-align: center;border:1px solid black;">No</th>
                <th style="text-align: center;border:1px solid black;">Nama</th>
                <th style="text-align: center;border:1px solid black;">Waktu</th>
                <th style="text-align: center;border:1px solid black;">Jenis Presensi</th>
                <th style="text-align: center;border:1px solid black;">Lokasi</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @php
                $no=1;
            @endphp
            @foreach ($data as $data)
                <tr>
                    <td style="text-align: center;border:1px solid black;">{{ $no++ }}</td>
                    <td style="text-align: center;border:1px solid black;">
                       {{ $data->nama }}</td>
                    <td style="text-align: center;border:1px solid black;">{{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                    <td style="text-align: center;border:1px solid black;">{{ $data->tipe }}</td>
                    <td style="text-align: center;border:1px solid black;">{{ $data->lokasi }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>
