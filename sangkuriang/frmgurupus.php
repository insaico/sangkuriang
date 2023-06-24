<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
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
        select, input, span {
            margin-bottom: 0.2rem;
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
                    <h4 class="mt-4">Pengajar</h4>
                    
                    <div class="form-group row">
                        <label for="txtNama" class="col-2 col-form-label">Nama Pengajar</label>
                        <div class="col-4">
                            <input name="txtNama" type="text" class="form-control"
                                value="<?= $_SESSION['nmGuru']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtJK" class="col-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-2">
                            <input name="txtJK" type="text" class="form-control" value="<?php 
                                switch ($_SESSION['JK'])
                                {
                                    case "P" : echo "Pria"; break;
                                    case "W" : echo "Wanita";
                                }?> " readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtTpLahir" class="col-2 col-form-label">Tempat Lahir</label>
                        <div class="col-3">
                            <input name="txtTpLahir" type="text" class="form-control"
                                value="<?= $_SESSION['tpLahir']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtTgLahir" class="col-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-2">
                            <input name="txtTgLahir" type="text" class="form-control"
                                value="<?= $_SESSION['tgLahir']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtAlamat" class="col-2 col-form-label">Alamat</label>
                        <div class="col-4">
                            <input name="txtAlamat" type="text" class="form-control"
                                value="<?= $_SESSION['alamat']; ?>" readonly>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="txtNoHP" class="col-2 col-form-label">Nomor HP</label>
                        <div class="col-4">
                            <input name="txtNoHP" type="text" class="form-control"
                                value="<?= $_SESSION['noHP']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtAktif" class="col-2 col-form-label">Aktif</label>
                        <div class="col-2">
                            <input name="txtAktif" type="text" class="form-control" value="<?php 
                                switch ($_SESSION['aktif'])
                                {
                                    case "Y" : echo "Ya"; break;
                                    case "T" : echo "Tidak";
                                }?> " readonly>
                        </div>
                    </div>

                    <?php 
                        $st    = "SELECT 1 FROM t_guri WHERE idGUru = '".$_SESSION['pilGuru']."'";
                        $qrySS = mysqli_query($conSS, $st);
                        $ada   = mysqli_num_rows($qrySS);
                    ?>
                    <form method="post" action="gurupusin.php">
                        <?php if ($ada > 0) : ?>
                            <br>
                            <div class="alert alert-danger">
                                Data tidak boleh dihapus.
                                <button class="btn btn-sm btn-primary" name="btnHapus" type="submit">
                                    <i class="fas fa-trash-alt"></i> Hapus</button>
                                <a href="frmguru.php" class="btn btn-sm btn-secondary ms-2">
                                    <i class="fas fa-ban"></i> Batalkan</a>
                            </div>
                        <?php else : ?>
                            <div class="form-group row mt-2">
                                <div class="col-2"></div>
                                <div class="col">
                                    <button class="btn btn-sm btn-primary" name="btnHapus" type="submit">
                                        <i class="fas fa-trash-alt"></i> Hapus</button>
                                    <a href="frmguru.php" class="btn btn-sm btn-secondary ms-2">
                                        <i class="fas fa-ban"></i> Batalkan</a>
                                </div>
                            </div>
                        <?php endif ; ?>
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
</body>
</html>