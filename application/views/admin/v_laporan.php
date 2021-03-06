<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
      $('.laporan').addClass('active');
  	});

    function check_int(evt) {
      var charCode = ( evt.which ) ? evt.which : event.keyCode;
      return ( charCode >= 48 && charCode <= 57 || charCode == 8 );
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
                                        <h4>LAPORAN PEMASUKAN</h4>
                                        <span>Berikut daftar laporan pemasukan perbulan.</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="page-header-breadcrumb">
                                    <ul class="breadcrumb-title">
                                        <li class="breadcrumb-item">
                                            <a href="<?= site_url('admin/home') ?>"> <i class="feather icon-home"></i> </a>
                                        </li>
                                        <li class="breadcrumb-item"><a href="<?= site_url('admin/laporan') ?>">Laporan</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="page-body">
                        <div class="card">
                            <div class="card-header">
                                <h5>Data Laporan Pemasukan Toko Tahun 2020</h5>
                                <span><!-- use class <code>table</code> inside table element --></span>
                                <div class="card-header-right"> <ul class="list-unstyled card-option"> <li><i class="feather icon-maximize full-card"></i></li> <li><i class="feather icon-minus minimize-card"></i><li><i class="feather icon-trash close-card"></i></li></ul> </div>
                            </div>
                            <div class="card-block">
                                <?= form_open('admin/laporan/proses'); ?>
                                <div class="row">                                    
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Pilih Bulan</label>
                                            <div class="col-md-6">           
                                                <select name="bulan" class="form-control">
                                                    <option>Pilih Bulan</option>
                                                    <option value="01">Januari</option>
                                                    <option value="02">Fabuari</option>
                                                    <option value="03">Maret</option>
                                                    <option value="04">April</option>
                                                    <option value="05">Mei</option>
                                                    <option value="06">Juni</option>
                                                    <option value="07">Juli</option>
                                                    <option value="08">Agustus</option>
                                                    <option value="09">September</option>
                                                    <option value="10">Oktober</option>
                                                    <option value="11">November</option>
                                                    <option value="12">Desember</option>
                                                </select>
                                            </div>    
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-6">
                                        <div class="form-group row">
                                        <label class="col-md-3 col-form-label">Pilih Tahun</label>
                                            <div class="col-md-6">           
                                            <select name="bulan" class="form-control">
                                                <option>Pilih Bulan</option>
                                            </select>
                                        </div>    
                                        </div>                                        
                                    </div>   -->
                                    <div class="col-md-6">
                                        <div class="form-group row">
                                        <button class="btn btn-primary m-b-0 btn-round pull-right" style="color: #fff"><i class="fa fa-edit"></i> Lihat Laporan</button>
                                    </div>
                                    </div>
                                    
                                </div>
                                <?= form_close(); ?>

                                    <hr>
                                <div class="dt-responsive">
                                    <h4>Jumlah Pemasukan : <?php if($laporan->total!=null) { 
                                                    echo "Rp. ".rupiah($laporan->total).",-"; 
                                                } ?>
                                    </h4><br>
                                    <table id="compact" class="table table-responsive table-bordered table-hover nowrap" width="100%">
                                        <thead>
                                            <tr><th width="1%">No</th>
                                            <th width="100px">No.Invoice</th>
                                            <th>Nama Pemesan</th>
                                            <th>Tanggal Pesan</th>
                                            <th>Status</th>
                                            <th>Total</th>
                                            <th width="10%">#</th>
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
        ajax: {"url": "<?= base_url() ?>admin/laporan/json/", "type": "POST"},
        columns: [
        {
            "data": "id_invoice",
            "orderable": false
        },
        {"data": "no_invoice"},
        {"data": "user"},
        {"data": "tgl",
            render: function(data) { 
                var datePart = data.match(/\d+/g),
                year = datePart[0].substring(0), // get only four digits
                month = datePart[1], day = datePart[2];

                var ttgl =  day+'/'+month+'/'+year;
                // return ttgl
                return data
            }, 
            defaultContent: 'tgl'
        },
        {"data": "status",
            render: function(data) { 
                if (data=='Menunggu Konfirmasi') {
                    return '<label class="label label-sm label-warning text-center" style="width:90%">'+data+'</label>'
                } else if (data=='Proses') {
                    return '<label class="label label-sm label-primary text-center" style="width:90%">'+data+'</label>'
                } else if (data=='Dikirim') {
                    return '<label class="label label-sm label-success text-center" style="width:90%">'+data+'</label>'
                } else if (data=='Selesai') {
                    return '<label class="label label-sm label-info text-center" style="width:90%">'+data+'</label>'
                } else if (data=='Dibatalkan') {
                    return '<label class="label label-sm label-danger text-center" style="width:90%">'+data+'</label>'
                }
            },
            defaultContent: 'status'
        },
        {"data": "total",
            render: function(data) { 
                var reverse = data.toString().split('').reverse().join(''),
                ribuan  = reverse.match(/\d{1,3}/g);
                ribuan  = ribuan.join('.').split('').reverse().join('');
                      return 'Rp. '+ribuan+',-';
                },
                defaultContent: 'total'
        },
        {"data": "view","orderable": false}
        ],
        order: [[3, 'desc']],
        rowCallback: function(row, data, iDisplayIndex) {
            var info = this.fnPagingInfo();
            var page = info.iPage;
            var length = info.iLength;
            var index = page * length + (iDisplayIndex + 1);
            $('td:eq(0)', row).html(index);
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend:    'excelHtml5',
                text:      '<i class="fa fa-file-excel-o"></i>',
                titleAttr: 'Excel'
            },
            {
                extend:    'pdfHtml5',
                text:      '<i class="fa fa-file-pdf-o"></i>',
                titleAttr: 'PDF'
            }, 'print'
        ]
    });

    //fun reload
    function reload_table()
    {
        table.ajax.reload(null,false); //reload datatable ajax
    }

    function refreshTokens() {
        var url = "<?= base_url()."i/get_tokens" ?>";
        $.get(url, function(theResponse) {
          /* you should do some validation of theResponse here too */
          $('#csrfHash').val(theResponse);;
      });
    }
</script>