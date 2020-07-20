<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_responsive.css">

	<div class="container contact_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('tentang-toko') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Tentang Toko</a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Tentang Toko -->
		<div class="row" style="margin-top: -50px">
			<div class="col-lg-12 contact_col">
				<div class="contact_contents">
					<h3>Tentang Toko</h3>
					<div class=" row">
						<div class="col-md-4"><img src="<?= base_url('assets/back-end/images/logo/'.$ten->gambar) ?>" alt="Logo" style="width: 100%;"></div>
						<div class="col-md-8"><?= $ten->deskripsi ?></div>					
					</div>					
				</div>
			</div>
		</div>
	</div>

<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.tentang-toko').addClass('main-active');
  	});
</script>