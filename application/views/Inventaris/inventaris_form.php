<?php
$this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') {
?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header">
						<h4 class="title">Data Inventaris</h4>
					</div>
					<div class="content">

						<form action="<?php echo $action; ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Aset</label>
										<input type="text" placeholder="Nama Aset" value="<?php echo $nama_aset; ?>" class="form-control" name="nama_aset">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Jumlah</label>
										<input type="text" placeholder="Jumlah" value="<?php echo $jumlah; ?>" class="form-control" name="jumlah">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Kondisi</label>
										<select class="form-control select2" name="kondisi" style="width: 100%;">
											<option value="Pilih">Pilih...
											</option>
											<option value="Baik">Baik</option>
											<option value="Rusak">Rusak</option>
										</select>
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Keterangan Lain</label>
										<input type="text" placeholder="Keterangan lainnya (Bila ada)" value="<?php echo $keterangan_lain; ?>" class="form-control" name="keterangan_lain">
									</div>
								</div>
							</div>

							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

							<a href="<?php echo site_url('Inventaris') ?>" class="btn btn-default">Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>