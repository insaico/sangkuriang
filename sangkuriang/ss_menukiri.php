<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
        <?php if (isset($_SESSION['namaUser'])) : ?>
            <div class="nav">

                <!-- Siswa  -->
                <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#mnuSiswa"
                    aria-expanded="false" aria-controls="mnuSiswa">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>Siswa
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="mnuSiswa" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionSiswa">
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 31) echo "#"; else echo "frmsiswa.php" ?>">Daftar Siswa</a>
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 32) echo "#"; else echo "frmsislat.php" ?>">Peserta Latihan</a>
                    </nav>
                </div>

                <!-- Pengajar -->
                <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#mnuGuru"
                    aria-expanded="false" aria-controls="mnuGuru">
                    <div class="sb-nav-link-icon"><i class="fas fa-chalkboard-teacher"></i></div>Pengajar
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="mnuGuru" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionGuru">
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 21) echo "#"; else echo "frmguru.php" ?>">Daftar Pengajar</a>
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 22) echo "#"; else echo "frmguri.php" ?>">Keahlian</a>
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 23) echo "#"; else echo "frmgunor.php" ?>">Honor</a>
                    </nav>
                </div>

                <!-- Latihan  -->
                <a href="#" class="nav-link collapsed" data-bs-toggle="collapse" data-bs-target="#mnuLatihan"
                    aria-expanded="false" aria-controls="mnuLatihan">
                    <div class="sb-nav-link-icon"><i class="fas fa-theater-masks"></i></div>Latihan
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="mnuLatihan" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionLatihan">
                        <a class="nav-link pt-0" 
                            href="<?php if($idMenu == 22) echo "#"; else echo "frmtari.php" ?>">Daftar Tarian</a>
                    </nav>
                </div>
            </div>
        <?php endif; ?>
    </div>
</nav>