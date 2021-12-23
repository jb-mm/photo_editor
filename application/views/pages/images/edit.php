<div class="container py-3">
     <!-- upload error msg -->
     <?php if($this->session->flashdata('err_msg')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('err_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <div class="card shadow">
        <div class="card-body">
            <div class="row">
                <div class="col-md-5">
                    <?= form_open_multipart('upload_update'); ?>
                        <div class="form-group mb-3">
                            <input type="text" name='name' value="<?= $image->name_id; ?>" class="form-control" placeholder="Name ..">
                        </div>
                        <div class="form-group mb-3">
                            <input type="text" name='password' value="<?= $image->key_id; ?>" class="form-control" placeholder="Passcode ..">
                        </div>
                        <div class="form-group mb-3">
                            <input type="file" name="image" class="form-control">
                        </div>
                        <div class="row justify-content-center">
                            <input type="hidden" name="uuid" value="<?= $image->uuid; ?>">
                            <a href="home" class="col-8 col-md-3 btn btn-secondary btn-rounded">Cancel</a>
                            <button type="submit" class="col-8 col-md-3 btn btn-success btn-rounded mt-2 mt-md-0">Update</button>
                        </div>
                    <?= form_close() ?>
                </div>
                <div class="col-md-7">
                    <img src="<?= "assets/images/$image->file_name"; ?>" alt="<?= $image->orig_name; ?>" class="img-fluid mt-5 mt-md-0">
                </div>
            </div>
        </div>
    </div>
</div>