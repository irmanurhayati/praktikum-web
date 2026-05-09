<?php
session_start();

include 'koneksi.php';

// PROTEKSI LOGIN
if (!isset($_SESSION['nama'])) {

    header("Location: auth.php");
}

// HAPUS USER
if (
    isset($_GET['hapus']) &&
    $_SESSION['nama'] == 'admin'
) {

    $id = $_GET['hapus'];

    mysqli_query(
        $conn,
        "DELETE FROM users
        WHERE id='$id'"
    );

    header("Location: dashboard.php");
}
?>

<!DOCTYPE html>
<html>

<head>

<title>Dashboard</title>

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

table{

    border-collapse:collapse;

    margin-top:10px;
}

table, th, td{

    border:1px solid black;

    padding:5px;

    font-size:12px;
}

button{

    font-size:11px;
}

</style>

</head>

<body>

<div class="container">

<h3>
Selamat Datang,
<?php echo $_SESSION['nama']; ?>!
</h3>

<a href="logout.php">

<button>
Logout
</button>

</a>

<hr>

<?php

if ($_SESSION['nama'] == 'admin') {

?>

<b>
Menu Admin: Kelola Pengguna
</b>

<table>

<tr>

    <th>ID</th>
    <th>Nama</th>
    <th>Aksi</th>

</tr>

<?php

$result = mysqli_query(
    $conn,
    "SELECT * FROM users"
);

while ($row = mysqli_fetch_assoc($result)) {

?>

<tr>

    <td>
        <?php echo $row['id']; ?>
    </td>

    <td>
        <?php echo $row['nama']; ?>
    </td>

    <td>

        <a href="edit.php?id=<?php echo $row['id']; ?>">

            <button>Edit</button>

        </a>

        <a href="dashboard.php?hapus=<?php echo $row['id']; ?>">

            <button>Hapus</button>

        </a>

    </td>

</tr>

<?php } ?>

</table>

<?php } ?>

</div>

</body>
</html>