<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_responsive.css">

	<div class="container contact_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('i/cari') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Cari <?= $title; ?></a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Barang -->
		<div class="row" style="margin-top: -50px">
			<div class="col-lg-12 contact_col">
				<div class="contact_contents">
					<h3>Pencarian <?= $title; ?></h3>	
				</div>
			</div>
			<div class="col">
				<div class="product-grid" data-isotope='{ "itemSelector": ".product-item", "layoutMode": "fitRows" }'>
					<!-- Product -->
					<?php foreach ($barang->result() as $key) { ?>
						<?php foreach ($satuan->result() as $key1){
						 if ($key1->id_satuan==$key->id_satuan){ ?>
					<div class="product-item">
						<?php $attributes = array('class' => 'form-item'); ?>
                        <?= form_open('', $attributes); ?>
						<div class="product discount product_filter" style="padding: 10px">
							<input type="hidden" name="id_barang" value="<?php echo $key->id_barang; ?>">
							<div class="product_image">
								<a href="<?= site_url('i/detail/'.$key->slug) ?>"><img src="<?= base_url('assets/back-end/images/produk/'.$key->gambar) ?>" alt="gambar" height="210px"></a>
							</div>
							<!-- <div class="favorite"></div> -->
							<div class="product_info">
								<h6 class="product_name"><a href="<?= site_url('i/detail/'.$key->slug) ?>"><?= $key->nama_barang ?></a></h6>
								<div class="product_price">Rp. <?= rupiah($key->harga_barang); ?>,- <span>/ <?= $key1->satuan ?></span></div>
							</div>
						</div>
						<button class="red_button add_to_cart_button" type="submit" style="border: 0;color: #fff">Tambah Keranjang</button>
						<!-- <div class="red_button add_to_cart_button"><a href="javascript:void(0)" onclick="tambah()">Tambah Keranjang</a></div> -->
						<?= form_close(); ?> 
					</div>
					<?php } }}?>
				</div>
				<hr>
				<div class="text-center">
		        <div class="pagination modal-2">
		            <?php echo $halaman; ?> <!--Memanggil variable pagination-->
		        </div>
		        </div>				
			</div>
		</div>
	</div>

<!-- pagination -->
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/styles/style-pagination.css') ?>">

<!-- menu aktif -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.home').addClass('main-active');
  	});

    $(document).ready(function(){
        $(".form-item").submit(function(e){
            var form_data = $(this).serialize();
            var button_content = $(this).find('button[type=submit]');
            button_content.html('Proses...'); //Loading button text

            $.ajax({ //make ajax request to cart_process.php
                url: "<?php echo site_url('i/tambah_keranjang'); ?>",
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
