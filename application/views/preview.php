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
            <div class="col-md-6">
                <dl class="row text-start">
                    <dt class="col-2 text-end">
                        <img src="assets/favicon/pe-2.png" alt="Image" width="40">
                    </dt>
                    <dd class="col-10">
                        <h5>Instant Verification</h5>
                        <p>Now we provide instant verification service for all-in-one certificate information. Your verification result will be appeared below on the page. You can refer this page for your requesting company or insitiution. <span class="text-danger">We inform that we are not going to send verification reuslt to your email instantly and if you need email verification result, you can use COC/COP verification scheme or contact ..</span> <span class="text-primary">myatdesign.com</span></p>
                    </dd>
                </dl>
                <dl class="row text-start">
                    <dt class="col-2 text-end">
                        <img src="assets/favicon/pe-1.png" alt="Image" width="40">
                    </dt>
                    <dd class="col-10">
                        <h5>Verification through QR code for Authenticity</h5>
                        <p>You can get verification result of particular seafarer by scanning QR code shown in profile page of All-In-One certificate booklet.</p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <form action="<?= "images/$uuid"; ?>" method="GET">
                    <div class="form-group mb-2">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" value="<?= $name_id; ?>" class="form-control" placeholder="Your Name .." required>
                    </div>
                    <div class="form-group mb-2">
                        <label for="passcode">Passcode</label>
                        <input type="text" name="passcode" id="passcode" value="<?= $key_id; ?>" class="form-control" placeholder="Your Passcode .." required>
                    </div>
                    <div class="row justify-content-center">
                        <button type="submit" class="col-4 btn btn-success">Enter</button>
                    </div>
                </form>
            </div>
        </div>
    <?php endif; ?>
</div>