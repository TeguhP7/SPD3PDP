<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') {
?>
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<div class="header">
						<h4 class="title">Peminjaman</h4>
					</div>
					<div class="content">
						<form action="<?php echo $action; ?>" method="POST">
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Peminjam</label>
										<input type="text" placeholder="Nama peminjam" value="<?php echo $nama_peminjam; ?>" class="form-control" name="nama_peminjam">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Nama Barang</label>
										<select class="form-control select2" name="id_pinjam_barang" id="anggota" style="width: 100%;">
											<?php foreach ($pinjam_barang as $key => $value) { ?>
												<option value="<?php echo $value->id_pinjam_barang; ?>"><?php echo $value->nama_barang; ?></option>
											<?php } ?>
										</select>
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
										<label>Harga Sewa</label>
										<select disabled class="form-control select2" name="id_pinjam_barang" id="anggota" style="width: 100%;">
											<option value="1">Akan terisi otomatis sesuai harga sewa peminjaman barang</option>
											<?php foreach ($pinjam_barang as $key => $value) { ?>
												<option value="<?php echo $value->id_pinjam_barang; ?>"><?php echo $value->harga_sewa; ?></option>
											<?php } ?>
										</select>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tanggal Peminjaman</label>
										<input type="date" placeholder="" value="<?php echo $tanggal_peminjaman; ?>" class="form-control" name="tanggal_peminjaman">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Tanggal Pengembalian</label>
										<input type="date" placeholder="" value="<?php echo $tanggal_pengembalian; ?>" class="form-control" name="tanggal_pengembalian">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-12">
									<div class="form-group">
										<label>Status</label>
										<select class="form-control select2" name="status" style="width: 100%;">
											<option selected>Belum Dikembalikan</option>
											<option value="Sudah Dikembalikan">Sudah Dikembalikan</option>
										</select>
									</div>
								</div>
							</div>

							<input type="hidden" name="id_peminjaman" value="<?php echo $id_peminjaman; ?>">
							<button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

							<a href="<?php echo site_url('Peminjaman') ?>" class="btn btn-default">Cancel</a>
							<div class="clearfix"></div>
						</form>
					</div>
				</div>
			<?php $this->load->view('templates/footer');
		} ?>