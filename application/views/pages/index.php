<div class="container py-3">
    <!-- upload error msg -->
    <?php if($this->session->flashdata('err_msg')): ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('err_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <!-- upload succes msg -->
    <?php if($this->session->flashdata('ok_msg')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <div class="row">
            <div class="col-4 col-md-2">name:</div>
            <div class="col-8 col-md-10"><?= $this->session->flashdata('ok_msg')['name_id']; ?></div>
        </div>
        <div class="row">
            <div class="col-4 col-md-2">key:</div>
            <div class="col-8 col-md-10"><?= $this->session->flashdata('ok_msg')['key_id']; ?></div>
        </div>
        <div class="row">
            <div class="col-4 col-md-2">Image link:</div>
            <div class="col-8 col-md-10"><?= base_url()."images/".$this->session->flashdata('ok_msg')['uuid']; ?></div>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>
    
    <!-- delete msg -->
    <?php if($this->session->flashdata('del_msg')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= $this->session->flashdata('del_msg'); ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php endif; ?>

    <div class="card mb-3">
        <div class="card-header py-3 py-md-4">
            <?= form_open_multipart('upload'); ?>
            <div class="row">
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <input type="text" name='name' class="form-control" placeholder="Name ..">
                        </div>
                        <div class="col-12 col-md-4 mt-3 mt-md-0">
                            <input type="text" name='password' class="form-control" placeholder="Passcode ..">
                        </div>
                        <div class="col-12 col-md-4 mt-3 mt-md-0">
                            <input type="file" name="image" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mt-3 mt-md-0 text-md-end">
                    <button type="reset" class="btn btn-secondary btn-sm btn-rounded">Clear</button>
                    <button type="submit" class="btn btn-outline-success btn-sm btn-rounded">Upload</button>
                </div>
            </div>
            <?= form_close(); ?>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Image Name</th>
                    <th width="15%" class="text-end">Size (KB)</th>
                    <th width="15%" class="text-end">Dimension (Pixels)</th>
                    <th width="10%" class="text-center">Created Date</th>
                    <th width="15%" class="text-center">Options</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($images) && count($images) > 0): ?>
                    <?php foreach ($images as $image): ?>
                <tr>
                    <td><?= $image->orig_name; ?></td>
                    <td class="text-end"><?= number_format($image->image_size); ?></td>
                    <td class="text-end"><?= number_format($image->image_width)." x".number_format($image->image_height); ?></td>
                    <td class="text-center"><?= date('j-n-Y', strtotime($image->created_at)); ?></td>
                    <td class="text-center">
                        <a href="<?= "image_detail/$image->uuid" ?>" title="View Image" class="btn btn-info btn-sm btn-rounded mr-2" target="_blank">View</a>
                        <a href="<?= "upload/$image->uuid"; ?>" title="Edit Image" class="btn btn-warning btn-sm btn-rounded mr-2">Edit</a>
                        <a href="<?= "upload_remove/$image->uuid"; ?>" title="Delete Image" class="btn btn-danger btn-sm btn-rounded" onClick="return confirm('Are you sure to delete?')">Delete</a>
                    </td>
                </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="5"><?= $this->mmodel->image_sum(); ?></th>
                </tr>
            </tfoot>
        </table>
        
        <?= $pagination; ?>
    </div>
</div>