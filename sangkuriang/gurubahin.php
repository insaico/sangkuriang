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
$aktif = isset($_POST['cbbAktif']) ? $_POST['cbbAktif'] : "x";
$noHP = isset($_POST['txtNoHP']) && (int)$_POST['txtNoHP'] > 0 ? $_POST['txtNoHP'] : "";

$tggl = date_create($_POST['txtTgLahir']);
$tgLahir = date_format($tggl,"Y-m-d");

$_SESSION['salah'] = 0;
if(strlen($nama) < 4) $_SESSION['salah'] = 1;
if(strlen($tpLahir) < 4) $_SESSION['salah'] = 2;
if(strlen($alamat) < 4) $_SESSION['salah'] = 3;
if(strlen($noHP) < 4) $_SESSION['salah'] = 4;
if($JK == "x") $_SESSION['salah'] = 5;
if($aktif == "x") $_SESSION['salah'] = 6;

if($_SESSION['salah'] == 0)
{
    $ID = $_SESSION['pilGuru'];

    $st = "UPDATE t_guru
              SET nama = '".addslashes($nama)."',
                  alamat = '".addslashes($alamat)."',
                  tpLahir = '".addslashes($tpLahir)."',
                  tgLahir = '$tgLahir',
                  JK = '$JK',
                  noHP = '$noHP',
                  aktif = '$aktif'
            WHERE ID = '$ID'";

    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmguru.php\");</script>";
    exit();
}
else
{
    echo "<script>window.location.replace(\"frmgurubah.php\");</script>";
    exit();
}
?>
