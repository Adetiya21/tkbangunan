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

<!-- <link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/cart_responsive.css"> -->

	<div class="container contact_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('keranjang-belanja') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Keranjang Belanja</a></li>
					</ul>
				</div>

			</div>
		</div>

		<div class="container" style="margin-top: -50px;">
			<h3>Keranjang Belanja : <?= $this->cart->total_items(); ?> item.</h3>
			<br>
			<div class="table-responsive">
				<table class="table table-hover">
                	<thead>
                		<tr>
                			<th width="1%">No</th>
                			<th colspan="2">Barang</th>
                			<th>Harga/Satuan</th>
                			<th>Banyak</th>
                			<th>Total Harga</th>
                			<th width="10%">#</th>
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
                			<td>Rp. <?= rupiah($items['price']); ?>,- 
                				<?php foreach ($satuan->result() as $key) {
                					if ($key->id_satuan==$items['id_satuan']) {
                						echo "/".$key->satuan;
                					}
                				} ?>
                			</td>
                			<?= form_open('i/update_keranjang'); ?>
                			<input type="hidden" name="rowid" value="<?= $items['rowid'] ?>">
                			<td><input type="number" name="qty" value="<?= $items['qty'] ?>" onkeypress="return isNumberKey(event)" min="1" max="99" onKeyUp="if(this.value>99){this.value='99';}else if(this.value<0){this.value='0';}" class="form-control" style="width: 80px"></td>
							</td>
                			<td>Rp. <?= rupiah($items['subtotal']) ?>,-</td>
                			<td>
                				<button class="btn red_button" name="update" title="Refresh"><i class="fa fa-refresh"></i> </button>
                				<?= form_close(); ?>
                				<a href="<?php echo site_url('i/delete_keranjang/'.$items['rowid']); ?>" class="btn btn-warning" title="Hapus"><i class="fa fa-trash-o"></i></a>
                			</td>
                		</tr>
                		<?php endforeach;
                		}else{ ?>
						<tr>
                			<td colspan="7" class="text-center">Keranjang Anda Masih Kosong</td>
                		</tr>                			
                		<?php } ?>
                	</tbody>
                	<tfoot>
                        <tr><?php if($this->cart->total_items()>0){ ?>
                            <th colspan="7" class="text-right"><h4>Total Belanja Rp. <?php echo rupiah($this->cart->total()); ?>,-</h4></th>
	                        <?php } ?>
                        </tr>
                    </tfoot>
                </table>
			</div>
			<hr>
			<div class="row row_cart_buttons">
				<div class="col">
					<div class="row cart_buttons ">
						<div class="col-md-6 cart_buttons_right ml-lg-auto">
							<a href="<?= site_url() ?>" type="submit" class="btn kembali pull-left">Kembai Belanja</a>
						</div>
						<div class="col-md-6 cart_buttons_right ml-lg-auto">
							<?php if($this->cart->total_items()>0){ ?>
							<a href="<?= site_url('checkout') ?>" class="btn red_button1 pull-right">Checkout Pesanan</a>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>

		</div>		
	</div>

<script src="<?= base_url('assets/front-end/') ?>js/cart.js"></script>