	<section>
		<div class="container-fluid map-section" style="margin-top:92px; padding-top: 5px;">
			<h2 class="jenis-font3" style="font-size: 50px;"><i class="fa fa-map-marker"></i> Temukan Kami</h2>
		</div>
		<div class="container-fluid">
			<div class="row">
				<?= $tentang->maps ?>
			</div>
		</div>
	</section>

	<section>
		<div class="container-fluid">
			<div class="row" style="background: #212121; text-align: center; padding-bottom: 10px;">
				<div class="col-md-3 col-xs-12">
					<div class="features_item sm-m-top-30">
						<div class="f_item_icon">
							<a href="https://www.facebook.com/<?= $tentang->facebook ?>" target="_blank">
								<i class="fa fa-facebook-official"></i><p class="paragraf-temukan">Bengkel Las Pontianak</p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="features_item sm-m-top-30">
						<div class="f_item_icon">
							<a href="https://www.instagram.com/<?= $tentang->instagram ?>" target="_blank">
								<i class="fa fa-instagram"></i><p class="paragraf-temukan">@<?= $tentang->instagram ?></p>
							</a>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="features_item sm-m-top-30">
						<div class="f_item_icon">
							<i class="fa fa-map-marker"></i><p class="paragraf-temukan"><?= $tentang->alamat ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-12">
					<div class="features_item sm-m-top-30">
						<div class="f_item_icon">
							<a href="https://api.whatsapp.com/send?phone=62<?= $tentang->no_telp; ?>" target="_blank">
								<i class="fa fa-phone"></i><p class="paragraf-temukan"><?= $tentang->no_telp ?></p>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.temukan').addClass('active');
    });
</script>