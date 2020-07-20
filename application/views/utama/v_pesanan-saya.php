<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_styles.css">
<link rel="stylesheet" type="text/css" href="<?= base_url('assets/front-end/') ?>styles/single_responsive.css">

	<div class="container single_product_container">
		<div class="row">
			<div class="col">
				<!-- Breadcrumbs -->
				<div class="breadcrumbs d-flex flex-row align-items-center">
					<ul>
						<li><a href="<?= site_url() ?>">Home</a></li>
						<li class="active"><a href="<?= site_url('pesanan-saya') ?>"><i class="fa fa-angle-right" aria-hidden="true"></i>Pesanan Saya</a></li>
					</ul>
				</div>

			</div>
		</div>

		<!-- Pesanan Saya -->
		<div class="row" style="margin-top:-50px">
			<div class="col-lg-10 contact_col">
				<div class="contact_contents">
					<h3>Pesanan Saya</h3><hr>
					<p>Hai, silahkan konfirmasi pesanan anda dengan klik tombol detail pesanan, kemudian segera konfirmasi pesanan anda.</p>
					<div class="" style="margin-top:30px">
                        <table style="width:100%" id="mytable" class="table table-responsive-md table-hover">
                            <thead>
                                <tr>
                                    <th width="1px">No</th>
                                    <th>No. Invoice</th>
                                    <th>Waktu Pesan</th>
                                    <th>Total</th>
                                    <th width="100px">Status</th>
                                    <th width="10px">#</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
				</div>
			</div>
			<div class="col-lg-2 contact_col">
				<div class="contact_contents">
					<h3>Profil</h3><hr>
					<ul class="nav">
	                	<li style="padding: 10px;">
		                  <a href="<?= site_url('akun-saya') ?>"><i class="fa fa-user"></i> Akun Saya</a>
		              	</li>
		              	<li style="padding: 10px;background-color: #FF6347;width: 100%;">
		                  <a href="<?= site_url('pesanan-saya') ?>" style="color: #fff"><i class="fa fa-list"></i> Pesanan Saya</a>
		              	</li>
		              	<li style="padding: 10px">
		                  <a href="<?= site_url('logout') ?>"><i class="fa fa-sign-out"></i> Logout</a>
		              	</li>
		          	</ul>				
				</div>
			</div>
		</div>
	</div>

<!-- DataTables Halaman -->
<script src="<?php echo base_url('assets/front-end/') ?>js/jquery-1.11.1.min.js"></script>
<script>
    window.jQuery || document.write('<script src="<?php echo base_url('assets/front-end/') ?>js/jquery-1.11.0.min.js"><\/script>')
</script>
<!-- DataTables -->
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script src="<?=base_url('assets/back-end') ?>/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js" type="text/javascript"></script>
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

    var table = $('#mytable').DataTable({
        oLanguage: {
            sProcessing: "loading..."
        },
        processing: true,
        serverSide: true,
        ajax: {"url": "<?= base_url() ?>pesanan-saya/json", "type": "POST"},
        columns: [
        {
            "data": "id_invoice",
            "orderable": false
        },
        {"data": "no_invoice"},
        {"data": "tgl"},
        {"data": "total",
        render: function(data) { 
            var reverse = data.toString().split('').reverse().join(''),
            ribuan  = reverse.match(/\d{1,3}/g);
            ribuan  = ribuan.join('.').split('').reverse().join('');
                  return 'Rp.'+ribuan;
            },
            defaultContent: 'total'
            
        },
        {"data": "status",
        	render: function(data) { 
                if (data=='Menunggu Konfirmasi') {
                    return '<label class="btn btn-sm btn-warning text-center" style="font-size:0.8em;width:100%">'+data+'</label>'
                } else if (data=='Proses') {
                    return '<label class="btn btn-sm btn-primary text-center" style="font-size:0.8em;width:100%">'+data+'</label>'
                } else if (data=='Dikirim') {
                    return '<label class="btn btn-sm btn-success text-center" style="font-size:0.8em;width:100%">'+data+'</label>'
                } else if (data=='Selesai') {
                    return '<label class="btn btn-sm btn-info text-center" style="font-size:0.8em;width:100%">'+data+'</label>'
                } else if (data=='Dibatalkan') {
                    return '<label class="btn btn-sm btn-danger text-center" style="font-size:0.8em;width:100%">'+data+'</label>'
                }
            },
            defaultContent: 'status'
    	},
        {"data": "view","orderable": false},
        ],
        order: [[2, 'desc']],
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
</script>