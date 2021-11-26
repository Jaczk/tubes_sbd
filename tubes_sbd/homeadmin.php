<?php
// Create database connection using config file
include_once("config.php");
// Fetch data
$pelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY ID_Pelanggan ASC");
$ruang_karaoke = mysqli_query($link, "SELECT * FROM ruang_karaoke WHERE is_delete=0 ORDER BY ID_Ruang ASC");
$reservasi = mysqli_query($link, "SELECT A.ID_Reservasi, B.Nama_Pelanggan, B.Alamat, B.No_Telp, 
A.Durasi_Sewa, C.Tipe_Ruang, C.Harga * A.Durasi_Sewa AS Total_Harga FROM reservasi A INNER JOIN 
pelanggan B ON A.ID_Pelanggan = B.ID_Pelanggan INNER JOIN ruang_karaoke C ON A.ID_Ruang = C.ID_Ruang 
WHERE A.is_delete = 0 ORDER BY ID_Reservasi ASC;");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initialscale=1.0">
    <title>Homepage Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <style>
        body {
            background-image: linear-gradient(#0ad4fc, #0565f5);
            font-family: Trirong;
            font-size: 20px;
        }

        h1 {
            padding-top: 40px;
            padding-bottom: 20px;
            margin-left: 50px;
            text-align: left;
            font-weight: bold;
            font-family: Anton;
            font-size: 50px;
            letter-spacing: 1.5px;
        }

        h3 {
            text-align: center;
            font-weight: bold;
            font-family: Trirong;
            font-size: 35px;
        }

        table {
            border: 2px solid black;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }

        a {
            font-size: 18px;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
        }

        tr {
            text-align: center;
        }

        td {
            padding: 10px 10px 10px 10px;
        }

        p {
            text-align: center;
        }

        .Tabel {
            margin-bottom: 15px;
            margin-left: 40px;
            margin-right: 40px;
            border-style: solid;
            background-color: #a8ffff;
        }

        #Recycle {
            font-family: 'Comfortaa', cursive;
            padding-left: 120px;
            font-size: 18px;
            font-weight: 200;
            padding-left: 100px;
            padding-bottom: 30px;
            cursor: pointer;
            transition: box-shadow .4s ease;
            padding-bottom: 25px;
        }

        .button {
            background-color: #5cb1f7;
            border: none;
            border-radius: 20px;
            border-style: double;
            border-width: 2px;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 18px;
            margin: 4px 2px;
            cursor: pointer;
            margin-right: 60px;
        }
    </style>
</head>

<body>
    <h1>Database Admin</h1>
    <div class="Tabel">
        <a href="addpelanggan.php" class="button">Tambah Pelanggan</a>
        <h3>Tabel Pelanggan</h3>
        <table width='60%' border=1>
            
            <tr>
                <th>ID Pelanggan</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($item = mysqli_fetch_array($pelanggan)) {
                echo "<tr>";
                echo "<td>" . $item['ID_Pelanggan'] . "</td>";
                echo "<td>" . $item['Nama_Pelanggan'] . "</td>";
                echo "<td>" . $item['Alamat'] . "</td>";
                echo "<td>" . $item['No_Telp'] . "</td>";
                echo "<td><a href='editpelanggan.php?id=$item[ID_Pelanggan]'>Edit</a>
| <a
href='softdelpelanggan.php?id=$item[ID_Pelanggan]'>Delete</a></td></tr>";
            }
            ?>
        </table>
        <br>
    </div>
    <div class="Tabel">
        <a href="addruang.php"class="button" >Tambah Ruang Karaoke</a>
        <h3>Tabel Ruang Karaoke</h3>
        <table width='40%' border=1>
            
            <tr>
                <th>Tipe Ruang</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($item = mysqli_fetch_array($ruang_karaoke)) {
                echo "<tr>";
                echo "<td>" . $item['Tipe_Ruang'] . "</td>";
                echo "<td>" . $item['Harga'] . "</td>";
                echo "<td><a
href='editruang.php?id=$item[ID_Ruang]'>Edit</a> | <a
href='softdelruang.php?id=$item[ID_Ruang]'>Delete</a></td></tr>";
            }
            ?>
        </table>
        <br>
    </div>
    <div class="Tabel">
        <a href="addreservasi.php" class="button" >Tambah Reservasi</a>
        <h3>Tabel Reservasi</h3>
        <table width='80%' border=1>
            
            <tr>
                <th>ID Reservasi</th>
                <th>Nama Pelanggan</th>
                <th>Alamat</th>
                <th>No Telp</th>
                <th>Durasi Sewa</th>
                <th>Tipe Ruang</th>
                <th>Total Harga</th>
                <th>Aksi</th>
            </tr>
            <?php
            while ($item = mysqli_fetch_array($reservasi)) {
                echo "<tr>";
                echo "<td>" . $item['ID_Reservasi'] . "</td>";
                echo "<td>" . $item['Nama_Pelanggan'] . "</td>";
                echo "<td>" . $item['Alamat'] . "</td>";
                echo "<td>" . $item['No_Telp'] . "</td>";
                echo "<td>" . $item['Durasi_Sewa'] . "</td>";
                echo "<td>" . $item['Tipe_Ruang'] . "</td>";
                echo "<td>" . $item['Total_Harga'] . "</td>";
                echo "<td><a
href='editreservasi.php?id=$item[ID_Reservasi]'>Edit</a> | <a
href='softdelreservasi.php?id=$item[ID_Reservasi]'>Delete</a></td></tr>";
            }
            ?>
        </table>
        <br>
    </div>
    <div id="Recycle">
        <button onclick="location.href='viewsoftdel.php'">Recycle Bin</button>
        <button onclick="location.href='logout.php'">Log Out</button>
    </div>
</body>

</html>