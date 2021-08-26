<h1>INI BAGIAN SIDEBAR</h1>
<!-- LINK -->
<div class="flex flex-col space-y-2 px-3">
        <a href="<?= base_url('/dashboard') ?>" class="link">Home</a>
        <?php if(isInRole('admin')) : ?>
        <a href="<?= base_url('/dashboard/admin') ?>" class="link">Kelola Role</a>
        <?php elseif(isInRole('tim registrasi')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pendaftaran') ?>" class="link">Tim Regis</a>
        <?php elseif(isInRole('tim bendahara')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pembayaran') ?>" class="link">Tim Bendahara</a>
        <?php endif;?>
        <a href="<?= base_url('/auth/logout') ?>" class="link">Logout</a>
</div>