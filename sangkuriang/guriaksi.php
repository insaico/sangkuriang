<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$aksi = 0;

if (isset($_POST['btnGuruU'])) {
    $pilGuru = $_POST['btnGuruU'];
    $aksi = 1;
}

if ($aksi == 1) {
    $st = "SELECT * FROM t_guru WHERE ID = '$pilGuru'";

    $qrySS = mysqli_query($conSS, $st);
    $data = mysqli_fetch_array($qrySS);

    $_SESSION['pilGuru'] = $data['ID'];
    $_SESSION['nmGuru'] = $data['nama'];
    $_SESSION['aktif'] = $data['aktif'];

    echo "<script>window.location.replace(\"frmguribah.php\");</script>";
    exit();
} else {
    echo "<script>window.location.replace(\"frmguri.php\");</script>";
    exit();
}
?>
