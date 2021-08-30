<div class="flex flex-col space-y-2 p-32 items-stretch space-y-16">
    <div class="text-base-100 text-7xl font-black">N</div>

    <!-- Home  -->
    <a href="<?= base_url('/dashboard') ?>" class="<?= $halaman == 'beranda' ? 'sidebar-menu-aktif' : 'sidebar-menu' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
        <span class="sidebar-text">Beranda</span>
    </a>
    <!-- Umum -->
    <?php if(isInRole('umum')) : ?>
        <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="<?= $halaman == 'pendaftaran' ? 'sidebar-menu-aktif' : 'sidebar-menu' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
            <span class="sidebar-text">Pendaftaran</span>
        </a>
        <a href="<?= base_url('/dashboard/pembayaran') ?>" class="<?= $halaman == 'pembayaran' ? 'sidebar-menu-aktif' : 'sidebar-menu' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
            <span class="sidebar-text">Pembayaran</span>
        </a>

    <!-- Admin -->
    <?php elseif(isInRole('admin')) : ?>
        <a href="<?= base_url('/dashboard/admin') ?>" class="<?= $halaman == 'admin' ? 'sidebar-menu-aktif' : 'sidebar-menu' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
            <span class="sidebar-text">Team</span>
        </a>     

    <!-- Tim Registrasi -->
    <?php elseif(isInRole('tim registrasi')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pendaftaran') ?>" class="link">Tim Regis</a>

    <!-- Tim Bendahara -->
    <?php elseif(isInRole('tim bendahara')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pembayaran') ?>" class="link">Tim Bendahara</a>

    <!-- Peserta Lomba -->

    <?php elseif(isInRole('peserta lomba')) : ?>
        <a href="<?= base_url('/lomba/generate-voucher') ?>" class="link">Generate Voucher Lomba</a>
    <?php endif; ?>
    
    <!-- Logout -->
        <a href="<?= base_url('/auth/logout') ?>" class="sidebar-menu">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
            <span class="sidebar-text">Logout</span>
        </a>   
</div>