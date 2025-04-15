<!DOCTYPE html>
<html>

<head>
    <title>Data Petani</title>
    <style>
        table {
            width: 60%;
            margin: 20px auto;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            border: 1px solid #ccc;
            text-align: left;
        }

        th {
            background-color: #f33;
            color: #fff;
        }
    </style>
</head>

<body>
    <h2 style="text-align:center">Data Petani</h2>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $i => $petani)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $petani->nama }}</td>
                    <td>{{ $petani->alamat }}</td>
                    <td>{{ $petani->no_hp }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
