<?php 
    session_start();
    include "koneksi.php";

    if (!isset($_SESSION['namaUser']))
    {
        echo "<script>window.location.replace(\"index.php\");</script>";
        exit();
    }

    $idMenu = 31;

    if(!isset($_SESSION['srSiswa']))
    {
        $_SESSION['srSiswa'] = "";
    }

    if(isset($_POST['txtCari']))
    {
        $_SESSION['srSiswa'] = $_POST['txtCari'];
    }

    $nama = $_SESSION['srSiswa'];

    if(isset($_GET['hal']) && is_numeric($_GET['hal']))
    {
        $hal = $_GET['hal'];
        $arah = ($hal < $_SESSION['hal']) ? -1 : 1;
        $_SESSION['hal'] = $hal;
    }
    else
    {
        $hal = 1;
        $arah = 1;
        $_SESSION['hal'] = 1;
    }

    $st = "SELECT COUNT(1) AS Banyak FROM t_siswa WHERE nama LIKE '%$nama%'";
    $qrySS = mysqli_query($conSS, $st);
    $data = mysqli_fetch_array($qrySS);

    $baris = 10;
    $totHal = ceil($data['Banyak'] / $baris);

    if($hal > $totHal) $hal = 1;

    $awal = ($hal -1) * $baris;
    $sblm = $hal - 1;
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
                    <h4 class="mt-4">Daftar Siswa</h4>

                    <form method="post" action="siswaksi.php">
                        <?php 
                            $st = "SELECT * 
                                      FROM t_siswa
                                    WHERE nama LIKE '%$nama%'
                                    ORDER BY ID
                                    LIMIT $awal, $baris";
                            
                            $qrySS = mysqli_query($conSS, $st);
                            $rows = mysqli_fetch_all($qrySS, MYSQLI_ASSOC);
                        ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <td colspan="6" class="text-end">
                                        <a href="frmsiswatam.php" class="btn btn-sm btn-primary">
                                             <i class="fas fa-plus"></i> Siswa Baru</a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">No.Reg.</th>
                                    <th>Nama Siswa</th>
                                    <th>Alamat</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Tggl.Masuk</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($rows as $data) : ?>
                                    <tr>
                                        <td class="text-center"><?= $data['ID']; ?></td>
                                        <td><?= $data['nama']; ?></td>
                                        <td><?= $data['alamat']; ?></td>
                                        <td><?= $data['noHP']; ?></td>
                                        <td class="text-center"><?php 
                                            if(strtotime($data['tgMasuk']) != "")
                                            {
                                                $tggl = date_create($data['tgMasuk']);
                                                echo date_format($tggl, "d-m-Y");
                                            }?>
                                         </td>
                                         <td class="text-center">
                                            <button class="btn py-0" name="btnSiswaL"
                                                 value="<?= $data['ID']; ?>">
                                                 <i class="fas fa-eye"></i> Lihat
                                            </button>
                                            <button class="btn py-0" name="btnSiswaU"
                                                 value="<?= $data['ID']; ?>p">
                                                 <i class="fas fa-edit"></i> Ubah
                                            </button>
                                            <button class="btn py-0" name="btnSiswaH"
                                                 value="<?= $data['ID']; ?>p">
                                                 <i class="fas fa-trash-alt"></i> Hapus
                                            </button>
                                         </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </form>
                
                    <div class="row">
                        <div class="col">
                            <nav>
                                <ul class="pagination">
                                    <div style="margin-top: 0.44rem; margin-right: 0.44rem;">
                                        Halaman
                                    </div>
                                    <li class="page-item <?php if ($hal <= 1) echo 'disabled'; ?>">
                                        <a class="page-link" href="<?php 
                                           if ($hal <= 1) echo '#'; else "?hal" . $sblm; ?>">
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
                                            if ($totHal-$hal < 6)
                                            {
                                                $Aw = $totHal - 5;
                                                $Ak = $totHal;
                                            }
                                            else
                                            {
                                                if ($arah == 1)
                                                {
                                                    $Aw = $hal;
                                                    $Ak = $Aw + 2;
                                                }
                                                else
                                                {
                                                    $Ak = ($hal > 3) ? $hal : 3;
                                                    $Aw = ($hal > 3) ? $Ak - 2 : 1;
                                                }
                                            }
                                        }
                                    ?>

                                    <?php for ($K = $Aw; $K <= $Ak; $K++) : ?>
                                        <li class="page-item <?php if ($hal == $K) echo 'active'; ?>">
                                            <a class="page-link" href="frmsiswa.php?hal=<?= $K; ?>">
                                                <?= $K; ?>
                                            </a>
                                        </li>
                                    <?php endfor; ?>

                                    <?php if ($totHal > 6 && $totHal-$hal > 5) : ?>
                                        <li class="page-item disabled">
                                            <a href="#" class="page-link">
                                                <i class="fas fa-ellipsis-h"></i>
                                            </a>
                                        </li>
                                        <?php for ($K = $totHal-2; $K <= $totHal; $K++) : ?>
                                            <li class="page-item <?php if ($hal == $K) echo 'active'; ?>">
                                                <a class="page-link" href="frmsiswa.php?hal=<?= $K; ?>">
                                                    <?= $K; ?>
                                                </a>
                                            </li>
                                        <?php endfor; ?>
                                    <?php endif ?>

                                    <li class="page-item <?php if ($hal >= $totHal) echo 'disabled'; ?>">
                                        <a class="page-link"  href="<?php 
                                            if ($hal >= $totHal) echo '#'; else echo "?hal=". $stlh; ?>">
                                            <i class="fas fa-chevron-right"></i>    
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                        <div class="col-3">
                            <form method="post" action="">
                                <div class="input-group">
                                    <input class="form-control" name="txtCari"  type="text"
                                        placeholder="Nama...">
                                    <button class="btn btn-secondary">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </main>

            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-item-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Arya.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <script src="alat2/bootstrap.bundle.min.js"></script>
    <script src="alat2/scripts.js"></script>
</body>
</html>