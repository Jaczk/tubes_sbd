<?php
// include database connection file 
include_once("config.php");

$listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY ID_Pelanggan ASC");
$listruang = mysqli_query($link, "SELECT * FROM ruang_karaoke WHERE is_delete=0 ORDER BY ID_Ruang ASC");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $idreservasi = $_POST['ID_Reservasi'];
    $idpelanggan = $_POST['ID_Pelanggan'];
    $idruang = $_POST['ID_Ruang'];
    $durasi = $_POST['Durasi_Sewa'];

    // update data 
    $result = mysqli_query($link, "UPDATE reservasi SET ID_Pelanggan='$idpelanggan', ID_Ruang='$idruang', Durasi_Sewa='$durasi' WHERE ID_Reservasi=$idreservasi");

    // Redirect to homepage to display updated data in list 
    header("Location: homeadmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM reservasi WHERE ID_Reservasi=$id");

while ($res = mysqli_fetch_array($result)) {
    $idpelanggan = $res['ID_Pelanggan'];
    $idruang = $res['ID_Ruang'];
    $durasi = $res['Durasi_Sewa'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Data Reservasi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <style>
        body {
            background-color: #0ad4fc;
            font-family: Trirong;
            font-size: 20px;
            font-weight: 500;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
            font-weight: 600;
        }

        h3 {
            text-align: center;
            font-weight: 600;
        }

        h4 {
            text-align: center;
            font-weight: 600;
        }

        table {
            margin-left: auto;
            margin-right: auto;
            background-color: white;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(255, 97, 60);
            color: #38342c;
        }

        tr {
            text-align: center;
        }

        td {
            text-align: center;
            padding: 7px 10px 7px 10px;
        }

        .Tabel {
            margin-bottom: 10px;
            margin-left: 80px;
            margin-right: 80px;
            border-style: solid;
            background-color: white;
        }
        .Tabel2 {
            margin-bottom: 10px;
            margin-left: 700px;
            margin-right: 700px;
            border-style: solid;
            background-color: white;
        }
        .Tabel3 {
            margin-bottom: 10px;
            margin-left: 400px;
            margin-right: 400px;
            border-style: solid;
            background-color: white;
        }

        .button {
            background-color: #3005f2;
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

    <body><a href="homeadmin.php"class ="button">Back to Home Admin</a>
        <br /><br />

        <h2>Edit Data Reservasi</h2>

        <div class="Tabel2">
            <form name="update_res" method="post" action="editreservasi.php">
                <table border="0">
                    <tr>
                        <td>ID Pelanggan</td>
                        <td><input type="text" name="ID_Pelanggan" value=<?php echo $idpelanggan; ?>></td>
                    </tr>
                    <tr>
                        <td>ID_Ruang</td>
                        <td><input type="text" name="ID_Ruang" value=<?php echo $idruang; ?>></td>
                    </tr>
                    <tr>
                        <td>Durasi_Sewa</td>
                        <td><input type="text" name="Durasi_Sewa" value=<?php echo $durasi; ?>></td>
                    </tr>

                    <tr>
                        <td><input type="hidden" name="ID_Reservasi" value=<?php echo $_GET['id']; ?>></td>
                        <td><input type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>

        <h3>Masukkan ID Pelanggan dan ID Ruang sesuai data tabel yang akan dimasukkan seperti di bawah:</h3>

        <div class="Tabel3">
            <h4>Katalog Ruang</h4>
            <table width='60%' border=1>
                <tr>
                    <th>ID Ruang</th>
                    <th>Tipe Ruang</th>
                    <th>Harga</th>
                </tr>

                <?php
                while ($item = mysqli_fetch_array($listruang)) {
                    echo "<tr>";
                    echo "<td>" . $item['ID_Ruang'] . "</td>";
                    echo "<td>" . $item['Tipe_Ruang'] . "</td>";
                    echo "<td>" . $item['Harga'] . "</td>";
                }
                ?>
            </table><br>
        </div>

        <div class="Tabel">
            <h4>Data Pelanggan yang melakukan pemesanan</h4>
            <table width='80%' border=1>
                <tr>
                    <th>ID Pelanggan</th>
                    <th>Nama Pelanggan</th>
                    <th>No Telp</th>
                    <th>Alamat</th>
                </tr>

                <?php
                while ($item = mysqli_fetch_array($listpelanggan)) {
                    echo "<tr>";
                    echo "<td>" . $item['ID_Pelanggan'] . "</td>";
                    echo "<td>" . $item['Nama_Pelanggan'] . "</td>";
                    echo "<td>" . $item['No_Telp'] . "</td>";
                    echo "<td>" . $item['Alamat'] . "</td>";
                }
                ?>
            </table><br>
        </div>
    </body>

</html>