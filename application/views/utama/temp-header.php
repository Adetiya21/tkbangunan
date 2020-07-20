<!DOCTYPE html>
<html lang="en">
<head>
<title><?= $title ?></title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="description" content="Colo Shop Template">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- Favicons -->
<link href="<?= base_url('assets/front-end/') ?>favicon.png" rel="icon">
<link href="<?= base_url('assets/front-end/') ?>apple-touch-icon.png" rel="apple-touch-icon">

<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/bootstrap4/bootstrap.min.css">
<link href="<?= base_url('assets/front-end/') ?>plugins/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>plugins/OwlCarousel2-2.2.1/owl.carousel.css">
<link href="<?= base_url('assets/front-end/') ?>lib/animate/animate.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>plugins/OwlCarousel2-2.2.1/owl.theme.default.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>plugins/OwlCarousel2-2.2.1/animate.css">
<link rel="stylesheet" href="<?= base_url('assets/front-end/') ?>plugins/themify-icons/themify-icons.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>plugins/jquery-ui-1.12.1.custom/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/main_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/responsive.css">

<!-- search -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400" rel="stylesheet" />
<link href="<?php echo base_url() ?>assets/front-end/search/css/main.css" rel="stylesheet" />

<!-- Recapcha -->
    <?=  $this->recaptcha->getScriptTag(); ?>
</head>

<body>

<div class="super_container">
	<!-- Header -->
	<header class="header trans_300">
		<!-- Top Navigation -->
		<div class="top_nav">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="top_nav_left">
							<a href="<?= $ten->fb ?>"><i class="fa fa-facebook-official"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; 
							<a href="<?= $ten->ig ?>"><i class="fa fa-instagram"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; 	
							<a href="mailto:<?= $ten->email ?>"><i class="fa fa-envelope"></i></a> &nbsp;&nbsp;|&nbsp;&nbsp; 
							<a href="https://api.whatsapp.com/send?phone=62<?= $ten->no_telp ?>"><i class="fa fa-phone"></i></a>
						</div>							
					</div>
					<div class="col-md-6 text-right">
						<div class="top_nav_right">
							<ul class="">
								<?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') { ?>
								<li class="account"><a href="javascript:void(0)" onclick="login()"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a></li>
								<li class="account"><a href="javascript:void(0)" onclick="daftar()"><i class="fa fa-user" aria-hidden="true"></i> Daftar</a></li>
								<?php } else { ?>
								<li class="account">
									<a href="javascript:void(0)">
										<i class="fa fa-user" aria-hidden="true"></i> <?= $this->session->userdata('nama'); ?>
										<i class="fa fa-angle-down"></i>
									</a>
									<ul class="account_selection" style="text-align: left;width: 200px;padding: 10px;">
										<li><a href="<?= site_url('akun-saya') ?>"><i class="fa fa-user" aria-hidden="true"></i> Akun Saya</a></li>
										<li><a href="<?= site_url('pesanan-saya') ?>"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Pesanan Saya</a></li>
										<li><a href="<?= site_url('logout') ?>"><i class="fa fa-sign-out" aria-hidden="true"></i> Logout</a></li>
									</ul>
								</li>
								<?php } ?>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- Main Navigation -->
		<div class="main_nav_container">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-right">
						<div class="logo_container">
							<a href="<?= site_url() ?>">Toko <span><?= $ten->nama ?></span></a>
						</div>
						<nav class="navbar">
							<ul class="navbar_menu">
								<li class="home"><a href="<?= site_url() ?>">Home</a></li>
								<li class="tentang-toko"><a href="<?= site_url('tentang-toko') ?>">Tentang Toko</a></li>
								<li class="kontak-toko"><a href="<?= site_url('kontak-toko') ?>">Kontak Toko</a></li>
									
							</ul>
							<?php $jumlah_cart = $this->cart->total_items(); ?>
							<ul class="navbar_user">
								<li style="padding-right: 10px">
									<div class="s128">
	                                  <?= form_open('i/cari'); ?>
	                                    <div class="inner-form">
	                                      <div class="row">
	                                        <div class="input-field second">
	                                          <input type="search" placeholder="Cari Barang" name="cari"/>
	                                        </div>
	                                      </div>
	                                    </div>
	                                  <?= form_close(); ?>
	                                </div>
									<!-- <a href="#"><i class="fa fa-search" aria-hidden="true"></i></a> -->
								</li>
								<li class="checkout">
									<a href="<?= site_url('keranjang-belanja') ?>">
										<i class="fa fa-shopping-cart" aria-hidden="true"></i>
										<span id="checkout_items" class="checkout_items"><?= $jumlah_cart; ?></span>
									</a>
								</li>
							</ul>
							<div class="hamburger_container">
								<i class="fa fa-bars" aria-hidden="true"></i>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="fs_menu_overlay"></div>
	<div class="hamburger_menu">
		<div class="hamburger_close"><i class="fa fa-times" aria-hidden="true"></i></div>
		<div class="hamburger_menu_content text-right">
			<ul class="menu_top_nav">
				<?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') { ?>
				<li class="menu_item"><a href="javascript:void(0)" onclick="login()">Login</a></li>
				<li class="menu_item"><a href="javascript:void(0)" onclick="daftar()">Daftar</a></li>
				<?php } else { ?>
				<li class="akun menu_item has-children">
					<a href="#">
						<?= $this->session->userdata('nama'); ?>
						<i class="fa fa-angle-down"></i>
					</a>
					<ul class="menu_selection">
						<li><a href="<?= site_url('akun-saya') ?>">Akun Saya</a></li>
						<li><a href="<?= site_url('pesanan-saya') ?>">Pesanan Saya</a></li>
						<li><a href="<?= site_url('logout') ?>">Logout</a></li>
					</ul>
				</li>
				<?php } ?>
				<li class="home menu_item"><a href="<?= site_url() ?>">Home</a></li>
				<li class="tentang-toko menu_item"><a href="<?= site_url('tentang-toko') ?>">Tentang Toko</a></li>
				<li class="kontak-toko menu_item"><a href="<?= site_url('kontak-toko') ?>">Kontak Toko</a></li>
			</ul>
		</div>
	</div>