<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 0;

    if (isset($_GET['hal']) && is_numeric($_GET['hal']))
    {
        $hal             = $_GET['hal'];
        $arah            = ($hal < $_SESSION['hal']) ? -1 : 1;
        $_SESSION['hal'] = $hal;
    }
    else
    {
        $hal             = 1;
        $arah            = 1;
        $_SESSION['hal'] = 1;
    }

    $st = "SELECT COUNT(1) AS Banyak FROM t_tari WHERE aktif ='Y'";
    $qrySS = mysqli_query($conSS, $st);
    $data = mysqli_fetch_array($qrySS);

    $totHal = $data['Banyak'];

    if ($hal > $totHal) $hal = 1;

    $nmr = $hal -1;
    $sblm = $hal -1;
    $stlh = $hal +1;
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
                
                    <div class="row">
                        <?php 
                            $st = "SELECT * FROM t_tari WHERE aktif = 'Y' LIMIT $nmr,1";
                            $qrySS = mysqli_query($conSS, $st);
                            $data = mysqli_fetch_array($qrySS);
                        
                            $byKel = $data['lama'] * 6000;
                            $byPri = $data['lama'] * 50000;
                            $kdTari = $data['kode'];
                        ?>
                        <div class="col-5">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <div><b><?= $data['nama'] ?></b></div>
                                        <div><?= $kdTari; ?></div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <table class="table table-sm table-borderless">
                                        <tr>
                                            <td>Jenis Tarian</td>
                                            <td><?php 
                                                switch ($data['jenis'])
                                                {
                                                    case "D" : echo "Daerah"; break;
                                                    case "M" : echo "Modern";
                                                }?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Lama Latihan</td>
                                            <td><?= $data['lama'] ?> minggu</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">Biaya Latihan</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4">Kelompok</td>
                                            <td>Rp. <?= number_format($byPri, 0, ',', '.') ?>,-</td>
                                        </tr>
                                        <tr>
                                            <td class="ps-4">Privat</td>
                                            <td>Rp. <?= number_format($byPri, 0, ',', '.') ?>,-</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>

                            <nav>
                                <ul class="pagination">
                                    <div style="margin-top: 0.44rem; margin-right: 0.44rem;" >
                                        Halaman
                                    </div>
                                    <li class="page-item <?php if ($hal <= 1) echo 'disabled';?>">
                                        <a href="<?php 
                                            if ($hal <= 1) echo '#'; else echo "?hal=" . $sblm;?>" class="page-link">
                                            <i class="fas fa-chevron-left"></i>
                                        </a>
                                    </li>

                                    <?php 
                                        if ($totHal < 7)
                                        {
                                            $Aw = 1;
                                            $Ak = $totHal;
                                        }
                                        else
                                        {
                                            if ($totHal-$hal <6)
                                            {
                                                $Aw = $totHal - 5;
                                                $Ak = $totHal;
                                            }
                                            else
                                            {
                                                if($arah == 1)
                                                {
                                                    $Aw = $hal;
                                                    $Ak = $Aw +2;
                                                }
                                                else
                                                {
                                                    $Aw = ($hal > 3) ? $hal : 3;
                                                    $Ak = ($hal > 3) ? $Ak - 2 : 1;
                                                }
                                            }
                                        }
                                    ?>

                                    <?php for ($K = $Aw; $K <= $Ak; $K++) : ?>
                                        <li class="page-item <?php if($hal == $K) echo 'active'; ?>">
                                            <a href="frmawal.php?hal=<?= $K; ?>" class="page-link">
                                                <?= $K; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($totHal > 6 && $totHal-$hal > 5) : ?>
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link">
                                                <i class="fas fa-ellilsis-h"></i>
                                            </a>
                                        </li>
                                        <?php for ($K = $totHal-2; $K <= $totHal; $K++) : ?>
                                            <li class="page-item <?php if($hal == $K) echo 'active'; ?>">
                                                <a href="frmawal.php?hal=<?= $K; ?>" class="page-link">
                                                    <?= $K; ?>
                                                </a>
                                            </li>
                                        <?php  endfor;?>
                                    <?php endif; ?>

                                    <li class="page-item">
                                        <a class="page-link" href="<?php 
                                            if ($hal >= $totHal) echo '#'; else echo "?hal=". $stlh;?>" >
                                            <i class="fas fa-chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>

                        <?php 
                            $st = "SELECT t_guru.nama, ID, aktif, jenis
                                    FROM t_guri INNER JOIN t_guru ON t_guri.idGuru = t_guru.ID
                                        LEFT JOIN t_gunor ON t_gunor.idGuru = t_guru.ID
                                    WHERE idTari = '$kdTari'";
                            
                            $qrySS = mysqli_query($conSS, $st);
                            $rows = mysqli_fetch_all($qrySS, MYSQLI_ASSOC);
                        ?>
                        <div class="col-7">
                            <div class="card">
                                <div class="card-header">
                                    <b>Pengajar</b>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <?php foreach ($rows as $data) :  ?>
                                            <div class="col-6">
                                                <?php if ($data['aktif'] == "Y") : ?>
                                                    <div class="card alert-info mb-4">
                                                <?php else : ?>
                                                    <div class="card alert-warning mb-4">
                                                <?php endif; ?>
                                                    <div class="card-header">
                                                        <b><?= $data['nama']; ?></b>
                                                    </div>
                                                    <div class="card-body pb-0">
                                                        <table class="table table-sm table-borderless">
                                                            <tr>
                                                                <td>Jenis Pengajar</td>
                                                                <td><i><?php
                                                                    if ($data['jenis'] == "F") echo "FULL";
                                                                    else echo "Part";
                                                                    ?>-time</i>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Status</td>
                                                                <td><i><?php
                                                                    if ($data['aktif'] == "Y") echo "Aktif";
                                                                    else echo "Tidak Aktif";
                                                                    ?>-time</i>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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