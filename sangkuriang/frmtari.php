<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 11;
?>

<!DOCTYPE html>
<html lang="en">

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
                    <h4 class="mt-4">Daftar Tarian</h4>

                    <form method="post" action="tariaksi.php">
                        <?php
                        $st     = "SELECT * FROM t_tari ORDER BY nama";
                        $qrySS  = mysqli_query($conSS, $st);

                        $nmr    = 1;

                        if (mysqli_num_rows($qrySS) > 0) {
                            ?>
                            <table class="table table-sm">
                                <thead>
                                    <tr>
                                        <td colspan="8" class="text-end">
                                            <a href="frmtaritam.php" class="btn btn-sm btn-primary">
                                                <i class="fas fa-plus"></i>Tarian Baru</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="text-center">No.</th>
                                        <th>Nama Tarian</th>
                                        <th class="text-center">Kode</th>
                                        <th class="text-center">Jenis</th>
                                        <th class="text-center">Lama Latihan</th>
                                        <th class="text-center">Pengajar</th>
                                        <th class="text-center">Aktif</th>
                                        <th class="text-center">Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($data = mysqli_fetch_array($qrySS)) : ?>
                                        <tr>
                                            <td class="text-center"><?= $nmr++; ?></td>
                                            <td><?= $data['nama']; ?></td>
                                            <td class="text-center"><?= $data['kode']; ?></td>
                                            <td class="text-center">
                                                <?php
                                                switch ($data['jenis']) {
                                                    case "D":
                                                        echo "Daerah";
                                                        break;
                                                    case "M":
                                                        echo "Modern";
                                                        break;
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center"><?= $data['lama']; ?> Minggu</td>
                                            <td class="text-center">
                                                <?php
                                                $st = "SELECT COUNT(idGuru) as nGuru
                                                        FROM t_guri INNER JOIN t_guru on t_guri.idGuru = t_guru.ID
                                                        WHERE idTari = '".$data['kode']."'
                                                        AND aktif = 'Y'
                                                        ORDER BY nama";

                                                $qryGuru = mysqli_query($conSS, $st);
                                                $dataGuru = mysqli_fetch_array($qryGuru);

                                                if ($dataGuru['nGuru'] < 1) {
                                                    echo "Tidak Ada";
                                                } else {
                                                    echo "Ada";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <?php
                                                if ($data['aktif'] == "Y") {
                                                    if ($dataGuru['nGuru'] < 1) {
                                                        echo "<div class=\"text-danger\">Ya</div>";
                                                    } else {
                                                        echo "Ya";
                                                    }
                                                } else {
                                                    echo "Tidak";
                                                }
                                                ?>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn py-0" name="btnTariU" value="<?= $data['kode']; ?>">
                                                    <i class="fas fa-edit"></i> Ubah
                                                </button>
                                                <button class="btn py-0" name="btnTariH" value="<?= $data['kode']; ?>">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        <?php
                        } else {
                            echo "<p>Tidak ada data tarian.</p>";
                        }
                        ?>
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
</body>

</html>
