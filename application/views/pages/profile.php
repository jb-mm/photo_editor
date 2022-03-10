<div class="container py-2">
    <!-- error msg -->
    <?php if($this->session->flashdata('err_msg')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('err_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    <!-- success msg -->
    <?php if($this->session->flashdata('suc_msg')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('suc_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="card shadow">
        <div class="card-body">
            <?= form_open('update_profile'); ?>
                <dl class="row">
                    <dt class="col-md-2 col-lg-2 mb-2">Username</dt>
                    <dd class="col-md-10 col-lg-10"><?= $this->session->userdata('name'); ?></dd>
                    <dt class="col-md-2 col-lg-2">New Password</dt>
                    <dd class="col-md-10 col-lg-10 row">
                        <div class="col-md-4 col-lg-4">
                            <input type="password" name="password" class="form-control" placeholder="New Password .." required>
                        </div>
                    </dd>
                    <dt class="col-md-2 col-lg-2 text-truncate">Confirm Password</dt>
                    <dd class="col-md-10 col-lg-10 row">
                        <div class="col-md-4 col-lg-4">
                            <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password .." required>
                        </div>
                    </dd>
                    <dt class="col-md-2 col-lg-2 text-truncate"></dt>
                    <dd class="col-md-10 col-lg-10">
                        <button type="submit" class="btn btn-success">Change Password</button>
                    </dd>
                </dl>
            <?= form_close(); ?>
        </div>
    </div>
</div>