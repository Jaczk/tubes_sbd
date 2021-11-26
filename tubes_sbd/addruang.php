<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Ruang Karaoke</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
    <style>
        body {
            background-color: #0ad4fc;
            font-family: Trirong;
            font-size: 20px;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        h2 {
            text-align: center;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }

        th {
            padding: 10px 10px 10px 10px;
            text-align: center;
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
            margin-left: 700px;
        margin-right: 700px;
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
    <br /><br />

    <div class="Tabel">
        <h2>Tambah Ruang Karaoke</h2>
        <form action="addruang.php" method="post" name="form1">
            <table width="25%" border="0">
                <tr>
                    <td>ID_Ruang</td>
                    <td><input type="text" name="ID_Ruang"></td>
                </tr>
                <tr>
                    <td>Tipe Ruang</td>
                    <td><input type="text" name="Tipe_Ruang"></td>
                </tr>
                <tr>
                    <td>Harga</td>
                    <td><input type="text" name="Harga"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="Submit" value="Add"></td>
                </tr>
            </table>
        </form>
    </div>

    <?php
    // Check If form submitted, insert form data into users table.
    if (isset($_POST['Submit'])) {
        $idruang = $_POST['ID_Ruang'];
        $tiperuang = $_POST['Tipe_Ruang'];
        $harga = $_POST['Harga'];

        // include database connection file 
        include_once("config.php");

        // Insert user data into table 
        $result = mysqli_query($link, "INSERT INTO ruang_karaoke(ID_Ruang, Tipe_Ruang, Harga) 
                VALUES('$idruang', '$tiperuang', '$harga')");
        // Show message when user added 
        echo "Berhasil menambahkan $tiperuang ke Data Ruang Karaoke! <br><a href='homeadmin.php'>Kembali ke Home Admin</a>";
    }
    ?>
</body>

</html>