<?php 
    session_start();
    include "koneksi.php";
    include "modul.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 311;
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
                    <h4 class="mt-4">Pendaftaran Latihan Tari</h4>

                    <form method="post" action="sistain.php">
                        <div class="form-group row">
                            <label for="txtID" class="col-2 col-form-label">Nomor Registrasi</label>
                            <div class="col-2">
                                <input class="form-control" name="txtID" type="text"
                                        value="<?= $_SESSION['pilSiswa']; ?>" readonly>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="txtNama" class="col-2 col-form-label">Nama Siswa</label>
                            <div class="col-4">
                                <input class="form-control" name="txtNama" type="text" 
                                    value="<?= $_SESSION['nmSiswa']; ?>" readonly>
                            </div>
                        </div>
                        <br>

                        <div class="form-group row">
                            <label for="cbbTari" class="col-2 col-form-label">Nama Tarian</label>
                            <div class="col-2">
                                <?php
                                    $st = "SELECT kode, nama
                                            FROM t_tari
                                           WHERE aktif = 'Y'
                                           ORDER BY nama";
                                    
                                    $qrySS = mysqli_query($conSS, $st);
                                ?> 
                                <select class="form-control" name="cbbTaru">
                                    <?php while ($data = mysqli_fetch_array($qrySS)) : ?>
                                        <option value="<?= $data['kode']; ?>"><?= $data['nama']; ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="cbbMetode" class="col-2 col-form-label">Metode Latihan</label>
                            <div class="col-2">
                                <select class="form-control" name="cbbJK" >
                                    <option value="K">Kelompok</option>
                                    <option value="P">Privat</option>
                                </select>
                            </div>
                        </div>

                        <?php 
                            // ambil hari ini 
                            $tggl = $_SESSION['harini'];

                            $prd  = nextPrd(date_format($tggl, "ym")); 
                        ?>
                        <div class="form-group row">
                            <label for="txtPeriode" class="col-2 col-form-label">Periode</label>
                            <div class="col-2">
                                <input class="form-control" name="txtTpLahir" type="text"
                                    value="<?= getPeriode($prd); ?>" readonly>
                                <input name="txtPrd" type="hidden" value="<?= $prd ?>">
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col-2"></div>
                            <div class="col">
                                 <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                    <i class="fas fa-save"></i> Simpan </button>
                                 <a href="frmsiswa.php" class="btn btn-sm btn-secondary ms-2">
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
</body>
</html>