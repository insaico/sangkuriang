<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $ID      = $_POST['txtID'];
    $nama    = isset($_POST['txtNama'])    ? ucwords(strtolower($_POST['txtNama']))    : "";
    $tpLahir = isset($_POST['txtTpLahir']) ? ucwords(strtolower($_POST['txtTpLahir'])) : "";
    $alamat  = isset($_POST['txtAlamat'])   ? ucwords(strtolower($_POST['txtAlamat']))   : "";
    $JK      = isset($_POST['cbbJK'])      ? $_POST['cbbJK'] : "x";
    $noHP    = isset($_POST['txtNoHP']) && (int) $_POST['txtNoHP'] > 0 ? $_POST['txtNoHP'] : "";

    $tggl    = date_create($_POST['txtTgLahir']);
    $tgLahir = date_format($tggl, "Y-m-d");

    // ambil tanggal hari ini 
    $tggl    = $_SESSION['harini'];
    $tgMasuk = date_format($tggl, "Y-m-d");

    $_SESSION['salah'] = 0;
    if (strlen($nama) < 4)    $_SESSION['salah'] = 1;
    if ($JK == "x")           $_SESSION['salah'] = 2;
    if (strlen($tpLahir) < 4) $_SESSION['salah'] = 3;
    if (strlen($alamat) < 4)  $_SESSION['salah'] = 4;
    if (strlen($noHP) < 4)    $_SESSION['salah'] = 5;

    if($_SESSION['salah'] == 0)
    {
        $st = "INSERT INTO t_siswa
                VALUES ('$ID'      , '".addslashes($nama)."',
                        '$JK'      , '".addslashes($tpLahir)."',
                        '$tgLahir' , '".addslashes($alamat)."',
                        '$noHP'    , '$tgMasuk')";

        $qrySS = mysqli_query($conSS, $st);

        $_SESSION['pilSiswa'] = $ID;
        $_SESSION['nmSiswa']  = $nama;

        echo "<script>window.location.replace(\"frmsiswa.php\");</script>";
        exit();
    }
    else
    {
        echo "<script>window.location.replace(\"frmsiswatam.php\");</script>";
        exit();
    }
?>