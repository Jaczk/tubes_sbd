<?php
    include_once("config.php");

    $listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY ID_Pelanggan ASC");
    $listruang = mysqli_query($link, "SELECT * FROM ruang_karaoke WHERE is_delete=0 ORDER BY ID_Ruang ASC");
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add Reservasi</title>
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
            font-size: 26px;
        }

        h4 {
            text-align: center;
            font-weight: 600;
            font-size: 24px;
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
            tr  {
                text-align: center;
            }
            td  {
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
        <a href="homeadmin.php"class="button">Back to Home Admin</a> 
        <br/><br/>

        <div class="Tabel2">
        <h2>Tambah Reservasi</h2>
        <form action="addreservasi.php" method="post" name="form1"> 
            <table width="60%" border="0"> 
                <tr>
                    <td>ID Pelanggan</td>
                    <td><input type="text" name="ID_Pelanggan"></td> 
                </tr> 
                <tr>
                    <td>ID_Ruang</td> 
                    <td><input type="text" name="ID_Ruang"></td> 
                </tr>
                <tr>
                    <td>Durasi_Sewa</td> 
                    <td><input type="text" name="Durasi_Sewa"></td> 
                </tr>
                <tr>
                    <td></td> 
                    <td><input type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table> 
        </form>
        </div>

        <h3>Masukkan ID Pelanggan dan ID Ruang sesuai data tabel yang akan dimasukkan seperti di bawah:</h3>

        <div class="Tabel3">
        <h4>Katalog Ruang</h4>
        <table width='60%' border=1>
            <tr>
                <th>ID Ruang</th> <th>Tipe Ruang</th> <th>Harga</th>  
            </tr>

            <?php
                while($item = mysqli_fetch_array($listruang)) {
                    echo "<tr>"; 
                    echo "<td>".$item['ID_Ruang']."</td>"; 
                    echo "<td>".$item['Tipe_Ruang']."</td>"; 
                    echo "<td>".$item['Harga']."</td>"; 
                }
            ?>
        </table><br>
        </div>

        <div class="Tabel">
        <h4>Data Pelanggan yang melakukan pemesanan</h4>
        <table width='80%' border=1>
            <tr>
                <th>ID Pelanggan</th> <th>Nama Pelanggan</th> <th>No Telp</th> <th>Alamat</th> 
            </tr>
        
            <?php
                while($item = mysqli_fetch_array($listpelanggan)) {
                    echo "<tr>"; 
                    echo "<td>".$item['ID_Pelanggan']."</td>"; 
                    echo "<td>".$item['Nama_Pelanggan']."</td>"; 
                    echo "<td>".$item['No_Telp']."</td>"; 
                    echo "<td>".$item['Alamat']."</td>";
                }
            ?>
        </table><br>
        </div>

        <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                $idpelanggan = $_POST['ID_Pelanggan']; 
                $idruang = $_POST['ID_Ruang'];
                $durasi = $_POST['Durasi_Sewa'];

                // include database connection file 
                include_once("config.php");

                // Insert user data into table 
                $result = mysqli_query($link, "INSERT INTO reservasi(ID_Reservasi, ID_Pelanggan, ID_Ruang, Durasi_Sewa) 
                VALUES('','$idpelanggan', '$idruang', '$durasi')"); 
                // Show message when user added 
                echo "Berhasil menambahkan Reservasi Baru ke Katalog Reservasi ! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>"; 
            }
        ?>
    </body>
</html>