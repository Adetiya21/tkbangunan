<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.kategori').addClass('active');
      $('.input-produk').addClass('active');
  	});


    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    }

    function PreviewImage() {
	    var oFReader = new FileReader();
	    oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

	    oFReader.onload = function (oFREvent) {
	      document.getElementById("uploadPreview").src = oFREvent.target.result;
	    };
	  };
</script>

<div class="pcoded-content">
	<div class="page-header card">
		<div class="row align-items-end">
			<div class="col-lg-8">
				<div class="page-header-title">
					<i class="feather icon-edit bg-c-blue"></i>
					<div class="d-inline">
						<h5>Form Input Kategori Produk</h5>
						<span>Pastikan mengisi data kategori dengan benar.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/kategori') ?>">Kategori</a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/kategori/tambah') ?>">Input Kategori Produk</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>

	<div class="pcoded-inner-content">
		<div class="main-body">
			<div class="page-wrapper">
				<div class="page-body">
					<div class="card">
						<div class="card-header">
							<h5>Input Produk</h5>
							<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>
						</div>
						<div class="card-block">
							<div id="wizard">
								<section>
									<?= $this->session->flashdata('pesan'); ?>
									<?= $this->session->flashdata('error'); ?>
									<?php $arb = array('enctype' => "multipart/form-data", );?>
									<?= form_open('admin/kategori/proses',$arb); ?>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Nama Kategori</label>
				                      <div class="col-sm-10">
				                        <input type="text" class="form-control" placeholder="Nama Kategori Produk" name="nama">
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Deskripsi Singkat</label>
				                      <div class="col-sm-10">
				                        <textarea class="form-control" name="deskripsi" rows="3" placeholder="Deskripsi Singkat">
				                        </textarea> 
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Spesifikasi Produk</label>
				                      <div class="col-sm-10">
				                        <textarea class="form-control" name="spesifikasi" rows="5" id="editor1" placeholder="Spesifikasi Produk">
				                        </textarea> 
				                      </div>
				                    </div>
				                    <div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Gambar Produk</label>
				                      <div class="col-sm-10">
				                        <input id="uploadImage" class="form-control" type="file" name="gambar" onchange="PreviewImage();" value="" />
				                        <div class="form-group" id="photo-preview"></div>
			                                <p class="help-block">JPG, PNG, JPEG, Max. 2MB</p>
			                                <img id="uploadPreview" style="width:300px; height:280px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/kategori/') ?>" />
			                                <!-- <img id="uploadPreview" style="width:350px; height:210px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/produk/') ?>" /> -->
				                      </div>
				                    </div>
				                    <hr>
				                    
				                    
				                    <div class="form-group row">
				                      <!-- <label class="col-sm-2"></label> -->
				                      <div class="col-sm-2">
				                        <button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Simpan Data</abutton>
				                      </div>
				                    </div>
				                  <!-- </form> -->
				                  <?= form_close(); ?>
								</section>
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


<script src="<?= base_url('assets/') ?>assets/pages/waves/js/waves.min.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>

<script src="<?= base_url('assets/') ?>bower_components/jquery.steps/js/jquery.steps.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>
<script src="<?= base_url('assets/') ?>bower_components/jquery-validation/js/jquery.validate.js" type="80e04729b0cb0dda322eaea3-text/javascript"></script>

<script type="80e04729b0cb0dda322eaea3-text/javascript" src="<?= base_url('assets/') ?>assets/pages/form-validation/validate.js"></script>

<script src="<?= base_url('assets/') ?>ajax.cloudflare.com/cdn-cgi/scripts/7089c43e/cloudflare-static/rocket-loader.min.js" data-cf-settings="80e04729b0cb0dda322eaea3-|49" defer=""></script></body>

<!-- ckeditor -->
<script src="<?= base_url('assets/') ?>bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>