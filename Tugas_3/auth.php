<?php
session_start();

include 'koneksi.php';


if (isset($_POST['register'])) {

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,
        "INSERT INTO users(nama,password)
        VALUES('$nama','$password')"
    );

    echo "Register berhasil";
}


if (isset($_POST['login'])) {

    $nama = $_POST['nama'];

    $password = $_POST['password'];

    $result = mysqli_query(
        $conn,
        "SELECT * FROM users
        WHERE nama='$nama'"
    );

    $data = mysqli_fetch_assoc($result);

    if ($data) {

        if (
            password_verify(
                $password,
                $data['password']
            )
        ) {

            $_SESSION['nama'] = $data['nama'];

            header("Location: dashboard.php");
        } else {

            echo "Password salah";
        }

    } else {

        echo "User tidak ditemukan";
    }
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Login</title>

<style>

body{

    margin:0;

    font-family:Times New Roman;

    background:white;
}

.container{

    width:100%;

    min-height:100vh;

    border:2px solid #23395d;

    padding:5px;

    background:white;
}

input{

    width:150px;
}

button{

    font-size:11px;
}

</style>

</head>

<body>

<div class="container">

<h3>Register</h3>

<form method="POST">

Nama Pengguna:

<br>

<input
type="text"
name="nama">

<br><br>

Password:

<br>

<input
type="password"
name="password">

<br><br>

<button
type="submit"
name="register">

Register

</button>

</form>

<hr>

<h3>Login</h3>

<form method="POST">

Nama Pengguna:

<br>

<input
type="text"
name="nama">

<br><br>

Password:

<br>

<input
type="password"
name="password">

<br><br>

<button
type="submit"
name="login">

Login

</button>

</form>

</div>

</body>
</html>
