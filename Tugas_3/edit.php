<?php
session_start();

include 'koneksi.php';


if (!isset($_SESSION['nama'])) {

    header("Location: dashboard.php");
}

if ($_SESSION['nama'] != 'admin') {

    header("Location: dashboard.php");
}

if (!isset($_GET['id'])) {

    header("Location: dashboard.php");
}

$id = $_GET['id'];

$result = mysqli_query(
    $conn,
    "SELECT * FROM users
    WHERE id='$id'"
);

$data = mysqli_fetch_assoc($result);

if (!$data) {

    header("Location: dashboard.php");
}


if (isset($_POST['update'])) {

    $nama = $_POST['nama'];

    $password = password_hash(
        $_POST['password'],
        PASSWORD_DEFAULT
    );

    mysqli_query(
        $conn,
        "UPDATE users SET

        nama='$nama',
        password='$password'

        WHERE id='$id'"
    );

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Edit User</title>

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

<h3>Edit Data Pengguna</h3>

<form method="POST">

Nama Pengguna:

<br>

<input
type="text"
name="nama"
value="<?php echo $data['nama']; ?>">

<br><br>

Password Baru:

<br>

<input
type="password"
name="password"
placeholder="Masukkan password baru">

<br><br>

<button
type="submit"
name="update">

Simpan Perubahan

</button>

</form>

<br>

<a href="dashboard.php">

<button>
Batal
</button>

</a>

</div>

</body>
</html>
