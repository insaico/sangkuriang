<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser'])){
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$kode = $_SESSION['pilTari'];
if(isset($_POST['btnHapus'])){
    $st     = "DELETE FROM t_tari WHERE kode = '$kode'";
    $qrySS  = mysqli_query($conSS, $st);
}else if(isset($_POST['btnNA'])){
    $st     = "UPDATE t_tari SET aktif = 'T' WHERE kode = '$kode'";
    $qrySS  = mysqli_query($conSS, $st);
}

echo "<script>window.location.replace(\"frmtari.php\");</script>";
exit();
