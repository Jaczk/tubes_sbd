<?php
//Memulai sesi
session_start();
 
//Mengecek apakah user sudah login. Bila iya, user akan dibawa ke halaman Home
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homeadmin.php");
    exit;
}
 
//Include config.php
require_once "config.php";
 
//Mendefinisikan variabel dengan nilai kosong
$username = $password = "";
$username_err = $password_err = $login_err = "";
 
//Memproses form saat data di submit
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    //Mengecek apakah form username kosong
    if(empty(trim($_POST["username"]))){
        $username_err = "Mohon masukkan username anda.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    //Mengecek apakah form password kosong
    if(empty(trim($_POST["password"]))){
        $password_err = "Mohon masukkan password anda.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    //Validasi kredensial
    if(empty($username_err) && empty($password_err)){
        
        //Menyiapkan statement select
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            //Mengikat variabel ke statement sebagai parameter
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            //Men-set parameter
            $param_username = $username;
            
            //Mencoba menjalankan statement yang telah disiapkan
            if(mysqli_stmt_execute($stmt)){
                
                //Menyimpan result
                mysqli_stmt_store_result($stmt);
                
                //Mengecek apakah username ada pada database dan menverifikasi password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    //Mengikat variabel result
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            
                            //Jika password benar, mulai sesi baru
                            session_start();
                            
                            //Menyimpan data pada variabel sesi
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            
                            //Mengarahkan user ke halaman Home
                            header("location: homeadmin.php");
                     
                        }else{
                            //Jika password tidak benar, menampilkan statement error
                            $login_err = "Username atau password yang dimasukkan salah.";
                        }
                    }
                } else{
                    //Jika username tidak ada, menampilkan statement error
                    $login_err = "Username yang dimasukkan tidak ada.";
                }
            } else{
                echo "Sepertinya terjadi masalah, mohon dicoba lagi setelah beberapa saat.";
            }

            //Menutup statement
            mysqli_stmt_close($stmt);
        }
    }
    
    //Menutup koneski
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap">
    <style>
        body {
            background-color:#fce1b6;
        }
        h2{
            font-size: 40px;
            text-align: center;
            font-weight: bold;
            font-family: 'Comfortaa', cursive;
        }
        p{
            text-align: center;
            font-size: 15px;
        }
        .login {
            width: 360px;
            font-family: 'Comfortaa', cursive;
            padding: 20px;
            margin: 0;
            position: absolute;
            top: 50%;
            left: 50%;
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
            border-radius: 20px;
            border-style: double;
            border-width: 4px;
            background-color: white;
        }

        #form {
            height: 310px;
            position: relative;
            z-index: 1;
            border-radius: 10px;
            max-width: 360px;
            margin: 0 auto 100px;
            padding: 45px;
            text-align: center;
        }

        #input {
            outline: 0;
            background: #f2f2f2;
            width: 100%;
            border: 0;
            border-radius: 5px;
            margin: 0 0 15px;
            padding: 15px;
            box-sizing: border-box;
            font-size: 14px;
            font-family: 'Comfortaa', cursive;
        }

        #button {
            font-family: 'Comfortaa', cursive;
            text-transform: uppercase;
            outline: 0;
            background: #4b6cb7;
            width: 100%;
            border: 0;
            border-radius: 5px;
            padding: 15px;
            color: #FFFFFF;
            font-size: 14px;
            -webkit-transition: all 0.3 ease;
            transition: all 0.3 ease;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="login">
        <h2>Login Admin</h2>
        <p>Mohon masukkan username dan password anda untuk login.</p>
        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control <?php echo (!empty($username_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $username; ?>">
                <span class="invalid-feedback"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input id="button" type="submit" class="btn btn-primary" value="Login">
            </div>
        </form>
    </div>
</body>
</html>