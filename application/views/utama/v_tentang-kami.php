	<section>	
		<div class="container-fluid">
			<div class="row tentang-kami tm-content" style="margin-top:100px; padding-top: 20px; text-align: center;">
				<div class="col-md-1"></div>
				<div class="col-md-10">
				<h2 class="jenis-font3" style="font-size: 35px; text-align: center; padding-bottom: 20px;">Tentang Kami</h2>
				<p style="font-size: 15px;"><?= $tentang->keterangan ?></p>
				
				</div>
			</div>
		</div>
	</section>

<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.tentang').addClass('active');
    });
</script>