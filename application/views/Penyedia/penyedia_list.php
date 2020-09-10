<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') {
?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="header">
                            <span style="float: right">
                                <?php echo anchor(site_url("Penyedia/tambah"), '<i class="fa fa-plus"></i> Tambah Data', 'class="btn btn-primary"'); ?>
                            </span>
                            <h4 class="title">Data Penyedia</h4>
                            <p class="category">Kantor Dinas Komunikasi dan Informatika, Kec. Kota Kudus, Kab. Kudus, Jawa Tengah</p>
                        </div>
                        <div class="content table-responsive table-full-width">
                            <table class="table table-hover table-striped">
                                <thead>
                                    <!-- <th>ID Penyedia</th> -->
                                    <th>No.</th>
                                    <th>Nama Penyedia</th>
                                    <th>Alamat Penyedia</th>
                                    <th>Aksi</th>
                                </thead>
                                <?php
                                $no = $this->uri->segment('3') + 1;
                                ?>
                                <tbody>
                                    <?php foreach ($data as $value) { ?>
                                        <tr>
                                            <td><?php echo $no++; ?></td>
                                            <td><?php echo $value->nama_penyedia; ?></td>
                                            <td><?php echo $value->alamat_penyedia; ?></td>
                                            <td>
                                                <?php echo anchor(
                                                    site_url('Penyedia/edit/' . $value->id_penyedia),
                                                    '<i class="fa fa-pencil"></i>',
                                                    'class="btn btn-warning"'
                                                ); ?>
                                                <?php echo anchor(
                                                    site_url('Penyedia/delete/' . $value->id_penyedia),
                                                    '<i class="fa fa-trash"></i>',
                                                    'class="btn btn-danger"'
                                                ); ?>
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