<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 210;
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="google" value="notranslate">
    <meta name="robots" content="nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Sangkuriang">
    <meta name="author" content="M. Arya & M. Yoga">
    <link rel="icon" href="alat2/sangkuriang.ico">

    <title>Sangkuriang</title>
    
    <link rel="stylesheet" href="alat2/styles.css">
    <link rel="stylesheet" href="alat2/bootstrap-datepicker.standalone.min.css">
    <link rel="stylesheet" href="alat2/all.min.css">
    <style>
        select, input, span{
            margin-bottom: 0.2rem;
        }
    </style>
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php"; ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Biodata Pengajar</h4>

                    <div class="form-group row">
                        <label for="txtNama" class="col-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="txtNama"
                            value="<?= $_SESSION['nmGuru']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtJK" class="col-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-2">
                            <input name="txtJK" type="text" class="form-control" value="<?php 
                                switch($_SESSION['JK'])
                                {
                                    case "P" : echo "Pria"; break;
                                    case "W" : echo "Wanita";
                                }
                                ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtTpLahir" class="col-2 col-form-label">Tempat Lahir</label>
                        <div class="col-3">
                            <input type="text" class="form-control" name="txtTpLahir"
                                value="<?= $_SESSION['tpLahir']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtTgLahir" class="col-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-2">
                            <input type="text" class="form-control" name="txtTgLahir"
                                value="<?= $_SESSION['tgLahir']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtAlamat" class="col-2 col-form-label">Alamat</label>
                        <div class="col-4">
                            <input type="text" class="form-control" name="txtAlamat"
                                value="<?= $_SESSION['alamat']; ?>" readonly>
                        </div>
                    </div>
                   
                    <div class="form-group row">
                        <label for="txtNoHP" class="col-2 col-form-label">Nomor HP</label>
                        <div class="col-2">
                            <input type="text" class="form-control" name="txtNoHP"
                                value="<?= $_SESSION['noHP']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtAktif" class="col-2 col-form-label">Aktif</label>
                        <div class="col-2">
                            <input name="txtAktif" type="text" class="form-control" value="<?php 
                                switch($_SESSION['aktif'])
                                {
                                    case "Y" : echo "Ya"; break;
                                    case "T" : echo "Tidak";
                                }
                                ?>" readonly>
                        </div>
                    </div>

                    <br>
                    <a href="frmguru.php" class="btn btn-sm btn-secondary">
                        <i class="fas fa-arrow-left"></i> Kembali</a>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Kurniawan.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
</body>
</html>