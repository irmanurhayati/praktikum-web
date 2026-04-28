<!DOCTYPE html>

<html>

<head>

meta charset="UTF-8"

<meta name="viewport" content="width=device-width, initial-scale=1.0" />

href=""

rel="stylesheet"

<title>CRUD</title>

</head>

<body>

<?php

include 'koneksi.php';

//create

if(isset($_POST['create'])){

$nama = $_POST['nama'];

mysqli_query ($conn, "INSERT INTO mahasiswa (nama) VALUES ('$nama')") ;

} 

//update
if(isset($_POST['update'])){
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    mysql_query($conn, "UPDATE mahasiswa Set nama = '$nama' WHERE 'id=$id'");
}

//edit
$edit = false;
if(isset($_GET['edit'])){
    $edit = true;
    $id = $_GET['id'];
    $result = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE id='$id'");
}

//delete
if(isset($_GET['delete'])) {
    $id = $_GET['id'];
    mysqli_query($conn, "DELETE FROM mahasiswa WHERE id = '$id'");
}
?> 
<h1>CRUD SEDERHANA</h1>

<form method="POST">
    <label for="nama">Nama: </label>
    <input type="hidden" name="id" value="<?=  $edit ? $row['id']: '' ?> ">
    <input type="text" name="nama" value="<?=  $edit ? $row['id']: '' ?> ">
    <input type="submit" name="submit" value="Simpan">

    <?php if($edit): ?>
        <button type="submit" name ="update">update</button>
        <?php else: ?>
        <button type="submit" name="create">tambah</button>
        <?php endif; ?>

</form>

<table border="1">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Aksi</th>
    </tr>

    <?php
    // read
    $data = mysqli_query($conn, "SELECT * FROM mahasiswa");
    $no = 1;

    while($d = mysqli_fetch_assoc($data)){
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $d['nama']; ?></td>
            <td>
                <a href="?edit=<?= $d['id']; ?>">Edit</a>
                <a href="?delete=<?= $d['id']; ?>" onclick="return confirm('Yakin mau hapus?')">Delete</a>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>