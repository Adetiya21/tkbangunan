<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // menu aktif
    $(document).ready(function() {
      $('.barang').addClass('active');
      $('.daftar-barang').addClass('active');
  	});

    // fun numerik
    function check_int(evt) {
        var charCode = ( evt.which ) ? evt.which : event.keyCode;
        return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
    };

    // fun image preview
    function PreviewImage() {
        var oFReader = new FileReader();
        oFReader.readAsDataURL(document.getElementById("uploadImage").files[0]);

        oFReader.onload = function (oFREvent) {
          document.getElementById("uploadPreview").src = oFREvent.target.result;
        };
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
                                        <h4>EDIT BARANG</h4>
                                        <span>Berikut form edit data barang.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="<?= site_url('admin/home') ?>"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/barang') ?>">Daftar Barang</a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/barang/edit/'.$barang->id_barang) ?>">Edit Barang</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Form Edit Barang</h5>
                                <span><!-- use class <code>table</code> inside table element --></span>
                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
                            </div>
                            <div class="card-block">
                                <?= $this->session->flashdata('pesan'); ?>
                                <?= $this->session->flashdata('error'); ?>
                                <?php $arb = array('enctype' => "multipart/form-data", );?>
                                <?= form_open('admin/barang/proses_edit',$arb); ?>
                                    <div class="row">
                                        <input type="hidden" value="<?= $barang->id_barang ?>" name="id_barang">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">Nama Barang*</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang" value="<?= $barang->nama_barang ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-4 col-form-label">Satuan Barang*</label>
                                                <div class="col-md-8">
                                                    <select name="id_satuan" class="js-example-basic-single">
                                                        <option>Pilih Satuan</option>
                                                        <?php foreach ($satuan->result() as $key) {
                                                            if ($barang->id_satuan==$key->id_satuan) { ?>
                                                            <option value="<?= $key->id_satuan ?>" selected><?= $key->satuan ?></option>
                                                        <?php } else { ?>
                                                            <option value="<?= $key->id_satuan ?>"><?= $key->satuan ?></option>
                                                        <?php }} ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Stok*</label>
                                                <div class="col-md-10">
                                                    <input type="number" class="form-control" placeholder="Stok" name="stok_barang" value="<?= $barang->stok_barang ?>" style="width:100px">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <label class="col-sm-4 col-lg-2 col-form-label">Harga Barang*</label>
                                                <div class="col-sm-8 col-lg-10">
                                                    <div class="input-group">
                                                        <span class="input-group-addon" id="basic-addon2">Rp.</span>
                                                        <input type="text" class="form-control" placeholder="Harga Barang per Satuan" name="harga_barang" maxlength="8" onkeypress='return check_int(event)' value="<?= $barang->harga_barang ?>">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2 col-form-label">Deskripsi*</label>
                                                <div class="col-md-10">
                                                    <textarea class="form-control" name="deskripsi" rows="3" id="editor1"><?= $barang->deskripsi ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 col-form-label">Gambar Barang</label>
                                                <div class="col-sm-10">
                                                    <input id="uploadImage" class="form-control" type="file" name="gambar" onchange="PreviewImage();" value="" />
                                                    <div class="form-group" id="photo-preview"></div>
                                                    <p class="help-block">JPG, PNG, JPEG - Max. 2MB</p> 
                                                    <img id="uploadPreview" style="max-width:450px; height:250px; border-radius: 10px; box-shadow: 0px 0px 3px 0px;" src="<?= base_url('assets/back-end/images/produk/'.$barang->gambar) ?>" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="form-group row">
                                      <!-- <label class="col-sm-2"></label> -->
                                      <div class="col-md-12">
                                        <a href="<?= site_url('admin/barang') ?>" class="btn btn-inverse m-b-0 btn-round pull-left" style="color: #fff"><i class="fa fa-times"></i> Batal</a>
                                        <button class="btn btn-primary m-b-0 btn-round pull-right" style="color: #fff"><i class="fa fa-edit"></i> Simpan Data</button>
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

<!-- ckeditor -->
<script src="<?= base_url('assets/back-end/files/') ?>bower_components/ckeditor/ckeditor.js"></script>
<script>
  $(function () {
    // Replace the <textarea id="editor1"> with a CKEditor
    // instance, using default configuration.
    CKEDITOR.replace('editor1')
    //bootstrap WYSIHTML5 - text editor
    $('.textarea').wysihtml5()
  })
</script>