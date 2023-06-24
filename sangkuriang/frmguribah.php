<?php 
session_start();
include "koneksi.php";

if(!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 220;
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
    <script src="alat2/all.min.js"></script>
    <style>
        select, input, span {
            margin-bottom: 0.2rem;
        }
    </style>
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
                    <h4 class="mt-4">Tarian Keahlian Pengajar</h4>
                
                    <div class="from-group row">
                        <label for="txtNama" class="col-2 col-form-label">Nama Pengajar</label>
                        <div class="col-4">
                            <input type="text" name="txyNama" class="form-control"
                                value="<?= $_SESSION['nmGuru']; ?>" readonly>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="txtAktif" class="col-2 col-form-label">Aktif</label>
                        <div class="col-2">
                            <input type="text" name="txtAktif" class="from-control" value="<?php 
                                switch($_SESSION['aktif'])
                                {
                                    case "Y" : echo "Ya"; break;
                                    case "T" : echo "Tidak";
                                }?>" readonly>
                        </div>
                    </div>
                    <br>

                    <form method="post" action="guribahin.php">
                        <div class="row">
                            <div class="col-4">
                                Keahlian Pengajar
                                <?php 
                                    $st = "SELECT nama, kode
                                            FROM t_guri INNER JOIN t_tari ON t_guri.idTari = t_tari.kode
                                           WHERE idGuru = '".$_SESSION['pilGuru']."'
                                           ORDER BY nama";
                                    
                                    $qrySS = mysqli_query($conSS, $st);

                                    $nmr = 1;
                                ?>
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Tarian</th>
                                            <th class="text-center">Hapus</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($data = mysqli_fetch_array($qrySS)) : ?>
                                            <tr>
                                                <td class="text-center"><?= $nmr++; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td class="text-center">
                                                    <input type="checkbox" name="lstHapus[]" value="<?= $data['kode']; ?>">
                                                </td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>

                            <div class="col-2"></div>

                            <div class="col-4">
                                Daftar Tarian
                                <?php 
                                    $st = "SELECT nama, kode
                                            FROM t_tari
                                           WHERE kode NOT IN
                                                 (SELECT idTari
                                                    FROM t_guri
                                                  WHERE idGuru = '".$_SESSION['pilGuru']."')
                                             AND aktif = 'Y'
                                            ORDER BY nama";

                                    $qrySS = mysqli_query($conSS, $st);
                                    $nmr = 1;
                                ?>

                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No.</th>
                                            <th>Tarian</th>
                                            <th class="text-center">Tambahkan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($data = mysqli_fetch_array($qrySS)) :?>
                                            <tr>
                                                <td class="text-center"><?= $nmr++; ?></td>
                                                <td><?= $data['nama']; ?></td>
                                                <td class="text-center">
                                                <input type="checkbox" value="<?= $data['kode']; ?>" name="lstTambah[]">

                                                </td>
                                            </tr>
                                        <?php endwhile ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="form-group row mt-2">
                            <div class="col">
                                <button class="btn btn-sm btn-primary" name="btnSimpan" type="submit">
                                   <i class="fas fa-save"></i>Simpan</button>
                                <a href="frmguri.php" class="btn btn-sm btn-secondary ms-2">
                                    <i class="fas fa-ban"></i> Batalkan   </a>
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