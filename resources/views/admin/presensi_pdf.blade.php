<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Rekap Presensi Bulan {{ \Carbon\Carbon::parse('Y F')->translatedFormat('F Y') }}</title>
    <style>
        body {
            font-family: Helvetica, sans-serif;
            font-size: 11px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid black;
            padding: 5px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Atur lebar kolom agar lebih rapi */
        th:nth-child(1),
        td:nth-child(1) {
            width: 5%;
        }

        th:nth-child(2),
        td:nth-child(2) {
            width: 20%;
        }

        th:nth-child(3),
        td:nth-child(3) {
            width: 15%;
        }

        th:nth-child(4),
        td:nth-child(4) {
            width: 30%;
        }

        th:nth-child(5),
        td:nth-child(5) {
            width: 35%;
        }

        h4 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h4>Rekap Presensi {{ \Carbon\Carbon::parse('F Y')->translatedFormat('F Y') }}</h4>
    <br>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Waktu</th>
                <th>Jenis Presensi</th>
                <th>Lokasi</th>
                <th>Status</th>
            </tr>
        </thead>
        @php
            $no = 1;
        @endphp
        <tbody>
            @foreach ($data as $data)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->nama }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->waktu)->translatedFormat('l, d F Y H:i:s') }}</td>
                    <td>{{ $data->tipe }}</td>
                    <td>{{ $data->lokasi }}</td>
                    <td>{{ $data->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
