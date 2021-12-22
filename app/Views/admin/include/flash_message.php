<?php
if (session()->getFlashdata('success')) { ?>
    <div class="alert bg-green alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <?=session()->getFlashdata('success')?>
    </div>
<?php }
if (session()->getFlashdata('error')) { ?>
<div class="alert bg-red alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <?=session()->getFlashdata('error')?>
</div>
<?php }
if (session()->getFlashdata('denied')) { ?>
<div class="alert alert-warning alert-dismissible" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
    <?=session()->getFlashdata('denied')?>
</div>
<?php }
?>