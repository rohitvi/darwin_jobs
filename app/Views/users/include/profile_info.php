<?php if (session('profile_completed') == 0) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Please Complete Your Profile!</strong> Click <a href="<?= base_url('home/profile'); ?>">here</a> to update.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<?php if (session('is_verify') == 0) : ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Verify Email!</strong> Please Check Your Email.
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>