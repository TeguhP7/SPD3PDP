<?php
$this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') { ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <span style="float: right">
                                <?php if ($this->session->userdata('status') == 'admin') {
                                    echo anchor(site_url("Barang/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"');
                                } ?>
                            </span>
                            <h4 class="title">Data Barang</h4>
                            <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <!-- <th>ID Barang</th> -->
                                    <th>No.</th>
                                    <th>Nama Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Penyedia Barang</th>
                                    <th>Jumlah</th>
                                    <th>Aksi</th>
                                </thead>
                                <?php
                                $no = $this->uri->segment('3') + 1;
                                ?>
                                <tbody>
                                    <?php foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $value->nama_barang; ?></td>
                                            <td><?php echo $value->jenis_barang; ?></td>
                                            <td><?php echo $value->nama_penyedia; ?></td>
                                            <td><?php echo $value->jumlah; ?></td>
                                            <td>
                                                <?php if ($this->session->userdata('status') == 'admin') {
                                                    echo anchor(
                                                        site_url('Barang/edit/' . $value->id_barang),
                                                        '<i class="fa fa-pencil"></i>',
                                                        'class="btn btn-warning"'
                                                    );
                                                } ?>
                                                <?php if ($this->session->userdata('status') == 'admin') {
                                                    echo anchor(
                                                        site_url('Barang/delete/' . $value->id_barang),
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


            <?php $this->load->view('templates/footer');
        } ?>