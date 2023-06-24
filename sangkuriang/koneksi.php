<?php
$conSS = mysqli_connect("localhost", "root", "", "sangkuriang");

if (mysqli_connect_error()) {
    die("Tidak dapat menghubungi server: " . mysqli_connect_error());
}
?>
