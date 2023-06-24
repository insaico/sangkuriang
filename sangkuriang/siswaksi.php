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

    if(isset($_POST['btnSiswaU']))
    {
        $pilSiswa = $_POST['btnSiswaU'];
        $aksi     = 1;
    }
    elseif (isset($_POST['btnSiswaH']))
    {
        $pilSiswa = $_POST['btnSiswaH'];
        $aksi     = 2;
    }
    elseif (isset($_POST['btnSiswaL']))
    {
        $pilSiswa = $_POST['btnSiswaL'];
        $aksi     = 3;
    }

    if ($aksi >= 1 && $aksi <=3)
    {
        $st    = "SELECT * FROM t_siswa WHERE ID = '$pilSiswa'";
        $qrySS = mysqli_query($conSS, $st);
        $data  = mysqli_fetch_array($qrySS);

        $_SESSION['pilSiswa'] = $data['ID'];
        $_SESSION['nmSiswa'] = $data['nama'];
        $_SESSION['JK'] = $data['JK'];
        $_SESSION['tpLahir'] = $data['tpLahir'];
        $_SESSION['alamat'] = $data['alamat'];
        $_SESSION['noHP'] = $data['noHP'];

        $tgLahir = strtotime($data['tgLahir']);
        if($tgLahir != "")
        {
            $tggl    = date_create($data['tgLahir']);
            $tgLahir = date_format($tggl, "d-m-Y");
        }
        $_SESSION['tgLahir'] = $tgLahir;

        $tgMasuk = strtotime($data['tgMasuk']);
        if($tgMasuk != "")
        {
            $tggl    = date_create($data['tgMasuk']);
            $tgMasuk = date_format($tggl, "d-m-Y");
        }
        $_SESSION['tgMasuk'] = $tgMasuk;

        if ($aksi == 1)
        {
            echo "<script>window.location.replace(\"frmsiswabah.php\");</script>";
            exit();
        }
        elseif ($aksi == 2)
        {
            echo "<script>window.location.replace(\"frmsiswapus.php\");</script>";
            exit();
        }
        else
        {
            echo "<script>window.location.replace(\"frmsiswahat.php\");</script>";
            exit();
        }
    }
    else
    {
        echo "<script>window.location.replace(\"frmsiswa.php\");</script>";
        exit();
    }
?>