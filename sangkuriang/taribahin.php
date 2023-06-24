<?php 
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$nama  = isset($_POST['txtNama'])  ? $_POST['txtNama'] : "";
$lama  = isset($_POST['txtLama'])  ? (int)$_POST['txtLama'] : 0;
$jenis = isset($_POST['cbbJenis']) ? $_POST['cbbJenis'] : "x";
$aktif = isset($_POST['cbbAktif']) ? $_POST['cbbAktif'] : "x";

$_SESSION['salah'] = 0;
if(strlen($nama) < 4) $_SESSION['salah'] = 1;
if($lama < 1)         $_SESSION['salah'] = 2;
if($jenis == "x")     $_SESSION['salah'] = 3;
if($aktif == "x")     $_SESSION['salah'] = 4;

if($_SESSION['salah'] == 0){
    $kode = $_SESSION['pilTari'];

    $st = "UPDATE t_tari 
              SET nama  = '" . addslashes($nama) . "',
                  jenis = '$jenis', 
                  lama  = '$lama',
                  aktif = '$aktif'
           WHERE kode   = '$kode'";
    $qrySS = mysqli_query($conSS, $st);
    echo "<script>window.location.replace(\"frmtari.php\");</script>";
    exit();
} else {
    echo "<script>window.location.replace(\"frmtaribah.php\");</script>";
    exit();
}
?>