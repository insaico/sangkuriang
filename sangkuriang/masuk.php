<?php
session_start();
include "koneksi.php";

if (!isset($_POST['txtNama'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

if ($_POST['txtNama'] != '') {
    $_SESSION['namaUser'] = $_POST['txtNama'];

    $st = "SELECT MAX(`Periode`) AS Prd FROM t_sista";
    $qrySS = mysqli_query($conSS, $st);

    if ($qrySS === false) {
        die("Error: " . mysqli_error($conSS));
    }

    $data = mysqli_fetch_array($qrySS);

    $_SESSION['Periode'] = ($data['Prd'] > "0") ? $data['Prd'] : "2000";

    echo "<script>window.location.replace(\"frmawal.php\");</script>";
    exit();
} else {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}
?>
