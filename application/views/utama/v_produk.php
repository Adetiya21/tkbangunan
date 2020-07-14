<section>	
	<div class="container-fluid" style="margin-top:85px;">
		<div class="row">
			<div class="jenis-font3 tm-content" style="padding: 20px; margin: 0px;">
				<h2 style="text-align:center; font-size: 35px;"><?php echo $title; ?></h2>
			</div>
			<div class="jenis-font2">
				<div class="col-xs-12 col-md-6">
			      	<img class="pull-right" data-src="holder.js/100%x180" src="<?= base_url('assets/assets/img/kategori/'.$kat->gambar) ?>" alt="..." width="300px;" height="300px;" style="padding:10px; margin: 0px;">
			  	</div>
			  	<div class="col-xs-12 col-md-6" style="margin-top: -10px; margin-bottom: 10px;">
			  		<div>
			  			<h1 style="font-weight: bold;">Spesifikasi :</h1>
			  		</div>
			  		<div class="text-produk" style="margin-left: 25px;">
			  			<?= $kat->spesifikasi ?>				  		
				  	</div>
			  	</div>
			</div>
		</div>
	</div>
</section>

<section>	
	<div class="container-fluid col-xs-12">
		<div class="row tm-content">
			<div class="jenis-font3">
				<h2 style="text-align:center; font-size: 35px;">KANOPI TERBARU</h2>
			</div>
			<div class="jenis-font2">
				<?php if ($produk->num_rows()>=1){ foreach ($produk->result() as $key) {
					 ?>
						<div class="col-xs-12 col-md-3">
			    	<a href="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>" class="thumbnail">
			      		<img data-src="holder.js/100%x180" src="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>" alt="...">
			    	</a>
			  	</div>
				<?php 	}} else {
				 ?>
				<div class="col-xs-12 col-md-12" align="center">
			    	<h3><i>((Belum ada produk))</i></h3><br>
			  	</div>
				<?php }  ?>
			 	
			</div>
			<div class="col-xs-12 col-md-12" style="text-align: center;">
			  	 <a href="<?= site_url('galeri') ?>"><button class="btn btn-default tbl-cari">Produk Lainnya</button></a>
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.produk').addClass('active');
    });
</script>