<nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
	<div class="sb-sidenav-menu">
		<?php if (isset($_SESSION['namaUser'])) : ?>
			<div class="nav">
				<a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#mnuLatihan" aria-expanded="false" aria-controls="mnuLatihan">
					<div class="sb-nav-link-icon"><i class="fas fa-theater-masks"></i></div>Latihan
					<div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
				</a>
				<div class="collapse" id="mnuLatihan" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
					<nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionLatihan">
						<a class="nav-link pt-0" href="<?php if($idMenu = 11 ) echo "#"; else echo "frmtari.php"; ?>">Daftar Tarian</a>
					</nav>
				</div>
			</div>
		<?php endif; ?>
	</div>
</nav>