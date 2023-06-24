<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

if (isset($_POST['btnSimpan'])) {
    if (isset($_POST['lstTambah'])) {
        foreach ($_POST['lstTambah'] as $idTari) {
            $st = "INSERT INTO t_guri (idGuru, idTari)
                    VALUES ('".$_SESSION['pilGuru']."', '$idTari')";

            $qrySS = mysqli_query($conSS, $st);
        }
    }

    if (isset($_POST['lstHapus'])) {
        foreach ($_POST['lstHapus'] as $idTari) {
            $st = "DELETE FROM t_guri
                    WHERE idGuru = '".$_SESSION['pilGuru']."'
                        AND idTari = '$idTari'";

            $qrySS = mysqli_query($conSS, $st);
        }
    }
}

echo "<script>window.location.replace(\"frmguri.php\");</script>";
exit();
?>
