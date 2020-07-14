<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>bower_components/jquery.steps/css/jquery.steps.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/') ?>assets/css/style.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.tentang').addClass('active');
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
					<i class="feather icon-book bg-c-blue"></i>
					<div class="d-inline">
						<h5>Tentang Usaha</h5>
						<span>Isi data informasi tentang usaha.</span>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="page-header-breadcrumb">
					<ul class=" breadcrumb breadcrumb-title">
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/home') ?>"><i class="feather icon-home"></i></a>
						</li>
						<li class="breadcrumb-item">
							<a href="<?= site_url('admin/tentang') ?>">Tentang Bengkel Las</a>
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
					<div class="row">
						<div class="col-sm-12">
							<div class="card">
								<div class="card-header">
									<h5>Data Informasi Usaha</h5>	
									<div class="card-header-right"> <ul class="list-unstyled card-option"> <li class="first-opt"><i class="feather icon-chevron-left open-card-option"></i></li> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i></li> <li><i class="feather icon-refresh-cw reload-card"></i></li> <li><i class="feather icon-trash close-card"></i></li> <li><i class="feather icon-chevron-left open-card-option"></i></li> </ul> </div>				
								</div>
								<div class="card-block">
									<?= $this->session->flashdata('pesan'); ?>
			                        <?= $this->session->flashdata('error'); ?>
			                        <?php $arb = array('enctype' => "multipart/form-data", );?>
			                        <?= form_open('admin/tentang/proses',$arb); ?>
			                        <input type="hidden" class="form-control" value="<?= $tentang->id ?>" name="id">
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">Logo Usaha</label>
											<div class="col-sm-10">
												<input id="uploadImage" class="form-control" type="file" name="logo" onchange="PreviewImage();" value="<?= $tentang->logo ?>" />
												<div class="form-group" id="photo-preview"></div>
								                <p class="help-block">PNG, JPG, JPEG - (274px X 84px) Max. 2MB </p>
								                <img id="uploadPreview" style="max-width:300px; height:150px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/assets/img/logo/') ?><?= $tentang->logo ?>" />
												<!-- <input type="file" class="form-control"> -->
											</div>
										</div>
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">Deskripsi Usaha</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="keterangan" rows="8" id="editor1"><?= $tentang->keterangan ?></textarea>
											</div>
										</div>
										<hr>
			                        	<div class="form-group row">
											<label class="col-sm-2 col-form-label">No Telp</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $tentang->no_telp ?>" name="no_telp" maxlength="13" onkeypress='return check_int(event)'>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Facebook</label>
											<div class="col-sm-10">
												<input type="text" class="form-control" value="<?= $tentang->facebook ?>" name="facebook">
											</div>
										</div>
										<div class="form-group row">
					                    	<label class="col-sm-2 col-form-label">Instagram</label>
					                    		<div class="col-sm-10 input-group">
					                        	<span class="input-group-prepend" id="basic-addon2">
					                          		<label class="input-group-text">@</label>
					                        	</span>
					                        	<input type="text" class="form-control" value="<?= $tentang->instagram ?>" name="instagram">
					                      	</div>
					                    </div>
					                    <div class="form-group row">
											<label class="col-sm-2 col-form-label">Alamat</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="alamat" rows="2"><?= $tentang->alamat ?></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-sm-2 col-form-label">Iframe Maps</label>
											<div class="col-sm-10">
												<textarea class="form-control" name="maps" rows="7"><?= $tentang->maps ?></textarea>
											</div>
										</div>
										<hr>
										<div class="form-group row">
											<div class="col-sm-2">
												<button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Simpan Perubahan</abutton>
											</div>
										</div>
									<?= form_close(); ?>
								</div>
							</div>

						</div>
					</div>
				</div>

			</div>
		</div>

		<div id="styleSelector">
		</div>
	</div>
</div>

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