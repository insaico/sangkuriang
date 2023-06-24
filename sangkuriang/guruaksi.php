<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$_SESSION['salah'] = 0;
$aksi              = 0;

if (isset($_POST['btnGuruU']))
{
    $pilGuru = $_POST['btnGuruU'];
    $aksi    = 1;
} 
elseif (isset($_POST['btnGuruH']))
{
    $pilGuru = $_POST['btnGuruH'];
    $aksi    = 2;
}
elseif (isset($_POST['btnGuruL']))
{
    $pilGuru = $_POST['btnGuruL'];
    $aksi    = 3;
}

if ($aksi >= 1 && $aksi <= 3)
{
    $st    = "SELECT * FROM t_guru WHERE ID = '$pilGuru' ";
    $qrySS = mysqli_query($conSS, $st);
    $data  = mysqli_fetch_array($qrySS);

    $_SESSION['pilGuru'] = $data['ID'];
    $_SESSION['nmGuru']  = $data['nama'];
    $_SESSION['JK']      = $data['JK'];
    $_SESSION['tpLahir'] = $data['tpLahir'];
    // $_SESSION['tgLahir'] = $data['tgLahir'];
    $_SESSION['alamat']  = $data['alamat'];
    $_SESSION['noHP']    = $data['noHP'];
    $_SESSION['aktif']   = $data['aktif'];

    $tgLahir = strtotime($data['tgLahir']);
    if ($tgLahir != "")
    {
        $tggl = date_create($data['tgLahir']);
        $tgLahir = date_format($tggl, "d-m-Y");
    }
    $_SESSION['tgLahir'] = $tgLahir;

    if ($aksi == 1) {
        echo "<script>window.location.replace(\"frmgurubah.php\");</script>";
        exit();
    } elseif ($aksi == 2){
        echo "<script>window.location.replace(\"frmgurupus.php\");</script>";
        exit();
    } else {
        echo "<script>window.location.replace(\"frmguruhat.php\");</script>";
        exit();
    }
} else {
    echo "<script>window.location.replace(\"frmguru.php\");</script>";
    exit();
}
?>
