<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_responsive.css">

	<div class="container single_product_container">
		<div class="row">
			<div class="col">

				<!-- Breadcrumbs -->

				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('i/detail/'.$brg->slug) ?>"><i class="fa fa-angle-right" aria-hidden="true"></i><?= $brg->nama_barang ?></a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="row">
			<div class="col-lg-7">
				<div class="single_product_pics">
					<div class="row wow fadeInUp">
						<div class="col-lg-12 image_col order-lg-1 order-1">
							<div class="single_product_image">
								<div class="single_product_image_background" style="background-image:url(<?= base_url('assets/back-end/images/produk/'.$barang->gambar) ?>)"></div>
							</div>
						</div>
						<div class="col-lg-12 thumbnails_col order-lg-2 order-2">
							<div class="single_product_thumbnails">
								<ul class="">
									<li class="active"><img src="<?= base_url('assets/back-end/images/produk/'.$barang->gambar) ?>" alt="" data-image="<?= base_url('assets/back-end/images/produk/'.$barang->gambar) ?>"></li>
									<?php foreach ($gmbr->result() as $key) { ?>
									<li><img src="<?= base_url('assets/back-end/images/produk/'.$key->gambar) ?>" alt="" data-image="<?= base_url('assets/back-end/images/produk/'.$key->gambar) ?>"></li>
									<?php } ?>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5">
				<div class="product_details">
					<div class="product_details_title">
						<h2><?= $barang->nama_barang ?></h2>
						<span><?php echo date('d F Y', strtotime($barang->tgl)); ?></span><hr>
						<div style="text-align: justify"><?= $barang->deskripsi ?></div>
						
						<ul><li>Jumlah Stok : <?= $barang->stok_barang ?></li></ul>
					</div>
					<hr>
					<div class="product_price">Rp. <?= rupiah($barang->harga_barang) ?>,- <span>/ <?= $barang->satuan ?></span></div>
					<?php $attributes = array('class' => 'form-item'); ?>
                    <?= form_open('', $attributes); ?>
                    <input type="hidden" name="id_barang" value="<?= $barang->id_barang ?>">			
					<div class="quantity d-flex  flex-sm-row align-items-sm-center">
						<span>Banyak :</span>
						<div style="margin-left: 20px; width: 100px;"><input type="number" min="1" class="form-control" name="qty" value="1"></div>
						<div style="margin-left: 10px;"> <?= $barang->satuan ?></div>
					</div>
					<hr>
					<button class="btn red_button1" type="submit" style="margin-top: 10px;width: 100%">Tambah Kerajang</button>
					<?= form_close(); ?> 
				</div>
			</div>
		</div>
	</div>

	<!-- Best Sellers -->
	<div class="best_sellers">
		<div class="container">
			<div class="row">
				<div class="col text-center">
					<div class="section_title new_arrivals_title">
						<h2>Barang Terbaru</h2>
					</div>
				</div>
			</div>
			<div class="row wow fadeInUp">
				<div class="col">
					<div class="product_slider_container">
						<div class="owl-carousel owl-theme product_slider">

							<!-- Slide 1 -->
							<?php foreach ($brg_terbaru->result() as $key) { ?>
								<?php foreach ($satuan->result() as $key1){
								 if ($key1->id_satuan==$key->id_satuan){ ?>
							<div class="owl-item product_slider_item">
								<div class="product-item">
									<div class="product discount" style="padding: 10px;">
										<div class="product_image">
											<img src="<?= base_url('assets/back-end/images/produk/'.$key->gambar) ?>" alt="">
										</div>
										<div class="product_info">
											<h6 class="product_name"><a href="<?= site_url('i/detail/'.$key->slug) ?>"><?= $key->nama_barang ?></a></h6>
											<div class="product_price">Rp. <?= rupiah($key->harga_barang) ?>,-<span>/ <?= $key1->satuan ?></span></div>
										</div>
									</div>
								</div>
							</div>
							<?php }}} ?>
						</div>

						<!-- Slider Navigation -->

						<div class="product_slider_nav_left product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-left" aria-hidden="true"></i>
						</div>
						<div class="product_slider_nav_right product_slider_nav d-flex align-items-center justify-content-center flex-column">
							<i class="fa fa-chevron-right" aria-hidden="true"></i>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<br><br>

<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.home').addClass('main-active');
  	});

    // script tambah keranjang-belanja
  	$(document).ready(function(){
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Proses...'); //Loading button text

            $.ajax({ //make ajax request to cart_process.php
                url: "<?php echo site_url('i/tambah_keranjang_detail/'); ?>",
                type: "POST",
                dataType:"json", //expect json value from server
                data: form_data
            }).done(function(data){ //on Ajax success
                $("#cart-info").html(data.items); //total items in cart-info element
                button_content.html('<i class="glyphicon glyphicon-shopping-cart"></i> Proses'); //reset button text to original text
                alert("Produk sudah dimasukkan kekeranjang belanja anda!"); //alert user
                location.reload();
            })
            e.preventDefault();

        });
    });
</script>
</script>