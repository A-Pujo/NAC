<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
    <div class="grid grid-cols-12 gap-x-32">
        <!--  -->
        <h2 class="col-span-12 text-36 font-black text-base-100">Informasi</h2>
        <div class="col-span-12 lg:col-span-6 rounded-md p-32 bg-primary-40 mt-16">
            <h3 class="text-24 font-extrabold text-neutral-100">Tentang Dashboard</h3>
            <p class="text-16 text-neutral-100">
                Halaman ini adalah halaman utama/pusat bagi yang sudah daftar atau bergabung (sign up) di website kami. Anda sebagai calon peserta bisa mendaftar sebagai peserta lomba di website ini, verifikasi pendaftaran dan pembayaran dapat dilakukan di website ini. Segala informasi teknis maupun non teknis bisa dilihat di panduan.
            </p>    
        </div>
        <div class="col-span-12 lg:col-span-6 rounded-md p-32 border border-primary-100 mt-16">
            <h3 class="text-24 font-extrabold text-base-100">Mengenai Teknis</h3>
            <p class="text-16 text-base-100">
                Halaman ini adalah halaman utama/pusat bagi yang sudah daftar atau bergabung (sign up) di website kami. Anda sebagai calon peserta bisa mendaftar sebagai peserta lomba di website ini, verifikasi pendaftaran dan pembayaran dapat dilakukan di website ini. Segala informasi teknis maupun non teknis bisa dilihat di panduan.
            </p> 
            <a href="btn btn-primary btn-sm">Ke Panduan</a>   
        </div>
        <div></div>
    </div>







    <div class="text-base-100">
        <h1>
            <?php 
            if(isInRole('admin')){
                echo 'Selamat datang Admin';
            } else if(isInRole('tim registrasi')){
                echo 'Selamat datang Tim Registrasi';
            } else if(isInRole('tim bendahara')){
                echo 'Selamat dartang Tim Bendahara';
            }
            ?>        
        </h1>

        <!-- Button Pendaftaran -->
        <?php if(isInRole('umum') and userinfo()->nama_tim == '') : ?>
            <a href="<?= base_url('/dashboard/pendaftaran-index') ?>" class="btn btn-primary">Daftar !</a>
        <?php endif; ?>
        <!-- Button Update Pendaftaran  -->
        <?php if(isInRole('umum') and userinfo()->nama_tim != '' and userinfo()->partisipan_aktif == 0) : ?>
            <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="btn btn-primary">Update Pendaftaran</a>
        <?php endif; ?>

        <!-- Button Pembayaran  -->
        <?php if(userinfo()->partisipan_aktif == 1 and userinfo()->pembayaran_aktif == 0 and userinfo()->nama_bank == '')  : ?>
            <a href="<?= base_url('/dashboard/pembayaran') ?>" class="btn btn-primary">Pembayaran</a>
        <?php endif; ?>
        <!-- Button Pembayaran  -->
        <?php if(userinfo()->partisipan_aktif == 1 and userinfo()->pembayaran_aktif == 0 and userinfo()->nama_bank != '') : ?>
            <a href="<?= base_url('/dashboard/pembayaran') ?>" class="btn btn-primary">Update Pembayaran</a>
        <?php endif; ?>

<?= $this->endSection() ?>