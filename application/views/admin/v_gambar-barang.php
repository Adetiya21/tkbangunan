<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    // menu aktif
    $(document).ready(function() {
      $('.barang').addClass('active');
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
                                        <h4>TAMBAH GAMBAR BARANG</h4>
                                        <span>Berikut data dan form tambah gambar barang.</span>
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
                                        <li class="breadcrumb-item">
							              <a href="<?= site_url('admin/gambar/barang/'.$barang->slug) ?>"><?= $barang->nama_barang ?></a>
							            </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Detail Barang</h5>
                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
                            </div>
                            <div class="card-block">
                            	<div class="dt-responsive">
				                    <table class="table table-sm table-responsive nowrap">
				                        <tr>
				                          <th width="15%">Nama Barang</th>
				                          <td><?= $barang->nama_barang ?></td>
				                          <td rowspan="5" width="300px"><img src="<?= base_url('assets/back-end/images/produk/'.$barang->gambar) ?>" alt="" width="100%" class="img-thumbnail"></td>
				                        </tr>
				                        <tr>
				                          <th>Harga Satuan Barang</th>
				                          <td>Rp. <?= rupiah($barang->harga_barang); ?>,00</td>
				                        </tr>
				                        <tr>
				                          <th>Tanggal Posting</th>
				                          <td><?php echo date('d F Y', strtotime($barang->tgl)); ?></td>
				                        </tr>
				                        <tr>
				                          <th>Kuantitas Penjualan (Stok)</th>
				                          <td><?= $barang->stok_barang ?> <?= $satuan->satuan ?></td>
				                        </tr>
				                        <tr>
				                          <th>Link barang</th>
				                          <td>
				                            <a class="btn btn-primary btn-rounded btn-sm" href="<?= site_url('barang/detail/'.$barang->slug) ?>" target="_blank"><span class="fa fa-eye"></span> Link Barang</a>
				                          </td>
				                        </tr>
				                    </table>
				                </div>
				            </div>
				        </div>

				        <div class="card">
                            <div class="card-header">
                                <h5>Tambah Gambar Barang</h5>
                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
                            </div>
                            <div class="card-block">
                            	<div class="dt-responsive">
				                    <?= $this->session->flashdata('pesan'); ?>
									<?= $this->session->flashdata('error'); ?>
									<?php $arb = array('enctype' => "multipart/form-data", );?>
									<?= form_open('admin/gambar/proses',$arb); ?>
									<input type="hidden" name="id_barang" value="<?= $barang->id_barang ?>">
									<input type="hidden" name="slug" value="<?= $barang->slug ?>">
									<div class="form-group row">
				                      <label class="col-sm-2 col-form-label">Gambar Barang</label>
				                      <div class="col-sm-8">
				                        <input type="file" name="gambar[]" class="form-control" id="chooseFile" multiple>
				                        <p class="help-block">JPG, PNG, JPEG - Max. 2MB</p> 
				                        <div class="imgGallery">
									      <!-- Image preview -->
									    </div>
				                      </div>
				                    </div>
				                    <hr>
				                    <div class="form-group row">
				                      <div class="col-sm-12 text-right">
				                        <button class="btn btn-primary m-b-0 btn-round" style="color: #fff"><i class="fa fa-edit"></i> Simpan Data</abutton>
				                      </div>
				                    </div>
				                  	<?= form_close(); ?>
				                </div>
				            </div>
				        </div>

				        <div class="card">
                            <div class="card-header">
                                <h5>Daftar Gambar Barang</h5>
                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
                            </div>
                            <div class="card-block">
                                <div class="dt-responsive">
                                    <table id="compact" class="table table-responsive table-hover nowrap" width="100%">
                                        <thead>
                                            <tr><th width="1%">No</th>
                                            <th width="300px">Gambar</th>
                                            <th>#</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
				    </div>
	            </div>
	        </div>
	    </div>
	</div>

<!-- DataTables -->
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/assets/pages/data-table/js/jszip.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/assets/pages/data-table/js/pdfmake.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/assets/pages/data-table/js/vfs_fonts.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-buttons/js/buttons.print.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js" type="text/javascript"></script>

<!-- page script -->
<script type="text/javascript">
    $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
    {
        return {
            "iStart": oSettings._iDisplayStart,
            "iEnd": oSettings.fnDisplayEnd(),
            "iLength": oSettings._iDisplayLength,
            "iTotal": oSettings.fnRecordsTotal(),
            "iFilteredTotal": oSettings.fnRecordsDisplay(),
            "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
            "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
        };
    };

    var table = $('#compact').DataTable({
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url() ?>admin/gambar/json/<?= $barang->id_barang ?>", "type": "POST"},
        columns: [
        {
            "data": "id_gambar",
            "orderable": false
        },
        {"data": "gambar","orderable": false,
            render: function(data) { 
                if(data!==null) {
                  return '<img class="img-thumbnail" width="100%" src="<?= base_url('assets/back-end/images/produk/') ?>'+data+'">'
                } else {
                    return '<i>(Tidak ada foto)</i>'
                }},
              defaultContent: 'Gambar'
        },
        {"data": "view","orderable": false}
        ],
        order: [[0, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        }
    });

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    //fun Hapus
    function hapus(id)
    {
        if(confirm('Anda yakin ingin menghapus data?'))
        {
            // ajax delete data to database
            $.ajax({
                url : '<?php echo site_url("admin/gambar/hapus/'+id+'") ?>',
                type: "POST",
                dataType: "JSON",
                data: { <?= $this->security->get_csrf_token_name(); ?> : function () {
                  refreshTokens();
                  return $( "#csrfHash" ).val();
              }},
              success: function(data)
              {
                    //if success reload ajax table
                    $('#modal_form').modal('hide');
                    reload_table();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error deleting data');
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

<!-- script multiple gambar -->
<script>
	$(function() {
	// Multiple images preview with JavaScript
	var multiImgPreview = function(input, imgPreviewPlaceholder) {
		$('.imgGallery').empty();
	    if (input.files) {
	        var filesAmount = input.files.length;
	        for (i = 0; i < filesAmount; i++) {
	            var reader = new FileReader();
	            reader.onload = function(event) {
	                $($.parseHTML('<img style="padding: 5px; max-width: 200px;" class="img-thumbnail">')).attr('src', event.target.result).appendTo(imgPreviewPlaceholder);
	            }
	            reader.readAsDataURL(input.files[i]);
	        }
	    }
	};

	$('#chooseFile').on('change', function() {
	    multiImgPreview(this, 'div.imgGallery');
	  });
	});    
</script>