<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') { ?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header">
						<h4 class="title">Data Barang untuk Peminjaman</h4>
					</div>
					<div class="content">
						<form action="<?php echo $action; ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Barang</label>
										<input type="text" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" class="form-control" name="nama_barang">
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
										<label>Harga Sewa (Per-Barang & Hari)</label>
										<input type="text" placeholder="Isi sesuai harga sewa satu barang per-hari (Contoh : Rp. 10.000,-)" value="<?php echo $harga_sewa; ?>" class="form-control" name="harga_sewa">
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

							<input type="hidden" name="id_pinjam_barang" value="<?php echo $id_pinjam_barang; ?>">
							<button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

							<a href="<?php echo site_url('Pinjam_barang') ?>" class="btn btn-default">Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>