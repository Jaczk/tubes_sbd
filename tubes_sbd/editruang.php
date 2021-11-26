<?php
// include database connection file 
include_once("config.php");

// Check if form is submitted for data update, then redirect to homepage after update 
if (isset($_POST['update'])) {
    $idruang = $_POST['ID_Ruang'];
    $tiperuang = $_POST['Tipe_Ruang'];
    $harga = $_POST['Harga'];

    // update data 
    $result = mysqli_query($link, "UPDATE ruang_karaoke SET Tipe_Ruang='$tiperuang',
         Harga='$harga' WHERE ID_Ruang=$idruang");

    // Redirect to homepage to display updated data in list 
    header("Location: homeadmin.php");
}
?>

<?php
// Display selected minuman based on id 
// Getting id from url 
$id = $_GET['id'];

// Fetch data based on id 
$result = mysqli_query($link, "SELECT * FROM ruang_karaoke WHERE ID_Ruang=$id");

while ($rk = mysqli_fetch_array($result)) {
    $tiperuang = $rk['Tipe_Ruang'];
    $harga = $rk['Harga'];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Edit Ruang Karaoke</title>
</head>
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
        margin-left: 600px;
        margin-right: 600px;
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

    <body><a href="homeadmin.php"class="button">Back to Home Admin</a>
        <br /><br />

        <div class="Tabel">
            <h2>Edit Ruang Karaoke</h2>
            <form name="update_rk" method="post" action="editruang.php">
                <table border="0">
                    <tr>
                        <td>Tipe Ruang</td>
                        <td><input type="text" name="Tipe_Ruang" value=<?php echo $tiperuang; ?>></td>
                    </tr>

                    <tr>
                        <td>Harga</td>
                        <td><input type="text" name="Harga" value=<?php echo $harga; ?>></td>
                    </tr>

                    <tr>
                        <td><input type="hidden" name="ID_Ruang" value=<?php echo $_GET['id']; ?>></td>
                        <td><input type="submit" name="update" value="Update"></td>
                    </tr>
                </table>
            </form>
        </div>
    </body>

</html>