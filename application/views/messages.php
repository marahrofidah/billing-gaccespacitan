<?php if ($this->session->has_userdata('success')) { ?>
    <div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> <?= $this->session->flashdata('success'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('success-payment')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            html: '<?= $this->session->flashdata('success-payment'); ?>',
            showConfirmButton: true,
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('success-sendsms')) : ?>
    <script>
        Swal.fire({
            icon: 'success',
            html: '<?= $this->session->flashdata('success-sendsms'); ?>',
            showConfirmButton: true,
        })
    </script>
<?php endif; ?>
<?php if ($this->session->flashdata('error-sendsms')) : ?>
    <script>
        Swal.fire({
            icon: 'error',
            html: '<?= $this->session->flashdata('error-sendsms'); ?>',
            showConfirmButton: true,
        })
    </script>
<?php endif; ?>
<?php if ($this->session->has_userdata('error')) { ?>
    <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-ban"></i> <?= $this->session->flashdata('error'); ?>
    </div>
<?php } ?>
<?php if ($this->session->flashdata('success-sweet')) : ?>
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="icon fa fa-check"></i> <?= html_escape($this->session->flashdata('success-sweet')); ?>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('error-sweet')) : ?>
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <i class="icon fa fa-ban"></i> <?= html_escape($this->session->flashdata('error-sweet')); ?>
    </div>
<?php endif; ?>