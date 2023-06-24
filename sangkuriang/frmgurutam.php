<?php
session_start();
include "koneksi.php";
if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}
$idMenu = 21;
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
    <link rel="icon" href="alat2/all.min.css">
    <style>
        select,
        input,
        span {
            margin-bottom: 0.2rem;
        }

        .input-group-append {
            cursor: pointer;
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
                    <h4 class="mt-4">Pengajar</h4>

                    <?php if (isset($_SESSION['salah']) && $_SESSION['salah'] > 0) : ?>
                        <div class="alert alert-danger my-4">
                            Harap diisi dengan lengkap dan benar.
                        </div>
                        <?php unset($_SESSION['salah']); ?>
                    <?php endif ?>

                    <form method="post" action="gurutamin.php">
                        <div class="form-group row">
                            <label for="txtNama" class="col-2 col-form-label">Nama Pengajar</label>
                            <div class="col-4">
                                <input type="text" name="txtNama" class="form-control" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbJK" class="col-2 col-form-label">Jenis Kelamin</label>
                            <div class="col-2">
                                <select name="cbbJK" class="form-control">
                                    <option value="P">Pria</option>
                                    <option value="W">Wanita</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtTpLahir" class="col-2 col-form-label">Tempat Lahir</label>
                            <div class="col-3">
                                <input type="text" name="txtTpLahir" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtTgLahir" class="col-2 col-form-label">Tanggal Lahir</label>
                            <div class="col-2">
                                <div class="input-group date" id="dtpTgLahir">
                                    <input type="text" name="txtTgLahir" class="form-control bg-white" 
                                        value="<?= date_format($_SESSION['harini'], "d-m-Y"); ?>" readonly>
                                    <span class="input-group-append">
                                        <div class="input-group-text d-block bg-white">
                                            <i class="far fa-calendar"></i>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtAlamat" class="col-2 col-form-label">Alamat</label>
                            <div class="col-4">
                                <input type="text" name="txtAlamat" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtNoHP" class="col-2 col-form-label">Nomor HP</label>
                            <div class="col-2">
                                <input type="text" name="txtNoHP" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-2"></div>
                            <div class="col">
                                <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                    <i class="fas fa-save"></i> Simpan
                                </button>
                                <a href="frmguru.php" class="btn btn-sm btn-secondary ms-2"> <i class="fas fa-ban"></i> Batalkan</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Prasta.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
    <script src="alat2/jquery.min.js"></script>
    <script src="alat2/bootstrap-datepicker.min.js"></script>
    <script src="alat2/bootstrap-datepicker.id.min.js"></script>
    <script>
        $(function() {
            $('#dtpTgLahir').datepicker({
                format: "dd-mm-yyyy",
                language: "id",
                orientation: "bottom left",
                autoclose: true,
                todayHighlight: true,
                immediateUpdates: true,
                disableTouchKeyboard: true
            });
        });
    </script>
</body>
