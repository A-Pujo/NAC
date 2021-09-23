<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
    <div class="grid grid-cols-12 gap-x-24 p-32">
        <!--  -->
        <h2 class="col-span-12 text-36 font-black text-base-100">Informasi</h2>
        <div class="col-span-12 lg:col-span-6 rounded-md p-32 bg-primary-40 mt-16">
            <h3 class="text-24 font-extrabold text-neutral-100">Tentang Dashboard</h3>
            <p class="text-16 text-neutral-100">
                Halaman ini adalah halaman utama dari rangkain acara NAC 2021. Segala hal berkaitan dengan aktivitas peserta akan dilakukan melalui halaman dashbord.
            </p>    
        </div>
        <div class="col-span-12 lg:col-span-6 rounded-md p-32 border border-primary-100 mt-16">
            <h3 class="text-24 font-extrabold text-base-100">Mengenai Teknis</h3>
            <p class="text-16 text-base-100">
                Bagi peserta yang ingin melakukan pendaftaran, silakan memilih menu <a class="btn btn-xs btn-primary" href="<?= base_url('dashboard/pendaftaran-index') ?>" >pendaftaran</a>. Segala informasi terkait acara NAC 2021 dapat peserta ketahui pada halaman <a class="btn btn-xs btn-primary" href="<?= base_url('guide') ?>">panduan</a>. 
            </p> 
        </div>
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
    <div>

    <!-- ADMIN ONLY -->
    <?php if(isInRole('admin')) : ?>
        <div class="card bg-primary-100 p-24 m-24">
        <p>Data tanggal</p>
        <?php array_map(function($e){
            echo array_search($e, tanggal('all')) ." - ". $e ."<br>";
        } ,tanggal('all')) ?>
        </div>
    <?php endif ?>

<?= $this->endSection() ?>