<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 230;
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
        select, input, span {
            margin-bottom: 0.2rem;
        }
        .input-group-append {
            cursor: pointer;
        }
    </style>
    <script src="alat2/all.min.js"></script>
</head>

<body class="sb-nav-fixed">
    <?php include "ss_menuatas.php" ?>
    
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Honor Pengajar</h4>
                    
                    <?php if(isset($_SESSION['salah']) && $_SESSION['salah'] > 0) : ?>
                        <div class="alert alert-danger my-4">
                            Harap diisi dengan lengkap dan benar.
                        </div>
                    <?php endif; ?>

                    <div class="form-group row">
                        <label for="txtNama" class="col-2 col-form-label">Nama Pengajar</label>
                        <div class="col-4">
                            <input class="form-control" name="txtNama" type="text"
                                    value="<?= $_SESSION['nmGuru']; ?>" readonly>
                        </div>
                    </div>

                    <form method="post" action="gunorbahin.php">
                        <div class="form-goup row">
                            <label for="cbbAktif" class="col-2 col-form-label">Aktif</label>
                            <div class="col-2">
                                <select class="form-control" name="cbbAktif">
                                    <option <?php 
                                        if($_SESSION['aktif'] == "Y") echo "selected='selected'";
                                        ?>value="Y">Ya
                                    </option>
                                    <option <?php 
                                        if($_SESSION['aktif'] != "Y") echo "selected='selected'";
                                        ?>value="T">Tidak
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbJenis" class="col-2 col-form-label">Jenis Pengajar</label>
                            <div class="col-2">
                                <select class="form-control" name="cbbJenis" >
                                    <option <?php 
                                        if($_SESSION['jenis'] == "F") echo "selected='selected'";
                                        ?>value="F">Full-time
                                    </option>
                                    <option <?php 
                                        if($_SESSION['jenis'] != "P") echo "selected='selected'";
                                        ?>value="P">Part-time
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtTgMasuk" class="col-2 col-form-label">Tanggal Masuk</label>
                            <div class="col-2">
                                <div class="input-group date" id="dtpTgMasuk">
                                    <input class="form-control bg-white" name="txtTgMasuk" type="text" 
                                        value="<?= $_SESSION['tgMasuk']; ?>" readonly>
                                    <span class="input-group-append">
                                        <div class="input-group-text d-block bg-white">
                                            <i class="far fa-calendar"></i>
                                        </div>
                                    </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="txtGaPok" class="col-2 col-form-label">Gaji Pokok</label>
                            <div class="col-2">
                               <input class="form-control" name="txtGaPok" type="text"
                                    value="<?= $_SESSION['GaPok']; ?>">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="txtIdxHR" class="col-2 col-form-label">Indeks Honor</label>
                            <div class="col-2">
                                <input class="form-control" name="txtIdxHR" type="text"
                                    value="<?= $_SESSION['idxHR']; ?>">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-2"></div>
                            <div class="col">
                                <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                    <i class="fas fa-save"></i> Simpan</button>
                                <a href="frmgunor.php" class="btn btn-sm btn-secondary ms-2">
                                    <i class="fas fa-ban"></i> Batalkan</a>
                            </div>
                        </div>
                    </form>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-item-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Kurniawan.unigamalang</div>
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
        $(function(){
            $('#dtpTgMasuk').datepicker({
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
</html>