<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$nama      = isset($_POST['txtNama'])    ? ucwords(strtolower($_POST['txtNama']))    : "";
$tpLahir   = isset($_POST['txtTpLahir']) ? ucwords(strtolower($_POST['txtTpLahir'])) : "";
$alamat    = isset($_POST['txtAlamat'])  ? ucwords(strtolower($_POST['txtAlamat']))  : "";
$JK        = isset($_POST['cbbJK'])      ? $_POST['cbbJK'] : "x";
$noHP      = isset($_POST['txtNoHP']) && (int)$_POST['txtNoHP'] > 0 ? $_POST['txtNoHP'] : "";

$tggl      = date_create($_POST['txtTgLahir']);
$tgLahir   = date_format($tggl, "Y-m-d");

// ambil tanggal hari ini 
$tggl      = $_SESSION['harini'];
$tgMasuk   = date_format($tggl, "Y-m-d");

$_SESSION['salah'] = 0;
if (strlen($nama) < 4)    $_SESSION['salah'] = 1;
if ($JK == "x")           $_SESSION['salah'] = 2;
if (strlen($tpLahir) < 4) $_SESSION['salah'] = 3;
if (strlen($alamat) < 4)  $_SESSION['salah'] = 4;
if (strlen($noHP) < 4)    $_SESSION['salah'] = 5;

if ($_SESSION['salah'] == 0)
{
    $huruf = strtoupper(substr($nama, 0, 2));

    $st = "SELECT MAX(SUBSTR(ID, 3, 2)) AS Nomor 
            FROM t_guru
            WHERE LEFT(ID, 2) = '$huruf'";

    $qrySS = mysqli_query($conSS, $st);
    $data  = mysqli_fetch_array($qrySS);

    $ID = $huruf . str_pad($data['Nomor']+1, 2, "0", 0);
    
    $st = "INSERT INTO t_guru
           VALUES ('$ID'    , '" . addslashes($nama) . "'   ,
                  '$JK'     , '" . addslashes($tpLahir) . "',
                  '$tgLahir', '" . addslashes($alamat) . "' ,
                  '$noHP'   ,'Y')"; // aktifkan salah satu Y/T

    $qrySS = mysqli_query($conSS, $st);

    $st = "INSERT INTO t_gunor
            VALUES ('$ID', '?', '$tgMasuk', 0, 0)";
            
    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmguru.php\");</script>";
    exit();
} 
else
{
    echo "<script>window.location.replace(\"frmgurutam.php\");</script>";
    exit();
}
?>