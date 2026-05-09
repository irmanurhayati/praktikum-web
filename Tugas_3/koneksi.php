<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "pemweb"
);

if (!$conn) {

    die("Koneksi gagal");
}

?>