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
								echo anchor(site_url("Inventaris/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
							} ?>
						</span>
						<h4 class="title">Data Inventaris</h4>
						<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
						<div>
							<?php if ($this->session->userdata('status') == 'admin') {
								echo anchor(site_url("Laporan/coba_cetak"), '<i class="fa fa-file"></i> Cetak', 'class="btn btn-dark"');
							} ?>
						</div>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Aset</th>
									<th>Jumlah</th>
									<th>Kondisi</th>
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
										<td><?php echo $value->nama_aset; ?></td>
										<td><?php echo $value->jumlah; ?></td>
										<td><?php echo $value->kondisi; ?></td>
										<td><?php echo $value->keterangan_lain; ?></td>
										<td>
											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Inventaris/edit/' . $value->id),
													'<i class="fa fa-pencil"></i>',
													'class="btn btn-warning"'
												);
											} ?>

											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Inventaris/delete/' . $value->id),
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