<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$nama = isset($_POST['txtNama']) ? ucwords(strtolower($_POST['txtNama'])) : "";
$lama = isset($_POST['txtLama']) ? (int) $_POST['txtLama'] : 0;
$jenis = isset($_POST['cbbJenis']) ? $_POST['cbbJenis'] : "x";

$_SESSION['salah'] = 0;
if(strlen($nama) < 4) $_SESSION['salah'] = 1;
if($lama < 4) $_SESSION['salah'] = 2;
if($jenis == "x") $_SESSION['salah'] = 3;

if($_SESSION['salah'] == 0)
{
    $huruf = strtoupper(substr($nama, 0, 2));

    $st = "SELECT MAX(SUBSTR(kode, 3, 2)) AS Nomor
            FROM t_tari
            WHERE LEFT(kode, 2) = '$huruf'";
    
    $qrySS = mysqli_query($conSS, $st);
    $data = mysqli_fetch_array($qrySS);

    $kode = $huruf . str_pad($data['Nomor']+1, 2, "0", 0);

    $st = "INSERT INTO t_tari
            VALUES ('$kode', '".addslashes($nama)."',
                    '$jenis', '$lama', 'T')";
    
    $qrySS = mysqli_query($conSS, $st);

    echo "<script>window.location.replace(\"frmtari.php\");</script>";
    exit();
}
else
{
    echo "<script>window.location.replace(\"frmtaritam.php\");</script>";
    exit();
}
?>