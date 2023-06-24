<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser'])){
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$_SESSION['salah'] = 0;
$aksi              = 0;

if(isset($_POST['btnTariU']))
{
    $pilTari = $_POST['btnTariU'];
    $aksi = 1;
}
elseif (isset($_POST['btnTariH']))
{
    $pilTari = $_POST['btnTariH'];
    $aksi = 2;
}
if ($aksi >= 1 && $aksi <= 2){
    $st = "SELECT * FROM t_tari WHERE kode = '$pilTari'";
    $qrySS = mysqli_query($conSS, $st);
    $data = mysqli_fetch_array($qrySS);

    $_SESSION['pilTari'] = $data['kode'];
    $_SESSION['nama'] = $data['nama'];
    $_SESSION['jenis'] = $data['jenis'];
    $_SESSION['lama'] = $data['lama'];
    $_SESSION['aktif'] = $data['aktif'];

    // menunggu pengjarnya dulu 
    $_SESSION['nGuru'] = 0;
    if ($_SESSION['nGuru'] < 1){
        $st = "UPDATE t_tari
                SET aktif = 'T'
               WHERE kode = '$pilTari'";

        $qrySS = mysqli_query($conSS, $st);
        $_SESSION['aktif'] = "T";
    }

    if ($aksi == 1){
        echo "<script>window.location.replace(\"frmtaribah.php\");</script>";
        exit();
    } else {
        echo "<script>window.location.replace(\"frmtaripus.php\");</script>";
        exit();
    }
} else {
    echo "<script>window.location.replace(\"frmtari.php\");</script>";
        exit();
}
?>