<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/contact_responsive.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/cart.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/cart_responsive.css">
<script type="text/javascript">
    function isNumberKey (evt) {
        var charCode = (evt.which) ? evt.which :
        event.keyCode
        if (charCode > 31 && (charCode <48 || charCode > 57))

            return false;
        return true;
    };
</script>

	<div class="container contact_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('checkout') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Review Pesanan</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="container" style="margin-top: -50px;">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<h3>Review Pesanan Saya</h3>
					<br>
					<?= form_open('checkout/proses_checkout'); ?>
					<div class="table-responsive wow">
						<table class="table table-hover">
		                	<thead>
		                		<tr>
		                			<th width="1%">No</th>
		                			<th colspan="2">Barang</th>
		                			<th>Harga/Satuan</th>
		                			<th>Banyak</th>
		                			<th>Total</th>
		                		</tr>
		                	</thead>
		                	<tbody>
		                		<?php $i=0;
		                		if ($this->cart->total_items()>0) {
			                    	foreach ($this->cart->contents() as $items) :
			                    	$i++;
			                    ?>
		                		<tr>
		                			<td align="center"><?= $i ?></td>
		                			<td width="100px"><a href="<?= site_url('i/detail/'.$items['slug']) ?>"><img src="<?= base_url('assets/back-end/images/produk/'.$items['image']) ?>" alt="" width="100%"></a></td>
		                			<td><a href="<?= site_url('i/detail/'.$items['slug']) ?>"><?= $items['name'] ?></a></td>
		                			<td>Rp.<?= rupiah($items['price']); ?>,- 
		                				<?php foreach ($satuan->result() as $key) {
		                					if ($key->id_satuan==$items['id_satuan']) {
		                						echo "/".$key->satuan;
		                					}
		                				} ?>
		                			</td>
		                			<td><?= $items['qty'] ?> 
			                			<?php foreach ($satuan->result() as $key) {
		                					if ($key->id_satuan==$items['id_satuan']) {
		                						echo $key->satuan;
		                					}
		                				} ?>
									</td>
		                			<td>Rp.<?= rupiah($items['subtotal']) ?>,-</td>
		                		</tr>
		                		<?php endforeach;
		                		}else{ ?>
								<tr>
		                			<td colspan="7" class="text-center">Keranjang Anda Masih Kosong</td>
		                		</tr>                			
		                		<?php } ?>
		                	</tbody>
		                </table>
					</div>
					<div class="row row_cart_buttons">
						<div class="col">
							<div class="row cart_buttons ">
								<div class="col-md-6 cart_buttons_right ml-lg-auto">
									<h4>Total Belanja : </h4>
								</div>
								<div class="col-md-6 cart_buttons_right ml-lg-auto">
									<h4 class="pull-right">Rp. <?php echo rupiah($this->cart->total()); ?>,-</h4>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="row cart_buttons ">
						<div class="col-md-6 cart_buttons_right ml-lg-auto">
							<a href="<?= site_url('keranjang-belanja') ?>" type="submit" class="btn kembali pull-left">Keranjang Belanja</a>
						</div>
						<div class="col-md-6 cart_buttons_right ml-lg-auto">
							<button type="submit" class="btn red_button1 pull-right">Konfirmasi Pesanan</button>
						</div>
					</div>
				</div>
			</div>
			<?= form_close(); ?>
		</div>		
	</div>

<script src="<?= base_url('assets/front-end/') ?>js/cart.js"></script>