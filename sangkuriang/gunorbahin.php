<?php 
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$aktif = isset($_POST['cbbAktif']) ? $_POST['cbbAktif'] : "x";
$jenis = isset($_POST['cbbJenis']) ? $_POST['cbbJenis'] : "x";
$GaPok = isset($_POST['txtGaPok']) && (int)$_POST['txtGaPok'] > 0 ? $_POST['txtGaPok'] : 0;
$idxHR = isset($_POST['txtIdxHR']) && (int)$_POST['txtIdxHR'] > 0 ? $_POST['txtIdxHR'] : 0;

$tggl = date_create($_POST['txtTgMasuk']);
$tgMasuk = date_format($tggl, "Y-m-d");

$_SESSION['salah'] = 0;
if($aktif == "x") $_SESSION['salah'] = 1;
if($jenis == "x") $_SESSION['salah'] = 2;
if($idxHR < 1000) $_SESSION['salah'] = 3;

if ($jenis == "F")
{
    if ($GaPok < 1000) $_SESSION['salah'] = 4;
}
else $GaPok = 0;

if ($_SESSION['salah'] == 0)
{
    $ID = $_SESSION['pilGuru'];

    $st = "UPDATE t_guru
             SET aktif = '$aktif'
           WHERE ID    = '$ID'";

    $qrySS = mysqli_query($conSS, $st);

    $st = "UPDATE t_gunor
              SET tgMasuk   = '$tgMasuk',
                    GaPok   = '$GaPok',
                    idxHR   = '$idxHR',
            WHERE idGuru    = '$ID'";
    
    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmgunor.php\");</script>";
    exit();
}
else
{
    echo "<script>window.location.replace(\"frmgunorbah.php\");</script>";
    exit();
}
?>