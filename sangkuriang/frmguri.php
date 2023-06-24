<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 22;
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
                    <h4 class="mt-4">Tarian yang Diajarkan</h4>
                
                    <form method="post" action="guriaksi.php">
                        <?php 
                            $st = "SELECT * FROM t_guru ORDER BY nama";
                            $qrySS = mysqli_query($conSS, $st);
                            $nmr = 1;
                        ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Pengajar</th>
                                    <th>Keahlian</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($data = mysqli_fetch_array($qrySS)) :?>
                                    <tr>
                                        <td class="text-center"><?= $nmr++; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?php 
                                                $st ="SELECT nama
                                                        FROM t_guri
                                                            INNER JOIN t_tari ON t_guri.idTari = t_tari.kode
                                                        WHERE idGuru = '".$data['ID']."'
                                                        ORDER BY nama";
                                                
                                                $qrySS2 = mysqli_query($conSS, $st);
                                                $baris  = mysqli_num_rows($qrySS2);
                                                if ($data['aktif'] != "Y") echo "<div class=\"text-danger\">";

                                                for ($K = 1; $K <= $baris; $K++)
                                                {
                                                    $data2 = mysqli_fetch_array($qrySS2);

                                                    echo $data2['nama'];

                                                    if ($data['aktif'] != "Y") echo "</div>";
                                                }
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn py-0" name="btnGuruU"
                                               value="<?= $data['ID']; ?>"> <i class="fas fa-edit"></i> Ubah
                                            </button>
                                        </td>
                                    </tr>
                                <?php endwhile ?>
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