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
								echo anchor(site_url("Arsip_surat_keluar/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
							} ?>
						</span>
						<h4 class="title">Arsip Surat Keluar</h4>
						<p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
					</div>
					<div class="content table-responsive table-full-width">
						<table class="table table-hover table-striped">
							<thead>
								<tr>
									<th>No.</th>
									<th>No. Surat</th>
									<th>Nama Surat</th>
									<th>Gambar</th>
									<th>Ukuran</th>
									<th>File</th>
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
										<td><?php echo $value->no_surat; ?></td>
										<td><?php echo $value->nama_surat; ?></td>
										<td><?php echo "<img src='" . base_url("assets/images/arsip_surat_keluar/" . $value->nama_file) . "' width='100' height='100'>"; ?></td>
										<td><?php echo $value->ukuran; ?></td>
										<td><?php echo anchor(site_url('Arsip_surat_keluar/download/' . $value->id_surat_keluar), '<i class="fa fa-download"></i>', 'class="btn btn-primary"') ?></td>
										<td>
											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Arsip_surat_keluar/edit/' . $value->id_surat_keluar),
													'<i class="fa fa-pencil"></i>',
													'class="btn btn-warning"'
												);
											} ?>

											<?php if ($this->session->userdata('status') == 'admin') {
												echo anchor(
													site_url('Arsip_surat_keluar/delete/' . $value->id_surat_keluar),
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