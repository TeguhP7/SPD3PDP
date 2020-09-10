<?php $this->load->view('templates/header'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <span style="float: right">
                            <?php if ($this->session->userdata('status') == 'admin') {
                                echo anchor(site_url("Pembelian/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
                            } ?>
                        </span>
                        <h4 class="title">Data Pembelian</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
                        <div>
                            <?php if ($this->session->userdata('status') == 'admin') {
                                echo anchor(site_url("Laporan/pembelian"), '<i class="fa fa-file"></i> Cetak', 'class="btn btn-dark"');
                            } ?>
                        </div>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>No</th>
                                <th>Nama Barang</th>
                                <th>Nama Pegawai</th>
                                <th>Tanggal</th>
                                <th>Harga Satuan</th>
                                <th>Jumlah</th>
                                <th>Total Belanja</th>
                                <?php if ($this->session->userdata('status') == 'admin') { ?>
                                    <th>Aksi</th>
                                <?php } ?>
                            </thead>
                            <?php
                            $no = $this->uri->segment('3') + 1;
                            ?>
                            <tbody>
                                <?php foreach ($data as $value) { ?>
                                    <tr>
                                        <td><?php echo $no++; ?></td>
                                        <td><?php echo $value->nama_barang; ?></td>
                                        <td><?php echo $value->nama_pegawai; ?></td>
                                        <td><?php echo $value->tanggal; ?></td>
                                        <td><?php echo $value->harga_satuan; ?></td>
                                        <td><?php echo $value->jumlah_barang; ?></td>
                                        <td><?php echo $value->total_belanja; ?></td>
                                        <td>
                                            <?php if ($this->session->userdata('status') == 'admin') {
                                                echo anchor(
                                                    site_url('Pembelian/edit/' . $value->id_pembelian),
                                                    '<i class="fa fa-pencil"></i>',
                                                    'class="btn btn-warning"'
                                                );
                                            } ?>

                                            <?php if ($this->session->userdata('status') == 'admin') {
                                                echo anchor(
                                                    site_url('Pembelian/delete/' . $value->id_pembelian),
                                                    '<i class="fa fa-trash"></i>',
                                                    'class="btn btn-danger"'
                                                );
                                            } ?></td>
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


            <?php $this->load->view('templates/footer'); ?>