<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$ID = $_SESSION['pilGuru'];

if(isset($_POST['btnHapus']))
{
    $st = "DELETE FROM t_guru WHERE ID ='$ID'";
    $qrySS = mysqli_query($conSS, $st);
    
    $st = "DELETE FROM t_gunor WHERE IdGuru ='$ID'";
    $qrySS = mysqli_query($conSS, $st);
}
else if (isset($_POST['btnNA']))
{
    $st = "UPDATE t_guru
              SET aktif = 'T'
           WHERE ID     = '$ID'";
    $qrySS = mysqli_query($conSS, $st);

}

echo "<script>window.location.replace(\"frmgurubah.php\");</script>";
exit();
?>