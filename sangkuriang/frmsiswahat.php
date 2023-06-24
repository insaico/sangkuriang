<?php 
    session_start();
    include "koneksi.php";
    include "modul.php";

    if (!isset($_SESSION['namaUser'])) {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 310;

    // Pastikan koneksi ke database sudah dibuat
    // include "koneksi.php";

    // Inisialisasi $_SESSION['namaUser'] jika belum ada
    // $_SESSION['namaUser'] = "namaUser";

    // Periksa jika form di halaman sebelumnya telah dikirimkan dan data tersedia
    if (isset($_POST['txtID']) && isset($_POST['txtNama']) && isset($_POST['txtTpLahir']) && isset($_POST['txtAlamat']) && isset($_POST['txtNoHP']) && isset($_POST['txtTgLahir'])) {
        $ID      = $_POST['txtID'];
        $nama    = isset($_POST['txtNama'])    ? ucwords(strtolower($_POST['txtNama']))    : "";
        $tpLahir = isset($_POST['txtTpLahir']) ? ucwords(strtolower($_POST['txtTpLahir'])) : "";
        $alamat  = isset($_POST['txtAlamat'])   ? ucwords(strtolower($_POST['txtAlamat']))   : "";
        $JK      = isset($_POST['cbbJK'])      ? $_POST['cbbJK'] : "x";
        $noHP    = isset($_POST['txtNoHP']) && (int) $_POST['txtNoHP'] > 0 ? $_POST['txtNoHP'] : "";

        $tggl    = date_create($_POST['txtTgLahir']);
        $tgLahir = date_format($tggl, "Y-m-d");

        // ambil tanggal hari ini 
        $tggl    = $_SESSION['harini'];
        $tgMasuk = date_format($tggl, "Y-m-d");

        // Lanjutkan dengan query dan pengolahan data
        // ...

        // Contoh query untuk mendapatkan data latihan siswa
        $st = "SELECT periode, nama, metode, kelas
               FROM t_sista INNER JOIN t_tari ON t_sista.idTari = t_tari.kode
               WHERE idSiswa = " . $_SESSION['pilSiswa'];

        $qrySS = mysqli_query($conSS, $st);
    }
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
                    <h4 class="mt-4">Biodata Siswa</h4>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="txtID" class="col-4 col-form-label">Nomor Registrasi</label>
                                <div class="col-4">
                                    <input type="text" name="txtID" class="form-control" value="<?= $_SESSION['pilSiswa'] ?>" readonly>
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label for="txtNama" class="col-4 col-form-label">Nama Siswa</label>
                                <div class="col-8">
                                    <input type="text" name="txtNama" class="form-control" value="<?= $_SESSION['nmSiswa'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtJK" class="col-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-4">
                                    <input type="text" name="txtJK" class="form-control" value="<?php 
                                        switch ($_SESSION['JK'])
                                        {
                                            case "P" : echo "Pria"; break;
                                            case "W" : echo "Wanita";
                                        } ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTpLahir" class="col-4 col-form-label">Tempat Lahir</label>
                                <div class="col-6">
                                    <input type="text" name="txtTpLahir" class="form-control" value="<?= $_SESSION['tpLahir'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTgLahir" class="col-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-4">
                                    <input type="text" name="txtTgLahir" class="form-control" value="<?= $_SESSION['tgLahir'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtAlamat" class="col-4 col-form-label">Alamat</label>
                                <div class="col-8">
                                    <input type="text" name="txtAlamat" class="form-control" value="<?= $_SESSION['alamat'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtNoHP" class="col-4 col-form-label">Nomor HP</label>
                                <div class="col-4">
                                    <input type="text" name="txtNoHP" class="form-control" value="<?= $_SESSION['noHP'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTgMasuk" class="col-4 col-form-label">Tanggal Masuk</label>
                                <div class="col-4">
                                    <input type="text" name="txtTgMasuk" class="form-control" value="<?= $_SESSION['tgMasuk'] ?>" readonly>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- tambahkan bagian lain dari form sesuai kebutuhan -->
                    <!-- ... -->

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