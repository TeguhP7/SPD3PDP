<?php $this->load->view('templates/header'); ?>

<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <span style="float: right">
                            <?php if ($this->session->userdata('status') == 'admin') { ?>
                                <?php echo anchor(site_url("Pegawai/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                            <?php } ?>
                        </span>
                        <h4 class="title">Data Pegawai</h4>
                        <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <!-- <th>ID Pegawai</th> -->
                                <th>No.</th>
                                <th>Nama Pegawai</th>
                                <th>Alamat Pegawai</th>
                                <th>No.Telp Pegawai</th>
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
                                        <td><?php echo $value->nama_pegawai; ?></td>
                                        <td><?php echo $value->alamat_pegawai; ?></td>
                                        <td><?php echo $value->notelp_pegawai; ?></td>
                                        <?php if ($this->session->userdata('status') == 'admin') { ?>
                                            <td><?php echo anchor(
                                                    site_url('Pegawai/edit/' . $value->id_pegawai),
                                                    '<i class="fa fa-pencil"></i>',
                                                    'class="btn btn-warning"'
                                                ); ?>

                                                <?php echo anchor(
                                                    site_url('Pegawai/delete/' . $value->id_pegawai),
                                                    '<i class="fa fa-trash"></i>',
                                                    'class="btn btn-danger"'
                                                ); ?></td>
                                        <?php } ?>
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