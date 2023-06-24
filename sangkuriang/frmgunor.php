<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser'])) {
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 23;
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

                    <form method="post" action="gunoraksi.php">
                        <?php 
                            $st = "SELECT ID, nama, aktif, t_gunor.*
                                    FROM t_guru LEFT JOIN t_gunor ON t_guru.ID = t_gunor.idGuru
                                    ORDER BY nama";

                            $qrySS = mysqli_query($conSS, $st);

                            $nmr = 1;
                        ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Pengajar</th>
                                    <th class="text-center">Jenis</th>
                                    <th class="text-center">Tanggal Masuk</th>
                                    <th class="text-center">Gaji Pokok</th>
                                    <th class="text-center">Indeks Honor</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($data = mysqli_fetch_array($qrySS)) : ?>
                                    <tr>
                                        <td class="text-center"><?= $nmr++; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td class="text-center"> <i><?php 
                                            if ($data['jenis'] == "F") echo "Full"; else echo "Part";
                                            ?>-time</i>
                                        </td>
                                        <td class="text-center"><?php 
                                            if(strtotime($data['tgMasuk']) != "")
                                            {
                                                $tggl = date_create($data['tgMasuk']);//tgMasuk ?
                                                echo date_format($tggl, "d-m-Y");
                                            }?>
                                        </td>
                                        <td class="text-center"><?php 
                                            if($data['GaPok'] > 0)
                                                echo "Rp. ". number_format($data['GaPok'], 0, ',', '.'). ",-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php 
                                            if($data['idxHR'] > 0)
                                                echo "Rp. ". number_format($data['idxHR'], 0, ',', '.'). ",-";
                                            ?>
                                        </td>
                                        <td class="text-center"><?php 
                                            if($data['aktif'] == "Y") echo "Ya"; else echo "Tidak";
                                            ?>
                                        </td>
                                        <td class="text-center"> 
                                            <button class="btn py-0" name="btnGuruU"
                                                    value="<?= $data['ID']; ?>"><i class="fas fa-edit"></i> Ubah
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </form>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-item-center justify-content-between small">
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