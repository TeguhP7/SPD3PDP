<?php
$this->load->view('templates/header');
?>
<div class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<div class="card">
					<div class="header">
						<span style="float: right">
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Pinjam_barang/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
							} ?>
						</span>
						<h4 class="title">Data Barang untuk Peminjaman</h4>
						<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
						<div>
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Laporan/pinjam_barang"), '<i class="fa fa-file"></i> Cetak', 'class="btn btn-dark"');
							} ?>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Barang</th>
									<th>Jumlah</th>
									<th>Harga Sewa (Per-Barang & Hari)</th>
									<th>Keterangan Lain</th>
									<?php if ($this->session->userdata('status') == 'admin') { ?>
										<th>Aksi</th>
									<?php } ?>
								</tr>
							</thead>
							<?php
							$no = $this->uri->segment('3') + 1;
							?>
							<tbody>
								<?php foreach ($data as $value) { ?>
									<tr>
										<td><?php echo $no++; ?></td>
										<td><?php echo $value->nama_barang; ?></td>
										<td><?php echo $value->jumlah; ?></td>
										<td><?php echo $value->harga_sewa; ?></td>
										<td><?php echo $value->keterangan_lain; ?></td>
										<td>
											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Pinjam_barang/edit/' . $value->id_pinjam_barang),
													'<i class="fa fa-pencil"></i>',
													'class="btn btn-warning"'
												);
											} ?>

											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Pinjam_barang/delete/' . $value->id_pinjam_barang),
													'<i class="fa fa-trash"></i>',
													'class="btn btn-danger"'
												);
											} ?>
										</td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
						<div class="row">
							<div class="col">
								<!--Tampilkan pagination-->
								<?php echo $pagination; ?>
							</div>
						</div>
					</div>
				</div>
			</div>

			<?php
			$this->load->view('templates/footer');
			?>
			<script type="text/javascript">
				$(document).ready(function() {
					$('#example').DataTable();

				});
			</script>