	<!-- Footer -->
	<footer class="footer">
		<div class="container">
			<div class="row">
				<div class="col-lg-9">
					<div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
						<div class="cr">Copyright© 2020 All Rights Reserverd.</div>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
						<ul>
							<li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
							<li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</footer>
</div>

<!-- Template Main Javascript File -->
<script src="<?= base_url('assets/front-end/') ?>js/jquery-3.2.1.min.js"></script>
<script src="<?= base_url('assets/front-end/') ?>styles/bootstrap4/popper.js"></script>
<script src="<?= base_url('assets/front-end/') ?>styles/bootstrap4/bootstrap.min.js"></script>
<script src="<?= base_url('assets/front-end/') ?>plugins/easing/easing.js"></script>
<script src="<?= base_url('assets/front-end/') ?>js/cart.js"></script>
<script src="<?= base_url('assets/front-end/') ?>js/main.js"></script>
<script src="<?= base_url('assets/front-end/') ?>lib/wow/wow.min.js"></script>
<script src="<?= base_url('assets/front-end/') ?>plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/front-end/') ?>plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="<?= base_url('assets/front-end/') ?>js/single_custom.js"></script>
<script src="<?= base_url('assets/front-end/') ?>js/custom.js"></script>


</body>
</html>

<!-- script login dan daftar -->
<script type="text/javascript">
    //fun tambah
    function daftar()
    {
        save_method = 'add';
        $('#form')[0].reset();
        $('#daftar-modal').modal('show');
    }

    //fun login
    function login()
    {
        save_method = 'login';
        $('#form-login')[0].reset();
        $('#login-modal').modal('show');
    }

    //fun simpan
    function save()
    {
        refreshTokens();
        $('#btnSave').text('proses...'); //change button text
        $('#btnSave').attr('disabled',true); //set button disable

        if(save_method == 'add') {
            url = "<?php echo site_url('i/proses_daftar')?>";
            // ajax adding data to database
            var formData = new FormData($('#form')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",

                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#daftar-modal').modal('hide');
                        location.reload();
                        alert("Akun anda berhasil didaftarkan, silahkan login untuk masuk ke menu akun")
                    } 
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Daftar Gagal');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });

        } else if(save_method == 'login') {
            url = "<?php echo site_url('i/login')?>";
            // ajax adding data to database
            var formData = new FormData($('#form-login')[0]);
            $.ajax({
                url : url,
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                dataType: "JSON",

                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#login-modal').modal('hide');
                        location.reload();
                        alert("Selamat Datang");                    
                    } 
                    if(data.status1) //if success close modal and reload ajax table
                    {
                        $('#login-modal').modal('hide');
                        location.replace('<?= site_url('akun-saya'); ?>');
                        alert("Selamat datang, lengkapi data diri anda sebelum berbelanja");
                    } 
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Login Gagal');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable
                }
            });
        }
    }
    function refreshTokens() {
        var url = "<?= base_url()."i/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>
<script type="text/javascript">
    $(function() {
        $("#form").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    remote : function () {
                      refreshTokens();
                    }
                },
                email: "required email",
            },
            messages:
            {
              password:{
                required: "Password wajib diisi",
                minlength: "Password minimal 5 karakter"
              },
              email: {
                required: "Enter your Email",
                email: "Masukkan alamat email yang benar.",
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
    });

    $(function() {
        $("#form-login").validate({
            rules: {
                password: {
                    required: true,
                    minlength: 5,
                    maxlength: 15,
                    remote : function () {
                      refreshTokens();
                    }
                },
                email: "required email",
            },
            messages:
            {
              password:{
                required: "Password wajib diisi",
                minlength: "Password minimal 5 karakter"
              },
              email: {
                required: "Enter your Email",
                email: "Masukkan alamat email yang benar.",
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
    });
</script>

<!-- *** LOGIN MODAL ***
    _________________________________________________________ -->
    <?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') {
        ?>
        <div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
            <div class="modal-dialog" style="width: 395px;text-align: center;">
                <div class="modal-content" style="padding-left: 30px;padding-right: 30px;">
                    <div class="modal-header">
                        <h3 class="modal-title">Login Akun</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form action="#" id="form-login" class="form-horizontal">
                            <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_user" required/>
                            <div class="form-group">
                                <input type="email" class="form-control" placeholder="Email" name="email" required/>
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password" required =" "/>
                                <span class="help-block"></span>
                            </div>
                            <?= $this->recaptcha->getWidget() ?><hr>
                            <button type="button" id="btnSave" onclick="save()" class="btn red_button" style="color: #fff;width: 100%;"> Login</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p>Powered by <a href="<?php echo site_url() ?>"><?= $ten->nama ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

<!-- *** LOGIN MODAL END *** -->

<!-- *** DAFTAR MODAL ***
    _________________________________________________________ -->
    <?php if ($this->session->userdata('user_logged_in') != 'Sudah_Loggin') {
        ?>
        <div class="modal fade" id="daftar-modal" tabindex="-1" role="dialog" aria-labelledby="Daftar" aria-hidden="true">
            <div class="modal-dialog" style="width: 395px;text-align: center;">
                <div class="modal-content" style="padding-left: 30px;padding-right: 30px;">
                    <div class="modal-header">
                        <h3 class="modal-title">Daftar Akun</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body form">
                        <form action="#" id="form" class="form-horizontal">
                            <input type="hidden" id="csrfHash" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" style="display: none">
                            <input type="hidden" name="id_user" required/>
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nama" name="nama" required/>
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Email" name="email" required=" "  />
                                    <span class="help-block" id="error"></span>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" id="password" required=" " />
                                    <span class="help-block" id="error"></span>
                                </div>   
                            <?= $this->recaptcha->getWidget() ?><hr>
                            <button type="button" id="btnSave" onclick="save()" class="btn red_button" style="color: #fff;width: 100%;"> Daftar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <p>Powered by <a href="<?php echo site_url() ?>"><?= $ten->nama ?></a></p>
                    </div>
                </div>
            </div>
        </div>
        <?php } ?>

<!-- *** DAFTAR MODAL END *** -->

<script src="<?php echo base_url(); ?>assets/front-end/js/jquery.validate.min.js"></script>
<script>
  window.jQuery || document.write('<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.0.min.js"><\/script>')
</script>
