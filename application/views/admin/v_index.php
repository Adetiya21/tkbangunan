<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
	$(document).ready(function() {
		$('.home').addClass('active');
	});
</script>
<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-home bg-c-blue"></i>
					<div class="d-inline">
						<h5>Dashboard Admin</h5>
						<span>Selamat Datang Admin <?= $this->session->userdata('nama')?></span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item"><a href="<?= site_url('admin/home') ?>">Home</a> </li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">

					<div class="row">

						<a href="<?= site_url('admin/kategori') ?>" class="col-xl-6 col-md-6">
							<div class="card prod-p-card card-red">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Kategori Produk</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $kategori ?> <span style="font-size: 0.7em">Kategori</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-layout text-c-red f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</a>
						<div class="col-xl-6 col-md-6">
							<div class="card prod-p-card card-yellow">
								<div class="card-body">
									<div class="row align-items-center m-b-30">
										<div class="col">
											<h6 class="m-b-5 text-white">Total Galeri Produk</h6>
											<h3 class="m-b-0 f-w-700 text-white"><?= $produk ?> <span style="font-size: 0.7em">Gambar</span></h3>
										</div>
										<div class="col-auto">
											<i class="fas feather icon-clipboard text-c-yellow f-18"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
					<div class="col-xl-8 col-md-12">
						<div class="row">
							<a href="<?= site_url('admin/admin') ?>" class="col-xl-6 col-md-6">
								<div class="card comp-card">
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-b-25">Total Admin</h6>
												<h3 class="f-w-700 text-c-red"><?= $admin ?> Akun</h3>
											</div>
											<div class="col-auto">
												<i class="fas fa-users bg-c-red"></i>
											</div>
										</div>
									</div>
								</div>
							</a>
							<a href="<?= site_url('admin/header') ?>" class="col-xl-6 col-md-6">
								<div class="card comp-card">
									<div class="card-body">
										<div class="row align-items-center">
											<div class="col">
												<h6 class="m-b-25">Total Gambar Header</h6>
												<h3 class="f-w-700 text-c-yellow"><?= $header ?> Gambar</h3>
											</div>
											<div class="col-auto">
												<i class="fas fa-image bg-c-yellow"></i>
											</div>
										</div>
									</div>
								</div>
							</a>

							<div class="col-xl-12 col-md-12">
								<div class="card table-card">
									<div class="card-header">
										<h5>Fasilitas</h5>
										<div class="card-header-right">
											<ul class="list-unstyled card-option">
												<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
												<li><i class="feather icon-maximize full-card"></i></li>
												<li><i class="feather icon-minus minimize-card"></i></li>
												<li><i class="feather icon-refresh-cw reload-card"></i></li>
												<li><i class="feather icon-trash close-card"></i></li>
												<li><i class="feather icon-chevron-left open-card-option"></i></li>
											</ul>
										</div>
									</div>
									<div class="card-block">
										<div class="table-responsive">
											<table class="table table-hover m-b-0  table-borderless">
												<thead>
													<tr>
														<th width="10px">No.</th>
														<th>Judul dan Deskripsi</th>
													</tr>
												</thead>
												<tbody>
													<?php $no=1; foreach ($fasilitas->result() as $key) { ?>
													<tr><td align="center"><?= $no; ?></td>
														<td >
															<div class="d-inline-block align-middle">
																<h6><?= $key->judul ?></h6>
																<p class="text-muted m-b-0"><?= substr($key->deskripsi,0,75) ?>...</p>
															</div>
														</td>
													</tr>
													<?php $no++; } ?>
												</tbody>	
											</table>
										</div>
										<hr>
										<div class="pull-right" style="padding-right: 30px;">
											<a href="<?= site_url('admin/fasilitas') ?>">Selengkapnya..</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

						<div class="col-xl-4 col-md-12">
							<div class="card table-card">
								<div class="card-header">
									<h5>Galeri Produk Terbaru</h5>
									<div class="card-header-right">
										<ul class="list-unstyled card-option">
											<li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li>
											<li><i class="feather icon-maximize full-card"></i></li>
											<li><i class="feather icon-minus minimize-card"></i></li>
											<li><i class="feather icon-refresh-cw reload-card"></i></li>
											<li><i class="feather icon-trash close-card"></i></li>
											<li><i class="feather icon-chevron-left open-card-option"></i></li>
										</ul>
									</div>
								</div>
								<div class="card-block">
									<table class="table table-hover table-xs">
										<thead>
											<tr>
												<!-- <th width="10px">No.</th> -->
												<th>Gambar</th>
												<th>Kategori</th>
											</tr>
										</thead>
										<tbody>
											<?php $no=1; foreach ($pr->result() as $key) { ?>
											<tr>
												<td><img class="img-thumbnail" width="80px" src="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>">
												</td>
												<td style="vertical-align: middle;"><?php foreach ($kat->result() as $key1) {
												if($key->id_kategori==$key1->id){
													echo $key1->nama;
												}} ?></td>
											</tr>
											<?php $no++; } ?>
										</tbody>	
									</table>
									<hr>
									<div class="pull-right" style="padding-right: 30px;">
										<a href="<?= site_url('admin/produk') ?>">Selengkapnya..</a>
									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
</div>

<div id="styleSelector">
</div>