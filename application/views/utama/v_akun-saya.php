<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_responsive.css">

	<div class="container single_product_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('akun-saya') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Akun Saya</a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Pesanan Saya -->
		<div class="row" style="margin-top:-50px">
			<div class="col-lg-10 contact_col">
				<div class="contact_contents">
					<h3>Data Diri</h3><hr>
					<p>Lengkapi data diri anda sebelum berbelanja</p>
					<p><?= $this->session->flashdata('error'); ?><?= $this->session->flashdata('pesan'); ?></p>
			        <?= form_open('akun_saya/proses_edit'); ?>
			        <div class="row">
			        	<div class="col-sm-6">
			        		<div class="form-group">
			        			<label>Email</label>
			        			<input class="form-control" value="<?= $users->email ?>" disabled>
			        		</div>
			        	</div>
			        	<div class="col-sm-6">
			        		<div class="form-group">
			        			<label>Nama</label>
			        			<input class="form-control" name="nama" value="<?= $users->nama ?>">
			        		</div>
			        	</div>
			        	<div class="col-sm-6">
			        		<div class="form-group">
			        			<label>No Telp</label>
			        			<input class="form-control" name="no_telp" placeholder="Masukkan No Telp" value="<?= $users->no_telp ?>" maxlength="13" onkeypress='return check_int(event)'>
			        		</div>
			        	</div>
			        	<div class="col-sm-6">
			        		<div class="form-group">
			        			<label>Alamat</label>
			        			<textarea name="alamat" class="form-control" placeholder="Masukkan Alamat"><?= $users->alamat ?></textarea>
			        		</div>
			        	</div>
			        	<div class="col-sm-6">
			        		<button type="submit" class="btn red_button2" style="width: 100%"><i class="fa fa-save"></i>&nbsp; Simpan Data</button>
			        	</div>
			        </div>
			        <?= form_close(); ?>
				</div>

				<br><hr><br>

	            <div class="contact_contents">
	              <div class="heading">
	                <h3 class="text-uppercase">Ganti Password</h3>
	                <hr>
	              </div>
	              <form method="post" role="form" id="form-changepassword" action="<?php echo site_url('akun_saya/proses_ganti_password'); ?>">
	                <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
	                <div class="row">
	                  <div class="col-sm-6">
	                    <div class="form-group">
	                      <label for="password_old">Password Lama</label>
	                      <input type="password" class="form-control" id="old_password" placeholder="" name="old_password" required=" "><span class="help-block" id="error"></span>
	                    </div>
	                  </div>
	                </div>
	                <div class="row">
	                  <div class="col-sm-6">
	                    <div class="form-group">
	                      <label for="password_1">Password Baru</label>
	                      <input type="password" class="form-control" id="password3" placeholder="" name="password" required=" "><span class="help-block" id="error"></span>
	                    </div>
	                  </div>
	                  <div class="col-sm-6">
	                    <div class="form-group">
	                      <label for="password-login">Konfirmasi Password Baru</label>
	                      <input type="password" class="form-control"  placeholder="" required=" " name="cpassword"><span class="help-block" id="error"></span>
	                    </div>
	                  </div>
	                </div>
	                <!-- /.row -->
	                <hr>
	                <div class="row">
	                  <div class="col-sm-6">
		                  <button onclick="refreshTokens()"  class="btn red_button2" style="width: 100%"><i class="fa fa-save"></i>&nbsp; Simpan Password Baru</button>
		              </div>
	                </div>
	              </form>

	            </div>
			</div>
			<div class="col-lg-2 contact_col">
				<div class="contact_contents">
					<h3>Profil</h3><hr>
					<ul class="nav">
	                	<li style="padding: 10px;background-color: #FF6347;width: 100%;">
		                  <a href="<?= site_url('akun-saya') ?>" style="color: #fff"><i class="fa fa-user"></i> Akun Saya</a>
		              	</li>
		              	<li style="padding: 10px;">
		                  <a href="<?= site_url('pesanan-saya') ?>"><i class="fa fa-list"></i> Pesanan Saya</a>
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
	function check_int(evt) {
		var charCode = ( evt.which ) ? evt.which : event.keyCode;
		return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
	};
</script>
<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script src="<?php echo base_url(); ?>assets/front-end/js/jquery.validate.min.js"></script>
<script type="text/javascript">

  function refreshTokens() {
    var url = "<?= base_url()."i/get_tokens" ?>";
    $.get(url, function(theResponse) {
      /* you should do some validation of theResponse here too */
      $('#csrfHash').val(theResponse);;
    });
  }

  $("#form-changepassword").validate({
    rules:
    {
      old_password: {
        required: true,
        minlength: 5,
        maxlength: 15,
        remote: {
          url: "<?php echo base_url()."akun_saya/cek_password"; ?>",
          type: "post",
          data: {
            old_password : function() {
              return $( "#old_password" ).val();
            },
            <?= $this->security->get_csrf_token_name(); ?> : function () {
              refreshTokens();
              return $( "#csrfHash" ).val();
            }
          }
        }
      },
      password: {
        required: true,
        minlength: 5,
        maxlength: 15,
        remote : function () {
          refreshTokens();
        }
      },
      cpassword: {
        required: true,
        equalTo: '#password3',
        remote : function () {
          refreshTokens();
        }
      },
    },
    messages:
    {
      old_password : {
        required : "Password wajib diisi",
        minlength: "Password minimal 5 karakter",
        remote : "Password tidak ada di database"
      },
      password:{
        required: "Password wajib diisi",
        minlength: "Password minimal 5 karakter"
      }
      ,
      cpassword:{
        required: "Masukkan password kembali",
        equalTo: "Password tidak sama !"
      }
    },
    errorPlacement : function(error, element) {
      $(element).closest('.form-group').find('.help-block').html(error.html());
    },
    highlight : function(element) {
      $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    unhighlight: function(element, errorClass, validClass) {
      $(element).closest('.form-group').removeClass('has-error');
      $(element).closest('.form-group').find('.help-block').html('');
    },


  });
</script>
<script>
  window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.0.min.js"><\/script>')
</script>