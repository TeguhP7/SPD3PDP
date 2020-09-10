<?php $this->load->view('templates/header');
if ($this->session->userdata('status') == 'admin') { ?>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="header">
                        <h4 class="title">Pembelian</h4>
                    </div>
                    <div class="content">
                        <form action="<?php echo $action; ?>" method="POST">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Nama Barang</label>
                                        <select class="form-control select2" name="id_barang" id="anggota" style="width: 100%;">
                                            <?php foreach ($barang as $key => $value) { ?>
                                                <option value="<?php echo $value->id_barang; ?>"><?php echo $value->nama_barang; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Nama Pegawai</label>
                                                <select class="form-control select2" name="id_pegawai" id="anggota" style="width: 100%;">
                                                    <?php foreach ($pegawai as $key => $value) { ?>
                                                        <option value="<?php echo $value->id_pegawai; ?>"><?php echo $value->nama_pegawai; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Tanggal</label>
                                                <input type="date" name="tanggal" class="form-control" placeholder="Tanggal" value="<?php echo $tanggal; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Harga Satuan</label>
                                                <input type="text" name="harga_satuan" class="form-control" placeholder="Harga Satuan" value="<?php echo $harga_satuan; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Jumlah Barang</label>
                                                <input type="number" name="jumlah_barang" class="form-control" placeholder="Jumlah Barang" value="<?php echo $jumlah_barang; ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Total Belanja</label>
                                                <input type="text" name="total_belanja" class="form-control" placeholder="Total" value="<?php echo $total_belanja; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id_pembelian; ?>">
                            <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

                            <a href="<?php echo site_url('Pembelian') ?>" class="btn btn-default">Cancel
                            </a>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            <?php $this->load->view('templates/footer');
        } ?>