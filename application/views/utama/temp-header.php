<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<meta name="google-site-verification" content="O4C_JgfOt58MdQ9NdnuNyPvVlW9FoR08v2hf3f3sBgI" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<link rel="icon" type="image/png" href="<?= base_url('assets/front-end/') ?>icon.ico">

	<title><?= $title ?> Bengkel Las Pontianak</title>

	<!-- link to font-awesome -->
	<link rel="stylesheet" href="<?= base_url('assets/front-end/') ?>css/font-awesome.min.css">
	<!-- link to Bootstrap CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>css/bootstrap.min.css">

	<!-- link to Optional Theme CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>css/bootstrap-theme.min.css">

	<!-- link to my CSS -->
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>css/main.css">
</head>
<body>
	<?php $ten = $this->DButama->GetDB('tb_tentang')->row(); ?>
	<header>
		<nav class="navbar navbar-default navbar-fixed-top navigasi-set jenis-font" role="navigation">
		  <div class="container-fluid tm-contact">
			<div class="row" style="text-align: center;">
				<span class="col-lg-2 col-xs-12 pull-left">
					<a href="https://api.whatsapp.com/send?phone=62<?= $ten->no_telp; ?>" target="_blank"><span class="fa fa-phone"></span> WA : <?= $ten->no_telp; ?>
					</a>
				</span>
				<span class="col-lg-2 col-xs-12 pull-right">
					<a href="https://www.facebook.com/<?= $ten->facebook; ?>" style="padding-right: 5px;" target="_blank"><i class="fa fa-facebook-official"></i> Facebook </a>
					<a href="https://www.instagram.com/<?= $ten->instagram; ?>" target="_blank"><i class="fa fa-instagram"></i> Instagram </a>
				</span>
			</div>
		  </div>
		  <div class="container-fluid">
		    <!-- Brand and toggle get grouped for better mobile display -->
		    <div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?= site_url() ?>"><img src="<?= base_url('assets/assets/img/logo/'.$ten->logo) ?>" class="img-logo"></a>
		    </div>

		    <!-- Collect the nav links, forms, and other content for toggling -->
		    <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
		      <ul class="nav navbar-nav">
		        <li class="home"><a href="<?= site_url('') ?>">Home</a></li>
		        <li class="tentang"><a href="<?= site_url('tentang-kami') ?>">Tentang Kami</a></li>
		        <li class="galeri"><a href="<?= site_url('galeri') ?>">Galeri</a></li>
		        <li class="dropdown produk">
		          <a href="javascript:void(0)" class="dropdown-toggle" data-toggle="dropdown">Produk <span class="caret"></span></a>
		          <ul class="dropdown-menu" role="menu">
		          	<?php
                    $kat =  $this->db->order_by('nama', 'asc');
                    $kat = $this->DButama->GetDB('tb_kategori_produk');
                    foreach ($kat->result() as $key):
                    ?>
                    <li><a href="<?php echo site_url('produk/i/'.$key->slug) ?>"> <?=  $key->nama ?></a></li>
		            <?php endforeach ?>
		          </ul>
		        </li>
		        <li class="temukan"><a href="<?= site_url('temukan-kami') ?>">Temukan Kami</a></li>
		      </ul>
		      <div class="navbar-form navbar-right" role="search">
		      	<?= form_open('produk/cari'); ?>
		        <div class="form-group">
		          <input type="text" class="form-control" placeholder="Cari produk" name="cari">
		        </div>
		        <button type="submit" class="btn btn-default tbl-cari">Cari</button>
		        <?= form_close(); ?>
		      </div>
		    </div><!-- /.navbar-collapse -->
		  </div><!-- /.container-fluid -->
		</nav>
	</header>