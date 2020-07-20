<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_responsive.css">

	<div class="container contact_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('kontak-toko') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Kontak Toko</a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Map Container -->
		<div class="row wow fadeInUp">
			<div class="col">
				<div id="google_map">
					<div class="map_container">
						<div id="map">
							<?= $ten->iframe ?>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Kontak Toko -->
		<div class="row wow fadeInUp">
			<div class="col-lg-8 contact_col">
				<div class="contact_contents">
					<h1>Kontak Toko</h1>
					<p>Ada banyak cara untuk menghubungi kami. Anda dapat menelepon kami atau mengirim email ke alamat email kami.</p>
					<div>
						<p><a href="tel:<?= $ten->no_telp ?>"><span class="fa fa-phone"></span>&nbsp; <?= $ten->no_telp ?></a></p>
						<p><a href="mailto:<?= $ten->email ?>"><span class="fa fa-envelope-o"></span> <?= $ten->email ?></a></p>
					</div>
					<div>
						<?= $ten->keterangan ?>
					</div>
				</div>
			</div>

			<div class="col-lg-4 contact_col">
				<div class="contact_contents">
					<h1>Follow Toko</h1>
					<ul class="social d-flex flex-row">
						<li><a href="<?= $ten->fb ?>" style="background-color: #3a61c9"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
						<li><a href="<?= $ten->ig ?>" style="background-color: #fb4343"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
					</ul>
				</div>
			</div>
		</div>
	</div>

<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.kontak-toko').addClass('main-active');
  	});
</script>