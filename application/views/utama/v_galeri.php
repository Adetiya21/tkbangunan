<section>	
	<div class="container-fluid">
		<div class="row tm-content" style="margin-top:85px; padding-top: 15px;">
			<div class="jenis-font3" style="margin-bottom: 15px;">
				<h2 style="text-align:center; font-size: 35px;">GALERI</h2>
			</div>
			<div class="jenis-font2">
				
			<!-- ISI KONTEN -->
			<?php foreach ($produk->result() as $key) { ?>
				<div class="col-xs-12 col-md-3">
			    	<a href="images/Kanopi/kanopi1.jpg" class="thumbnail">
			      		<img data-src="holder.js/100%x180" src="<?= base_url('assets/assets/img/produk/'.$key->gambar) ?>" alt="...">
			    	</a>
			  	</div>
			<?php } ?>
			</div>
			
			<div class="col-sm-12">
                <hr><br>
                <div class="pages" align="center">
                    <?php echo $halaman; ?> <!--Memanggil variable pagination-->
                </div>
            </div>
		</div>
	</div>
</section>

<script src="<?php echo base_url() ?>assets/front-end/js/jquery-1.11.1.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('.galeri').addClass('active');
    });
</script>