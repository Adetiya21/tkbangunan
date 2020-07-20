<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.pesanan').addClass('active');
  	});

    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    };
</script>

	<!-- konten -->
    <div class="pcoded-content">
        <div class="pcoded-inner-content">
            <div class="main-body">
                <div class="page-wrapper">
                    <div class="page-header">
                        <div class="row align-items-end">
                            <div class="col-lg-8">
                                <div class="page-header-title">
                                    <div class="d-inline">
                                        <h4>DAFTAR PESANAN</h4>
                                        <span>Berikut daftar pesanan user.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="<?= site_url('admin/home') ?>"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/pesanan') ?>">Daftar Pesanan</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/pesanan/detail/'.$invoice->no_invoice) ?>"><?= $invoice->no_invoice ?></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
					
					<div class="page-body" style="margin-top: -20px;margin-bottom: 15px">
						<button class="btn btn-danger btn-round" onclick="ExportPdf()"><span class="fa fa-print"></span> Cetak Invoice</button>
					</div>

                    <div class="page-body" id="myCanvas">
                    	<div class="row">
				            <div class="col-md-12">
		                        <div class="card">
		                            <div class="card-header">
		                                <h4>No. Invoice : <?= $invoice->no_invoice ?></h4>   
                                        <h5>Tanggal Pemesanan : <?= date('d F Y h:i:s', strtotime($invoice->tgl)) ?></h5><br>
                                        <h5>Status Pesanan : </h5>
											<?php if ($invoice->status=='Menunggu Konfirmasi') {
                                                echo '<label class="text-center label label-warning">'.$invoice->status.'</label>';
                                            } else if ($invoice->status=='Proses') {
                                                echo '<label class="text-center label label-primary">'.$invoice->status.'</label>';
                                            } else if ($invoice->status=='Dikirim') {
                                                echo '<label class="text-center label label-success">'.$invoice->status.'</label>';
                                            } else if ($invoice->status=='Selesai') {
                                                echo '<label class="text-center label label-info">'.$invoice->status.'</label>';
                                            } else if ($invoice->status=='Dibatalkan') {
                                                echo '<label class="text-center label label-danger">'.$invoice->status.'</label>';
                                            }?>
		                            </div>
		                            <div class="card-block">
			                            <div class="dt-responsive table-responsive">
											<table class="table nowrap">
												<thead>
													<tr><th width="100px"></th>
														<th width="350px">Produk</th>
					                                    <th>Banyak</th>
					                                    <th>Harga Satuan</th>
														<th>Total</th>
													</tr>
												</thead>
												<tbody>
													<?php $hasil = 0;
													foreach ($orders->result() as $key) { ?>
														<tr>
															<td>
				                                                <a href="<?= site_url('i/detail/'.$key->slug) ?>">
				                                                    <img src="<?php echo base_url('assets/back-end/images/produk/'.$key->gambar); ?>" style="width:100%">
				                                                </a>
				                                            </td>
															<td><a href="<?= site_url('i/detail/'.$key->slug) ?>">
				                                                    <?= $key->nama_barang ?>
				                                                </a>
															</td>
															<td><?= $key->qty ?> <?= $key->satuan ?></td>
															<td><?= 'Rp. '.number_format($key->harga_barang,2,',','.'); ?></td>
															<td><?php $total=$key->harga_barang*$key->qty;
															echo 'Rp. '.number_format($total,2,',','.'); ?></td>
														</tr>
													<?php $hasil = ($key->harga_barang*$key->qty)+$hasil; 
													} ?>
												</tbody>	
												<tfoot>
													<tr>
														<th colspan="5" style="text-align: right;"><h5>Total Pesanan : Rp. <?= number_format($hasil,2,',','.'); ?></h5></th>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								</div>
								<hr>
								<div class="card">
		                            <div class="card-header">
		                                <h5>Data Pemesan Barang</h5>
		                            </div>
		                            <div class="card-block">
		                            	<div class="dt-responsive table-responsive">
		                            		<table class="table table-sm nowrap">
												<?php foreach ($pemesan as $key) { ?>
													<tr>
														<td width="100px">Nama User</td>
														<td>: <?= $key->nama ?></td>
													</tr>
													<tr>
					                                    <td>Email User</td>
					                                    <td>: <?= $key->email ?></td>
					                                </tr>
					                                <tr>
					                                    <td>No Telepon</td>
					                                    <td>: <?= $key->no_telp ?></td>
													</tr>
													<tr>
					                                    <td>Alamat User</td>
					                                    <td>: <?= $key->alamat ?></td>
													</tr>
												<?php } ?>
											</table>
										</div>
		                            </div>
		                        </div>
							</div>
						</div>
					</div>

<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jquery.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/jszip.min.js"></script>
<script src="https://kendo.cdn.telerik.com/2017.2.621/js/kendo.all.min.js"></script>
<script type="text/javascript">
     function ExportPdf(){ 
kendo.drawing
    .drawDOM("#myCanvas", 
    { 
        paperSize: "A4",
        margin: { left:"0.5cm", right:"1cm" ,top: "0.5cm", bottom: "0.5cm" },
        scale: 0.60,
        height: 800
    })
        .then(function(group){
        kendo.drawing.pdf.saveAs(group, "Invoice <?= $invoice->no_invoice ?>.pdf")
    });
}
</script>