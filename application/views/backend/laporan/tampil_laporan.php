
<div class="row">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="team-item thumbnail">
			<img src="<?php echo base_url();?>assets/web/images/clipboard.png" alt="Clipboard" class="tile-image big-illustration">
			<h3 class="tile-title">Laporan Keseluruhan</h3>
			<p>Proses download laporan keseluruhan data alumni.</p>
			<a class="btn btn-primary btn-large btn-block" href="<?php echo base_url();?>index.php/claporanpdf/cetakpdf"><i class="glyphicon glyphicon-download"></i> Download </a>
			
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="team-item thumbnail">
			<img src="<?php echo base_url();?>assets/web/images/book.png" alt="Book" class="tile-image big-illustration">
			<h3 class="tile-title">Laporan Per Tahun Lulus</h3>
			<p>Proses download laporan berdasarkan tahun lulus.</p>
			<form id="form-filter" class="form-horizontal" method="get" action="<?php echo base_url();?>index.php/claporanpdf/cetaktahun">
				
				<input type="text" name="tahun_lulus" id="tahun_lulus" placeholder="Masukkan tahun lulus" class="form-control">	
				<br>
				<div class="text-center">
					<button type="submit" name="submit" class="btn btn-primary btn-large btn-block"><i class="glyphicon glyphicon-download"></i> Download</button>
				</div>
			</form>
		</div>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="team-item thumbnail">
			<img src="<?php echo base_url();?>assets/web/images/map.png" alt="Map" class="tile-image big-illustration">
			<h3 class="tile-title">Laporan Per Jurusan</h3>
			<p>Proses download laporan berdasarkan Jurusan alumni.</p>
			<form id="form-filter" class="form-horizontal" method="get" action="<?php echo base_url();?>index.php/claporanpdf/cetakjurusan">
				<!-- <input type="text" name="jurusan" id="jurusan" placeholder="Masukkan tahun lulus" class="form-control">	-->
				<select name="nama_jurusan" id="nama_jurusan" class="form-control">
					<?php
					$jurusan = $this->db->get('jurusan');
					foreach ($jurusan->result() as $row) {
						
						?>
						<option value="<?php echo $row->nama_jurusan;?>"><?php echo $row->nama_jurusan;?></option>
						<?php }?>                                            
					</select>
					<br>
					<div class="text-center">
						<button type="submit" name="submit" class="btn btn-primary btn-large btn-block"><i class="glyphicon glyphicon-download"></i> Download</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	