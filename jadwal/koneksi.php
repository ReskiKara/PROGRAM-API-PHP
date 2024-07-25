<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "db_jadwal";

$mysqli = mysqli_connect($server, $user, $password, $database);

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
} else {
   // echo "Connection berhasil";
}
?>
