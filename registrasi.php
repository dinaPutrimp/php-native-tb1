<?php
$database_name = "book";
$con = mysqli_connect("localhost","root","",$database_name);

function registrasi($data){
    global $con;

    $username = strtolower(stripslashes($data["username"]));
    $password = mysqli_real_escape_string($con, $data["password"]);
    $password2 = mysqli_real_escape_string($con, $data["password2"]);

    //cek usernamesudah ada atau belum
    $result = mysqli_query($con, "SELECT username FROM user WHERE username = '$username'");
    if(mysqli_fetch_assoc($result)){
        echo "<script>
                alert('username sudah terdaftar');
        </script>";
        return false;
    }


    // cek konfirmasi password
    if($password !== $password2){
        echo "<script>
                alert('konfirmasi password tidak sama');
        </script>";
        return false;
    }
    // enkripsi password
    $password = password_hash($password, PASSWORD_DEFAULT);

    //tambahkan user baru ke database
    mysqli_query($con, "INSERT INTO user VALUES('','$username','$password')");

    return mysqli_affected_rows($con);
}

// jika tombol register ditekan
if(isset($_POST["register"])){
    if(registrasi($_POST) > 0){
        echo "
        <script>
            alert('userbaru berhasil ditambahkan');
        </script>";
        echo '<script>window.location="login.php"</script>';
    } else {
        echo mysqli_error($con);
    }
}

?>

<html>
<head>
    <title>Registrasi</title>
    <style>
        body{
            background-color: dimgray;
        }

        * {box-sizing: border-box}

            .kotak {
            padding: 16px;
            width: 40%;
            background-color: white;
            margin: 0 auto;
            margin-top: 80px;
            }

            input[type=text], input[type=password] {
            width: 100%;
            padding: 15px;
            margin: 5px 0 22px 0;
            display: inline-block;
            border: none;
            background: #f1f1f1;
            }

            input[type=text]:focus, input[type=password]:focus {
            background-color: #ddd;
            outline: none;
            }

            hr {
            border: 1px solid #f1f1f1;
            margin-bottom: 25px;
            }

            .register {
            background-color: darkolivegreen;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 100%;
            opacity: 0.9;
            }

            .register:hover {
            opacity:1;
            }
    </style>
</head>
<body>

<div>
    <form action="" method="post">
            <div class="kotak">
                <h1>Registrasi</h1>
                <hr>

                <label for="username"><b>Username</b></label>
                <input type="text" placeholder="Username" name="username" id="username">
                <br />
                <label for="password"><b>Password</b></label>
                <input type="password" placeholder="Password" name="password" id="password">
                <br />
                <label for="password2"><b>Ulangi Password</b></label>
                <input type="password" placeholder="Ulangi Password" name="password2" id="password2">
                <hr>

                <button type="submit" class="register" name="register">Register</button>
            </div>
    </form>
    </div>
</body>
</html>