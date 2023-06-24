<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$nama = isset($_POST['txtNama']) ? $_POST['txtNama'] : "";
$tpLahir = isset($_POST['txtTpLahir']) ? $_POST['txtTpLahir'] : "";
$alamat = isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : "";
$JK = isset($_POST['cbbJK']) ? $_POST['cbbJK'] : "x";
$noHP = isset($_POST['txtNoHP']) && (int)$_POST['txtNoHP'] > 0 ? $_POST['txtNoHP'] : "";

$tggl = date_create($_POST['txtTgLahir']);
$tgLahir = date_format($tggl,"Y-m-d");
$tggl = date_create($_POST['txtTgMasuk']);
$tgMasuk = date_format($tggl,"Y-m-d");

$_SESSION['salah'] = 0;
if(strlen($nama) < 4) $_SESSION['salah'] = 1;
if(strlen($tpLahir) < 4) $_SESSION['salah'] = 2;
if(strlen($alamat) < 4) $_SESSION['salah'] = 3;
if(strlen($noHP) < 4) $_SESSION['salah'] = 4;
if($JK == "x") $_SESSION['salah'] = 5;

if($_SESSION['salah'] == 0)
{
    $ID = $_SESSION['pilSiswa'];

    $st = "UPDATE t_siswa
              SET nama = '".addslashes($nama)."',
                  alamat = '".addslashes($alamat)."',
                  tpLahir = '".addslashes($tpLahir)."',
                  tgLahir = '$tgLahir',
                  tgMasuk = '$tgMasuk',
                  JK = '$JK',
                  noHP = '$noHP'
            WHERE ID = '$ID'";

    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmsiswa.php\");</script>";
    exit();
}
else
{
    echo "<script>window.location.replace(\"frmsiswabah.php\");</script>";
    exit();
}
?>