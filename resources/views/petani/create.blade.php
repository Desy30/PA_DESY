<!DOCTYPE html>
<html>
<head>
    <title>Tambah Data Petani</title>
</head>
<body>
    <h2 style="text-align: center;">Form Tambah Petani</h2>
    <form action="/petani/store" method="POST" style="width: 400px; margin: auto;">
        @csrf
        <div>
            <label>Nama:</label>
            <input type="text" name="nama" required>
        </div>
        <div>
            <label>Alamat:</label>
            <input type="text" name="alamat" required>
        </div>
        <div>
            <label>No HP:</label>
            <input type="text" name="no_hp" required>
        </div>
        <br>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
