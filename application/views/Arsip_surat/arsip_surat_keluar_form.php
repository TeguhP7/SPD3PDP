<?php
$this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') {
?>
	<div style="color: red;"><?php echo (isset($message)) ? $message : ""; ?></div>

	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header">
						<h4 class="title">Arsip Surat Keluar</h4>
					</div>
					<div class="content">

						<form action="<?php echo $action; ?>" enctype="multipart/form-data" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>No. Surat</label>
										<input type="text" placeholder="No. Surat" value="<?php echo $no_surat; ?>" class="form-control" name="no_surat">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Surat</label>
										<input type="text" placeholder="Nama Surat" value="<?php echo $nama_surat; ?>" class="form-control" name="nama_surat">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Masukkan Gambar/Foto (Max. 5 MB)</label>
										<input type="file" class="form-control" name="input_gambar">
									</div>
								</div>
							</div>
							<input type="hidden" name="id_surat_keluar" value="<?php echo $id_surat_keluar; ?>">
							<button type="submit" name="submit" class="btn btn-primary"><?php echo $button; ?></button>

							<a href="<?php echo site_url('Arsip_surat_keluar') ?>" class="btn btn-default">Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>