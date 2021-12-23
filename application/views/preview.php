<div class="container py-3 text-center">
    <?php if ($image): ?>
        <img src="<?= "assets/images/$image->file_name"; ?>" class="img-fluid" alt="<?= $image->orig_name; ?>">
        <div class="row justify-content-center mt-3">
            <div class="col-md-4 text-center">
                <a href="<?= "assets/images/$image->file_name"; ?>" class="btn btn-success" download>Download</a>
            </div>
        </div>
    <?php else: ?>
        <?php if($this->session->flashdata('auth_msg')): ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <?= $this->session->flashdata('auth_msg'); ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="<?= "images/$uuid"; ?>" method="GET">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $name_id; ?>" class="form-control" placeholder="Your Name .." required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="key">Passcode</label>
                        <input type="text" name="key" id="key" value="<?= $key_id; ?>" class="form-control" placeholder="Your Passcode .." required>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="col-4 btn btn-success">Enter</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>