<?php
// include database connection file 
include_once("config.php");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $idpelanggan = $_POST['ID_Pelanggan'];
    $namapelanggan = $_POST['Nama_Pelanggan'];
    $notelp = $_POST['No_Telp'];
    $alamat = $_POST['Alamat'];

    // update data 
    $result = mysqli_query($link, "UPDATE pelanggan SET Nama_Pelanggan='$namapelanggan',
         No_Telp='$notelp', Alamat='$alamat' WHERE ID_Pelanggan=$idpelanggan");

    // Redirect to homepage to display updated data in list 
    header("Location: homeadmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM pelanggan WHERE ID_Pelanggan=$id");

while ($pel = mysqli_fetch_array($result)) {
    $namapelanggan = $pel['Nama_Pelanggan'];
    $notelp = $pel['No_Telp'];
    $alamat = $pel['Alamat'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Pelanggan</title>
</head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Trirong">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Anton">
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
        padding: 10px 10px 10px 10px;
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

<body>

    <body><a href="homeadmin.php"class="button"> Back to Home Admin</a>
        <br /><br />

        <div class="Tabel">
            <h2>Edit Pelanggan</h2>
            <form name="update_pel" method="post" action="editpelanggan.php">
                <table border="0">
                    <tr>
                        <td>Nama Pelanggan</td>
                        <td><input type="text" name="Nama_Pelanggan" value=<?php echo $namapelanggan; ?>></td>
                    </tr>

                    <tr>
                        <td>No Telp</td>
                        <td><input type="text" name="No_Telp" value=<?php echo $notelp; ?>></td>
                    </tr>

                    <tr>
                        <td>Alamat</td>
                        <td><input type="text" name="Alamat" value=<?php echo $alamat; ?>></td>
                    </tr>

                    <tr>
                        <td><input type="hidden" name="ID_Pelanggan" value=<?php echo $_GET['id']; ?>></td>
                        <td><input type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

</html>