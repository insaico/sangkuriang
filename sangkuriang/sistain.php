<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $periode = $_POST['txtPeriode'];
    $idSiswa = $_POST['txtID'];
    $idTari = $_POST['cbbTari'];
    $metode = $_POST['cbbMetode'];

    $st = "INSERT INTO t_sista
            VALUES ('$periode','$idSiswa','$idTari','$metode','-')";
    
    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmsiswa.php\");</script>";
    exit();
?>