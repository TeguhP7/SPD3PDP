<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') { ?>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h4 class="title">Data Pegawai</h4>
                    </div>
                    <div class="content">
                        <form action="<?php echo $action; ?>" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Pegawai</label>
                                        <input type="text" name="nama_pegawai" class="form-control" placeholder="Nama" value="<?php echo $nama_pegawai; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Alamat Pegawai</label>
                                        <input type="text" name="alamat_pegawai" class="form-control" placeholder="Alamat" value="<?php echo $alamat_pegawai; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>No.Telp Pegawai</label>
                                        <input type="text" name="notelp_pegawai" class="form-control" placeholder="No Telp" value="<?php echo $notelp_pegawai; ?>">
                                    </div>
                                </div>
                            </div>

                            <input type="hidden" name="id" value="<?php echo $id_pegawai; ?>">
                            <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

                            <a href="<?php echo site_url('Pegawai') ?>" class="btn btn-default">Cancel
                            </a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            <?php $this->load->view('templates/footer');
        } ?>