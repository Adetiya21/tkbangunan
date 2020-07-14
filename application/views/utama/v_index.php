	<section>
		<div class="container-fluid" style="margin-top:90px;">
			<div class="row">
				<div class="carousel" id="carousel-tengah" data-ride="carousel">
					<!-- indicators dot noc -->
					<ol class="carousel-indicators">
						<li data-target="#carousel-tengah" data-slide-to="0" class="active"></li>
						<?php foreach ($header->result() as $key) { ?>
						<li data-target="#carousel-tengah" data-slide-to="1"></li>
						<?php } ?>
					</ol>

					<!-- wrapper for sliders -->
					<div class="carousel-inner" role="listbox">
						<div class="item active">
							<img src="<?= base_url('assets/front-end/') ?>images/bn-kanopi1.jpg" alt="bn-kanopi2" class="img-size">
						</div>
						<?php foreach ($header->result() as $key) { ?>
						<div class="item">
							<img src="<?php echo base_url().'assets/assets/img/header/'.$key->gambar ?>" alt="bn-kanopi1" class="img-size">
						</div>
						<?php } ?>
					</div>

					<!-- control next or prev buttons -->
					<a href="#carousel-tengah" class="left carousel-control" role="button" data-slide="prev">
						<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
						<span class="sr-only">Previous</span>
					</a>
					<a href="#carousel-tengah" class="right carousel-control" role="button" data-slide="next">
						<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
						<span class="sr-only">Next</span>
					</a>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container-fluid jenis-font2" style="text-align: center;">
			<div class="row tm-content">
				<?php foreach ($fasilitas->result() as $key) { ?>
				<div class="col-md-4 col-xs-12">
                    <div class="features_item sm-m-top-30">
                     	<div class="f_item_icon f_item_text">
                            <i class="fa <?= $key->icon ?>"></i>
                            <h3><?= $key->judul ?></h3>
                            <p><?= $key->deskripsi ?></p>
                        </div>
                    </div>
                </div>
	            <?php } ?>
			</div>
		</div>
	</section>
	<section>
		<div class="container-fluid" style="text-align: center;">
			<div class="row tentang-kami">
				<h2 class="jenis-font3" style="font-size: 35px;">Tentang Kami</h2>
				<p style="font-size: 15px;"><?= substr($tentang->keterangan, 0, 234) ?>...</p>
				<a href="<?= site_url('tentang-kami') ?>">Selengkapnya</a> <br><br>
			</div>
		</div>
	</section>
	<section>
		<div class="container-fluid">
			<div class="row tm-content">
				<div class="jenis-font3">
					<h2 style="text-align:center; font-size: 35px;">GALERI</h2>
				</div>
				<div class="jenis-font2">
					<?php foreach ($produk->result() as $key) { ?>
					<div class="col-xs-6 col-md-3">
				    	<a href="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>" class="thumbnail">
				      		<img data-src="holder.js/100%x180" src="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>" alt="...">
				    	</a>
				  	</div>
					<?php } ?>
				</div>
				<div class="col-xs-12 col-md-12" style="text-align: center;">
				  	 <a href="<?= site_url('galeri') ?>"><button class="btn btn-default tbl-cari">Selengkapnya..</button></a>
				</div>
			</div>
		</div>
	</section>

	<section>
		<div class="container-fluid">
			<div class="row">
				<div class="jenis-font3">
					<h2 style="text-align:center; font-size: 35px;">PRODUK</h2>
				</div>
				<?php foreach ($kategori->result() as $key) {
					if ($key->nama!='Produk Lainnya') {
				?>
				<div class="thumbnail col-md-6 col-xs-12" style="margin-top: -7px;">
					<div class="media list-produk">
						<a class="pull-left" href="<?= site_url('produk/i/'.$key->slug) ?>">
							<img class="media-object" src="<?= base_url('assets/assets/img/kategori/'.$key->gambar) ?>" style="width: 90px; height: 90px;
							margin-right: 5px;" alt="...">
						</a>
						<div class="media-body jenis-font2">
						    <h4 class="media-heading"><a href="<?= site_url('produk/i/'.$key->slug) ?>" style="text-decoration: none; color: black"><?= $key->nama ?></a></h4>
						    <p><?= $key->deskripsi ?>
							<br/>
							<a href="<?= site_url('produk/i/'.$key->slug) ?>">Selengkapnya..</a></p>
						</div>
					</div>
				</div>
				<?php } else { ?>
				<div class="thumbnail col-xs-12" style="text-align: center;">
					<div class="media list-produk">
					  <a href="<?= site_url('produk/i/'.$key->slug) ?>">
					    <img class="media-object" src="<?= base_url('assets/assets/img/kategori/'.$key->gambar) ?>" style="width: 90px; height: 90px;" alt="...">
					  </a>
					  <div class="media-body jenis-font2">
					    <h4 class="media-heading" style="margin-top: 10px;"><a href="<?= site_url('produk/i/'.$key->slug) ?>" style="text-decoration: none; color: black;"><?= $key->nama ?></a></h4>
					    <p>Besi pilihan yang dibentuk sedemikian rupa dan dipasang di depan rumah anad, sehingga dapat meningkatkan keamanan
					    <br/>
					    <a href="<?= site_url('produk/i/'.$key->slug) ?>">Selengkapnya..</a></p>
					  </div>
					</div>
				</div>
				<?php }} ?>
			</div>
		</div>
	</section>

	<section>
		<div class="container-fluid map-section" id="temukan-kami">
			<h2 class="jenis-font3" style="font-size: 50px;"><i class="fa fa-map-marker"></i> Temukan Kami</h2>
		</div>
		<div class="container-fluid">
			<div class="row">
				<?= $tentang->maps ?>
			</div>
		</div>
	</section>
	
<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.home').addClass('active');
    });
</script>