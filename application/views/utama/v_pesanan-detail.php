<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_responsive.css">

	<div class="container single_product_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('pesanan-saya') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Detail Pesanan</a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Detail Pesanan Saya -->
		<div class="row" style="margin-top:-50px">
			<div class="col-lg-10 contact_col">
				<div class="contact_contents">
					<h3>Pesanan Saya</h3>
                    <div class="pull-right" style="margin-top: -40px;">
                        <button class="btn btn-info btn-round" onclick="ExportPdf()"><span class="fa fa-print"></span> Cetak Invoice</button>
                    </div>
                    <hr>
                    <div id="myCanvas">
                        <h3>Detail Pesanan : <b><?= $this->uri->segment(3) ?></b></h3>
                        <h5>Waktu Pesan : <b><?= date('d F Y', strtotime($invoice->tgl)) ?></b></h5>
                        <h5>Status Pesanan : <b><?= $invoice->status ?></b></h5>
                        <!-- <span>Hai, silahkan konfirmasi pesanan anda dengan klik tombol konfirmasi.</span> -->
                        <div class="" style="margin-top:30px">
                            <table style="width:100%" id="mytable" class="table table-responsive-lg table-hover">
                                <thead>
                                    <tr>
                                        <th width="1px">No</th>
                                        <th colspan="2">Barang</th>
                                        <th>Waktu Pesan</th>
                                        <th>Harga Satuan</th>
                                        <th>Banyak</th>
                                        <th>Total</th>
                                        <th width="100px">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $hasil = 0;$no=0;
                                    foreach ($barang->result() as $key):
                                        $no++;
                                        ?>
                                        <tr><td align="center"><?= $no ?></td>
                                            <td width="100px">
                                                <a href="<?= site_url('i/detail/'.$key->slug) ?>">
                                                    <img src="<?php echo base_url(); ?>assets/back-end/images/produk/<?= $key->gambar ?>" style="width:100%">
                                                </a>
                                            </td>
                                            <td width="220px"><a href="<?= site_url('i/detail/'.$key->slug) ?>"><?= $key->nama_barang ?></a>
                                            </td>
                                            <td><?= date('d F Y', strtotime($invoice->tgl)) ?></td>
                                            <td>Rp.<?= rupiah($key->harga_barang) ?>,-</td>
                                            <td><?= $key->qty.' '.$key->satuan ?></td>
                                            <td>Rp.<?= rupiah($key->harga_barang*$key->qty) ?>,-</td>
                                            <td><?= $invoice->status ?>
                                                <!-- <?php if ($invoice->status=='Menunggu Konfirmasi') {
                                                    echo '<span class="btn btn-warning btn-sm">'.$invoice->status.'</span>';
                                                } else if ($invoice->status=='Proses') {
                                                    echo '<span class="btn btn-primary btn-sm">'.$invoice->status.'</span>';
                                                } else if ($invoice->status=='Dikirim') {
                                                    echo '<span class="btn btn-success btn-sm">'.$invoice->status.'</span>';
                                                } else if ($invoice->status=='Selesai') {
                                                    echo '<span class="btn btn-info btn-sm">'.$invoice->status.'</span>';
                                                } else if ($invoice->status=='Dibatalkan') {
                                                    echo '<span class="btn btn-danger btn-sm">'.$invoice->status.'</span>';
                                                }?>   -->  
                                            </td>
                                        </tr>
                                        <?php
                                        $hasil = ($key->harga_barang*$key->qty)+$hasil;
                                    endforeach ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="8" class="text-right"><h4>Total Pesanan : Rp. <?php echo rupiah($hasil); ?>,00</h4></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>    
                    </div>
                    
				</div>
                <div class="contact_contents">
                    <h3>Konfirmasi Pesanan</h3><hr>
                    <div align="center">
                        <p>Klik tombol berikut untuk konfirmasi pesanan via Whatsapp admin</p>
                        <a href="https://wa.me/62<?= $ten->no_telp ?>?text=Hello%20admin,%20Saya%20<?= $user->nama ?>,%20mau%20konfirmasi%20pesanan%20saya%20dengan%20No.Invoice%20<?= $invoice->no_invoice ?>" class="btn red_button1" style="margin-top: 10px">Konfirmasi Pesanan</a>
                        <?php if($invoice->status=='Menunggu Konfirmasi'){ ?>
                        <button style="margin-top: 10px;width: 220px" onclick="batal('<?= $invoice->no_invoice ?>')" class="btn kembali">Batalkan Pesanan</button>  
                        <?php } ?>
                    </div>
                </div>
                <br><br><br>
			</div>

			<div class="col-lg-2 contact_col">
				<div class="contact_contents">
					<h3>Profil</h3><hr>
					<ul class="nav">
	                	<li style="padding: 10px;">
		                  <a href="<?= site_url('akun-saya') ?>"><i class="fa fa-user"></i> Akun Saya</a>
		              	</li>
		              	<li style="padding: 10px;background-color: #FF6347;width: 100%;">
		                  <a href="<?= site_url('pesanan-saya') ?>" style="color: #fff"><i class="fa fa-list"></i> Pesanan Saya</a>
		              	</li>
		              	<li style="padding: 10px">
		                  <a href="<?= site_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
		              	</li>
		          	</ul>				
				</div>
			</div>
		</div>
	</div>

<script type="text/javascript">
    function batal(no_invoice) {
        if(confirm('Yakin ingin batalkan pesanan anda?'))
        {
            // ajax delete data to database
            $.ajax({
                url : '<?php echo site_url("pesanan_saya/batal/'+no_invoice+'") ?>',
                type: "POST",
                dataType: "JSON",
                data: { <?= $this->security->get_csrf_token_name(); ?> : function () {
                  refreshTokens();
                  return $( "#csrfHash" ).val();
              }},
              success: function(data)
              {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    alert('Pesanan anda telah dibatalkan')
                    location.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
                }
            });
        }
    }
</script>

<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script type="text/javascript">
    function ExportPdf(){ 
    kendo.drawing
    .drawDOM("#myCanvas", 
    { 
        paperSize: "A4",
        margin: { left:"1cm", right:"1cm" ,top: "1.5cm", bottom: "0.5cm" },
        scale: 0.60,
        height: 800
    })
        .then(function(group){
        kendo.drawing.pdf.saveAs(group, "Invoice <?= $invoice->no_invoice ?>.pdf")
    });
}
</script>