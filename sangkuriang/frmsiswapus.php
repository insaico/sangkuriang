<?php 
    session_start();
    include "koneksi.php";
    include "modul.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 310;
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
            margin-bottom: 0.2;
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
                    <h4 class="mt-4">Siswa</h4>
                    
                    <div class="row">
                        <div class="col">
                            <div class="form-group row">
                                <label for="txtID" class="col-4 col-form-label">Nomor Regristrasi</label>
                                <div class="col-4">
                                    <input type="text" name="txtID" class="form-control"
                                    value="<?= $_SESSION['pilSiswa'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtNama" class="col-4 col-form-label">Nama Siswa</label>
                                <div class="col-8">
                                <input type="text" name="txtNama" class="form-control"
                                    value="<?= $_SESSION['nmSiswa'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtJK" class="col-4 col-form-label">Jenis Kelamin</label>
                                <div class="col-4">
                                    <input type="text" name="txtJK" class="form-control" value="<?php 
                                        switch($_SESSION['JK'])
                                        {
                                            case "P" : echo "Pria"; break;
                                            case "W" : echo "Wanita";
                                        }?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTpLahir" class="col-4 col-form-label">Tempat Lahir</label>
                                <div class="col-6">
                                    <input type="text" name="txtTpLahir" class="form-control"
                                        value="<?= $_SESSION['tpLahir'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTgLahir" class="col-4 col-form-label">Tanggal Lahir</label>
                                <div class="col-4">
                                    <input type="text" name="txtTgLahir" class="form-control"
                                        value="<?= $_SESSION['tgLahir'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtAlamat" class="col-4 col-form-label">Alamat</label>
                                <div class="col-8">
                                    <input type="text" name="txtAlamat" class="form-control"
                                        value="<?= $_SESSION['alamat'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtNoHP" class="col-4 col-form-label">Nomor HP</label>
                                <div class="col-4">
                                    <input type="text" name="txtNoHP" class="form-control"
                                        value="<?= $_SESSION['noHP'] ?>" readonly>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="txtTgMasuk" class="col-4 col-form-label">Tanggal Masuk</label>
                                <div class="col-4">
                                    <input type="text" name="txtTgMasuk" class="form-control bg-white"
                                        value="<?= $_SESSION['tgMasuk'] ?>" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            Latihan yang pernah diikuti

                            <?php 
                                $st = "SELECT periode, nama, metode, kelas,
                                        FROM t_sista INNER JOIN t_tari ON t_sista.idTari = t_tari.kode
                                       WHERE idSiswa = ". $_SESSION['pilSiswa'];
                                
                                $qrySS = mysqli_query($conSS, $st);
                                $ada   = mysqli_num_rows($qrySS);
                            ?>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <th>Periode</th>
                                        <th>Tarian</th>
                                        <th class="text-center">Metode</th>
                                        <th class="text-center">Kelas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                        <?php while ($data = mysqli_fetch_array($qrySS)) : ?>
                                            <tr>
                                                <td><?=getPeriode($data['periode']); ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td class="text-center"><?php 
                                                    switch ($data['metode'])
                                                    {
                                                        case "K" : echo "Kelompok"; break;
                                                        case "P" : echo "Privat";
                                                    }?>  
                                                </td>
                                                <td class="text-center"><?= $data['kelas']; ?></td>
                                            </tr>
                                        <?php  endwhile;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <form method="post" action="siswapusin.php">
                        <?php if($data > 0) : ?>
                            <br>
                            <div class="alert alert-danger">
                                Data tidak boleh dihapus
                                <a href="frmsiswa.php" class="btn btn-sm btn-cecondary ms-4">
                                     <i class="fas fa-ban"></i> Batalkan</a>
                            </div>
                        <?php else : ?>
                            <div class="form-group row mt-2">
                                <div class="col-2"></div>
                                <div class="col">
                                    <button class="btn btn-sm btn-primary" name="btnHapus" type="submit">
                                        <i class="fas fa-trash-alt"></i> Hapus</button>
                                    <a href="frmsiswa.php" class="btn btn-sm btn-cecondary ms-4">
                                        <i class="fas fa-ban"></i> Batalkan</a>
                                </div>
                            </div>
                        <?php endif; ?>
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