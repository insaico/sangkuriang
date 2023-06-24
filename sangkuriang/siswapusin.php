<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

if(isset($_POST['btnHapus']))
{
    $st     = "DELETE FROM t_siswa WHERE ID =". $_SESSION['pilSiswa'];
    $qrySS  = mysqli_query($conSS, $st);
}

echo "<script>window.location.replace(\"frmtari.php\");</script>";
exit();
?>