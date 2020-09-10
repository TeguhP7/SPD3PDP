<?php $this->load->view('templates/header'); ?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="header">
                    <h4 class="title">Data Pengguna</h4>
                </div>
                <div class="content">
                    <form action="<?php echo $action; ?>" method="POST">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="User Name" value="<?php echo $username; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="text" name="password" class="form-control" placeholder="Password" value="<?php echo $password; ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Status</label>
                                                <input type="text" name="status" class="form-control" placeholder="Status" value="<?php echo $status; ?>">
                                            </div>

                                            <input type="hidden" name="id" value="<?php echo $username; ?>">
                                            <button type="submit" class="btn btn-primary"><?php echo $button; ?></button>

                                            <a href="<?php echo site_url('User') ?>" class="btn btn-default">Cancel
                                            </a>
                                            <div class="clearfix"></div>
                    </form>
                </div>
            </div>
            <?php $this->load->view('templates/footer'); ?>