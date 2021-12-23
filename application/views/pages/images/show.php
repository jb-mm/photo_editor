<div class="container py-3">
    <div class="row">
        <div class="col-md-8">
            <div class="row mb-2">
                <div class="col-9 col-md-3">
                    <input type="text" value="<?= $image->name_id; ?>" class="form-control" id="copyName" readonly>
                </div>
                <div class="col-2 col-md-1">
                    <button class="btn btn-secondary" type="button" onClick="copyTo(this.getAttribute('data-name'))" data-name="copyName">copy</button>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-9 col-md-3">
                    <input type="text" value="<?= $image->key_id; ?>" class="form-control" id="copyKey" readonly>
                </div>
                <div class="col-2 col-md-1">
                    <button class="btn btn-secondary" type="button" onClick="copyTo(this.getAttribute('data-name'))" data-name="copyKey">copy</button>
                </div>
            </div>
            <div class="row mb-2">
                <div class="col-9 col-md-10">
                    <input type="text" value="<?= base_url()."images/$image->uuid"; ?>" id="copyLink" class="form-control" readonly>
                </div>
                <div class="col-2 col-md-1">
                    <button class="btn btn-secondary" type="button" onClick="copyTo(this.getAttribute('data-name'))" data-name="copyLink">copy</button>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <img src="<?= "assets/qr/$image->qr_code"; ?>" alt="QR code" class="img-fluid">
            <a href="<?= "assets/qr/$image->qr_code"; ?>" class="btn btn-outline-success btn-sm" download>Download QR</a>
            
        </div>
    </div>
    <img src="<?= "assets/images/$image->file_name"; ?>" alt="<?= $image->orig_name; ?>" class="img-fluid mt-2">
</div>