<?php
    include_once("config.php");

    //Inisialisasi sesi
    session_start();
    
    //Mengecek apakah user telah login, jika tidak akan kembali ke halaman login
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: login.php");
        exit;
    }
    $listruang = mysqli_query($link, "SELECT * FROM ruang_karaoke WHERE is_delete=0 ORDER BY ID_Ruang ASC");

    if(isset($_GET['search'])){
        $search = $_GET['search'];
        $listreservasi = mysqli_query($link, " SELECT A.ID_Reservasi, B.Nama_Pelanggan, A.Durasi_Sewa, C.Tipe_Ruang, 
        C.Harga * A.Durasi_Sewa AS Total_Harga, B.Alamat, B.No_Telp FROM reservasi A INNER JOIN pelanggan B 
        ON A.ID_Pelanggan = B.ID_Pelanggan INNER JOIN ruang_karaoke C ON A.ID_Ruang = C.ID_Ruang
        WHERE A.is_delete = 0 AND B.Nama_Pelanggan LIKE '%".$search."%' ORDER BY A.ID_Reservasi ASC");
    } else {
        $listreservasi = mysqli_query($link, "SELECT A.ID_Reservasi, B.Nama_Pelanggan, A.Durasi_Sewa, C.Tipe_Ruang, 
        C.Harga * A.Durasi_Sewa AS Total_Harga, B.Alamat, B.No_Telp FROM reservasi A INNER JOIN pelanggan B 
        ON A.ID_Pelanggan = B.ID_Pelanggan INNER JOIN ruang_karaoke C ON A.ID_Ruang = C.ID_Ruang
        WHERE A.is_delete = 0 ORDER BY A.ID_Reservasi ASC");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
    <style>
        body{ 
            font: 15px compact; 
            text-align: center; 
            background-image: linear-gradient(#0ad4fc, #0565f5);
            font-family: Trirong;
        }
        h1 {
            padding: 20px 20px 10px 20px;
            margin-left: 430px;
            margin-right: 400px;
            color: #473a2f;
            font-weight: bold;
            font-family: Anton;
            font-size: 80px;
        }
        h3 {
            text-align: center;
            color: #473a2f;
            font-weight: bold;
            font-family: Trirong;
            font-size: 40px;
        }
        h4 {
            text-align: center;
            color: #473a2f;
            font-weight: bold;
            font-family: Trirong;
            font-size: 25px;
        }
        table {
            margin-left: auto;
            margin-right: auto;
            border-color: #473a2f;
        }
        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
            font-weight: bold;
            font-size: 17px;
            background-color: rgb(255, 97, 60);
            color: #ffffffff;
        }
        tr  {
            text-align: center;
            color: #473a2f;
            background-color: #ffffff;
        }
        td {
            padding: 10px 10px 10px 10px;
            color: #473a2f;
            font-weight: bold;
            font-size: 18px;
        }
        p {
            text-align: center;
        }
        .Tabel {
            padding: 10px 10px 10px 10px;
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 20px;
            margin-right: 20px;
            border-style: double;
            border-width: 5px;
            background-color: #a8ffff;
        }
        .TabelSearch {
            width: 35%;
            padding: 5px 5px 5px 5px;
            margin-top: 10px;
            margin-bottom: 20px;
            margin-left: auto;
            margin-right: auto;
            border-style: double;
            border-width: 5px;
            background-color: #ffffff;
        }
        .buttonAdd {
            background-color: #0ad4ff;
            color: #ffffff;
        }
        .searchLabel {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1 class="my-5">Welcome to King Nassar Karaoke</h1>
    <h3 class="my-4"> Anda Puas Kami Pun Lemas</h3>
    <h4 class="my-4"> Masukkan Data di bawah</h4>
    
    <div class="TabelSearch">
    <form action="home.php" method="post" name="form1"> 
            <table width="70%" border="0"> 
                <tr>
                    <td>Nama Pelanggan</td>
                    <td><input type="text" name="Nama_Pelanggan"></td> 
                </tr> 
                <tr>
                    <td>Alamat</td> 
                    <td><input type="text" name="Alamat"></td> 
                </tr>
                <tr>
                    <td>No Telp</td> 
                    <td><input type="text" name="No_Telp"></td> 
                </tr>
                <tr>
                    <td>ID Ruang</td> 
                    <td><input type="text" name="ID_Ruang"></td> 
                </tr>
                <tr>
                    <td>Durasi Sewa</td> 
                    <td><input type="text" name="Durasi_Sewa"></td> 
                </tr>
                <tr>
                    <td></td> 
                    <td><input class = "buttonAdd"type="submit" name="Submit" value="Add"></td> 
                </tr> 
            </table> 
        </form>
    </div>

    <div class="Tabel">
    <h3>Katalog Ruang</h3>
        <table width='80%' border=1>
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

    <div class="TabelSearch">
    <form action="home.php" method="GET" name="form1"> 
        <table width="25%" border="0"> 
            <tr>
                <td class="searchLabel">Cari Nama Pelanggan:</td>
                <td><input type="text" name="search"></td> 
            </tr>
            <td/><td><input class="buttonSearch" type="submit" value="Search" /></td>
        </table> 
    </form>
    </div>

    <div class="Tabel">
    <h3>Tabel Reservasi</h3>
    <table width='80%' border=1>
        <tr class ="Search">
            <th>ID Reservasi</th>
            <th>Nama Pelanggan</th>
            <th>Alamat</th>
            <th>No Telp</th>
            <th>Durasi Sewa</th>
            <th>Tipe Ruang</th>
            <th>Total Harga</th>
        </tr>
        <?php
        while ($item2 = mysqli_fetch_array($listreservasi)) {
            echo "<tr>";
            echo "<td>" . $item2['ID_Reservasi'] . "</td>";
            echo "<td>" . $item2['Nama_Pelanggan'] . "</td>";
            echo "<td>" . $item2['Alamat'] . "</td>";
            echo "<td>" . $item2['No_Telp'] . "</td>";
            echo "<td>" . $item2['Durasi_Sewa'] . "</td>";
            echo "<td>" . $item2['Tipe_Ruang'] . "</td>";
            echo "<td>" . $item2['Total_Harga'] . "</td>";
        }
        ?>
        </table><br>
    </div>
    <p>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out</a>
    </p>

    <?php
            // Check If form submitted, insert form data into users table.
            if(isset($_POST['Submit'])) { 
                $namapelanggan = $_POST['Nama_Pelanggan']; 
                $alamat = $_POST['Alamat'];
                $notelp = $_POST['No_Telp'];
                $idruang = $_POST['ID_Ruang'];
                $durasi = $_POST['Durasi_Sewa'];

                // Insert user data into table 
                $post = "INSERT INTO pelanggan(ID_Pelanggan, Nama_Pelanggan, 
                Alamat, No_Telp, is_delete) VALUES ('','$namapelanggan','$alamat','$notelp','0')"; 
                $result = mysqli_query($link, $post);
                
                $listpelanggan = mysqli_query($link, "SELECT * FROM pelanggan WHERE is_delete=0 ORDER BY ID_Pelanggan ASC");

                while($item = mysqli_fetch_array($listpelanggan)) {
                    $idpelanggan = $item['ID_Pelanggan']; 
                }

                $post2 = "INSERT INTO reservasi(ID_Reservasi, ID_Pelanggan, ID_Ruang,
                Durasi_Sewa,is_delete) VALUES ('',$idpelanggan,$idruang,$durasi,'0')";

                $result2 = mysqli_query($link,$post2);

                // Show message when user added 
                $message = "Terimakasih sudah memilih King Nassar Karaoke";
                echo "<script type='text/javascript'>alert('$message');</script>";
            }
        ?>
</body>
</html>

<?php
    
?>