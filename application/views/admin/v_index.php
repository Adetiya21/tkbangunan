<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.home').addClass('active');
  	});
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
                                        <h4>Dashboard</h4>
                                        <span>Selmat datang admin <?= $this->session->userdata('nama'); ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="<?= site_url('admin/home') ?>"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/admin') ?>">Admin</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

					<div class="page-body">
						<div class="row">
							<a href="<?= site_url('admin/user') ?>" class="col-xl-3 col-md-6">
								<div class="card bg-c-yellow text-white">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col">
												<p class="m-b-5">User</p>
												<h4 class="m-b-0"><?= $user ?></h4>
											</div>
											<div class="col col-auto text-right">
												<i class="feather icon-user f-50 text-c-yellow"></i>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="<?= site_url('admin/satuan') ?>" class="col-xl-3 col-md-6">
								<div class="card bg-c-green text-white">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col">
												<p class="m-b-5">Total Satuan</p>
												<h4 class="m-b-0"><?= $satuan ?></h4>
											</div>
											<div class="col col-auto text-right">
												<i class="feather icon-layout f-50 text-c-green"></i>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="<?= site_url('admin/barang') ?>" class="col-xl-3 col-md-6">
								<div class="card bg-c-blue text-white">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col">
												<p class="m-b-5">Total Barang</p>
												<h4 class="m-b-0"><?= $barang ?></h4>
											</div>
											<div class="col col-auto text-right">
												<i class="feather icon-clipboard f-50 text-c-blue"></i>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="<?= site_url('admin/pesanan') ?>" class="col-xl-3 col-md-6">
								<div class="card bg-c-pink text-white">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col">
												<p class="m-b-5">Total Pesanan</p>
												<h4 class="m-b-0"><?= $invoice ?></h4>
											</div>
											<div class="col col-auto text-right">
												<i class="feather icon-shopping-cart f-50 text-c-pink"></i>
											</div>
										</div>
									</div>
								</div>
							</a>
							<div class="col-xl-3 col-md-6">
								<div class="card">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col-12">
												<h4 class="text-c-yellow f-w-600"><?= $imk ?></h4>
												<h6 class="text-muted m-b-0">Pesanan</h6>
											</div>
											<!-- <div class="col-4 text-right">
												<i class="feather icon-bar-chart f-28"></i>
											</div> -->
										</div>
									</div>
									<div class="card-footer bg-c-yellow">
										<div class="row align-items-center">
											<div class="col-12">
												<p class="text-white m-b-0">Menunggu Konfirmasi</p>
											</div>
											<!-- <div class="col-3 text-right">
												<i class="feather icon-trending-up text-white f-16"></i>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-6">
								<div class="card">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col-12">
												<h4 class="text-c-blue f-w-600"><?= $ip ?></h4>
												<h6 class="text-muted m-b-0">Pesanan</h6>
											</div>
											<!-- <div class="col-4 text-right">
												<i class="feather icon-file-text f-28"></i>
											</div> -->
										</div>
									</div>
									<div class="card-footer bg-c-blue">
										<div class="row align-items-center">
											<div class="col-12">
												<p class="text-white m-b-0">Proses</p>
											</div>
											<!-- <div class="col-3 text-right">
												<i class="feather icon-trending-up text-white f-16"></i>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-6">
								<div class="card">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col-12">
												<h4 class="text-c-green f-w-600"><?= $idk ?></h4>
												<h6 class="text-muted m-b-0">Pesanan</h6>
											</div>
											<!-- <div class="col-4 text-right">
												<i class="feather icon-calendar f-28"></i>
											</div> -->
										</div>
									</div>
									<div class="card-footer bg-c-green">
										<div class="row align-items-center">
											<div class="col-12">
												<p class="text-white m-b-0">Dikirim</p>
											</div>
											<!-- <div class="col-3 text-right">
												<i class="feather icon-trending-up text-white f-16"></i>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-2 col-md-6">
								<div class="card">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col-12">
												<h4 class="text-c-blue f-w-600"><?= $isl ?></h4>
												<h6 class="text-muted m-b-0">Pesanan</h6>
											</div>
											<!-- <div class="col-4 text-right">
												<i class="feather icon-download f-28"></i>
											</div> -->
										</div>
									</div>
									<div class="card-footer bg-c-blue">
										<div class="row align-items-center">
											<div class="col-12">
												<p class="text-white m-b-0">Selesai</p>
											</div>
											<!-- <div class="col-3 text-right">
												<i class="feather icon-trending-up text-white f-16"></i>
											</div> -->
										</div>
									</div>
								</div>
							</div>
							<div class="col-xl-3 col-md-6">
								<div class="card">
									<div class="card-block">
										<div class="row align-items-center">
											<div class="col-12">
												<h4 class="text-c-pink f-w-600"><?= $idb ?></h4>
												<h6 class="text-muted m-b-0">Pesanan</h6>
											</div>
											<!-- <div class="col-4 text-right">
												<i class="feather icon-download f-28"></i>
											</div> -->
										</div>
									</div>
									<div class="card-footer bg-c-pink">
										<div class="row align-items-center">
											<div class="col-12">
												<p class="text-white m-b-0">Dibatalkan</p>
											</div>
											<!-- <div class="col-3 text-right">
												<i class="feather icon-trending-up text-white f-16"></i>
											</div> -->
										</div>
									</div>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-6">
								<div class="card">
		                            <div class="card-header">
		                                <h5>User Terbaru</h5>
		                                <span><!-- use class <code>table</code> inside table element --></span>
		                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
		                            </div>
		                            <div class="card-block">
		                                <div class="dt-responsive">
		                                    <table class="table table-responsive table-xs" width="100%">
		                                        <thead>
		                                            <th>Nama</th>
		                                            <th>Email</th>
		                                            <th>No.Telp</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                        	<?php $no=0;
		                                        	foreach ($usr->result() as $key) { 
		                                        		$no++;
		                                        	?>
		                                        	<tr>
		                                        		<td><?= $key->nama ?></td>
		                                        		<td><?= $key->email ?></td>
		                                        		<td><?= $key->no_telp ?></td>
		                                        	</tr>
			                                        <?php } ?>
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <hr style="margin-top: 0">
										<div class="pull-right">
											<a href="<?= site_url('admin/user') ?>">Selengkapnya..</a>
										</div>
		                            </div>
		                        </div>
							</div>
							<div class="col-md-6">
								<div class="card">
		                            <div class="card-header">
		                                <h5>Pesanan Terbaru</h5>
		                                <span><!-- use class <code>table</code> inside table element --></span>
		                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
		                            </div>
		                            <div class="card-block">
		                            	<div class="dt-responsive">
		                                    <table class="table table-responsive table-xs nowrap" width="100%">
		                                        <thead>
		                                            <th>No Invoice</th>
		                                            <th>Data User</th>
		                                            <th width="10%">Total</th>
		                                            </tr>
		                                        </thead>
		                                        <tbody>
		                                        	<?php foreach ($pesanan->result() as $key) {?>
		                                        	<tr><td><?= $key->no_invoice ?></td>
		                                        		<td><?= $key->nama ?></td>
		                                        		<td>Rp. <?= rupiah($key->total) ?>,-</td>
		                                        	</tr>
			                                        <?php } ?>
		                                        </tbody>
		                                    </table>
		                                </div>
		                                <hr style="margin-top: 0">
										<div class="pull-right">
											<a href="<?= site_url('admin/pesanan') ?>">Selengkapnya..</a>
										</div>
		                            </div>
		                        </li>
							</div>
						</div>

					
                    <div class="page-body">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>