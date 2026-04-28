?php

$conn = mysqli connect("localhost",

"root",

"praktiku_crud");

if (!$conn) {

die("Connection failed: ". mysqli_connect_error());
}
?>