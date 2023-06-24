<?php
session_start();
include "koneksi.php";

if (!isset($_SESSION['namaUser']))
{
    echo "<script>window.location.replace(\"index.php\");</script>";
    exit();
}

$idMenu = 21;
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
    <?php include "ss_menuatas.php"; ?>

    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <?php include "ss_menukiri.php"; ?>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h4 class="mt-4">Daftar Pengajar</h4>

                    <form method="post" action="guruaksi.php">
                        <?php
                            $st     = "SELECT * FROM t_guru ORDER BY nama";
                            $qrySS  = mysqli_query($conSS, $st);
                            $nmr    = 1;
                        ?>
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <td colspan="7" class="text-end">
                                        <a href="frmgurutam.php" class="btn btn-sm btn-primary">
                                            <i class="fas fa-plus"></i> Pengajar Baru
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">No.</th>
                                    <th>Nama Pengajar</th>
                                    <th class="text-center">ID</th>
                                    <th>Alamat</th>
                                    <th>Nomor HP</th>
                                    <th class="text-center">Aktif</th>
                                    <th class="text-center">Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while($data = mysqli_fetch_array($qrySS)) : ?>
                                    <tr>
                                        <td class="text-center"><?= $nmr++ ?></td>
                                        <td><?= $data['nama'] ?></td>
                                        <td class="text-center"><?= $data['ID'] ?></td>
                                        <td><?= $data['alamat'] ?></td>
                                        <td><?= $data['noHP'] ?></td>
                                        <td class="text-center">
                                            <?php if ($data['aktif'] == "Y") echo "Ya";
                                            else echo "Tidak";
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <button class="btn py-0" name="btnGuruL" value="<?= $data['ID']; ?>">
                                                <i class="fas fa-eye"></i> Lihat
                                            </button>
                                            <button class="btn py-0" name="btnGuruU" value="<?= $data['ID']; ?>">
                                                <i class="fas fa-edit"></i> Ubah
                                            </button>
                                            <button class="btn py-0" name="btnGuruH" value="<?= $data['ID']; ?>">
                                                <i class="fas fa-trash-alt"></i> Hapus
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
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">&copy; 2023 Prasta.unigamalang</div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
</body>

</html>