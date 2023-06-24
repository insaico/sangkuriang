<?php 
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
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

if($aksi == 1)
{
    $st    = "SELECT ID, nama, aktif, t_gunor.*
                FROM t_guru LEFT JOIN t_gunor ON t_guru.ID = t_gunor.idGuru
              WHERE ID = '$pilGuru'";
    
    $qrySS = mysqli_query($conSS, $st);
    $data  = mysqli_fetch_array($qrySS);

    $_SESSION['pilGuru'] = $data['ID'];
    $_SESSION['nmGuru'] = $data['nama'];
    $_SESSION['jenis'] = $data['jenis'];
    $_SESSION['GaPok'] = $data['GaPok'];
    $_SESSION['idxHR'] = $data['idxHR'];
    $_SESSION['aktif'] = $data['aktif'];

    $tgMasuk = strtotime($data['tgMasuk']);
    if($tgMasuk != "")
    {
        $tggl    = date_create($data['tgMasuk']);
        $tgMasuk = date_format($tggl, "d-m-Y");
    }
    $_SESSION['tgMasuk'] = $tgMasuk;

    echo "<script>window.location.replace(\"frmgunorbah.php\");</script>";
    exit();
}
else
{
    echo "<script>window.location.replace(\"frmgunor.php\");</script>";
    exit();
}
?>