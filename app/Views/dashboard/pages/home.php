<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
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
            <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="btn btn-primary">Daftar !</a>
        <?php endif; ?>
        <!-- Button Update Pendaftaran  -->
        <?php if(isInRole('umum') and userinfo()->nama_tim != '' and userinfo()->partisipan_aktif == 0) : ?>
            <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="btn btn-primary">Update Pendaftaran</a>
        <?php endif; ?>

        <!-- Button Pembayaran  -->
        <?php if(userinfo()->partisipan_aktif == 1 and userinfo()->pembayaran_aktif == 0) : ?>
            <a href="<?= base_url('/dashboard/pembayaran') ?>" class="btn btn-primary">Pembayaran</a>
        <?php endif; ?>















        <div>
            <?php if(isInRole('peserta lomba')) : ?>
            <P><b>Peserta Lomba (Sudah bayar)</b></p>
            <small>Nama Tim</small>
            <p><?= userinfo()->nama_tim ?></p>
            <small>Perguruan Tinggi</small>
            <p><?= userinfo()->pt ?></p>
            <small>Nama Ketua</small>
            <p><?= userinfo()->nama_ketua ?></p>
            <small>Anggota 1</small>
            <p><?= userinfo()->nama_1 ?></p>
            <small>Anggota 2</small>
            <p><?= userinfo()->nama_2 ?></p>
            <small>Jenis Partisipasi</small>
            <p><?= userinfo()->partisipan_jenis ?></p>
            <small>Whatsapp</small>
            <p><?= userinfo()->wa ?></p>
            <small>Surat Pernyataan</small>
            <p><a href="<?= base_url('/uploads/partisipan/surat-pernyataan/'.userinfo()->surat_pernyataan) ?>" target="_blank" style="color: red;">surat pernyataan</a></p>
            <small>Bukti KTM</small>
            <p>
            <?php foreach(explode('|', userinfo()->ktm) as $ktm) : ?>
                <img src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
            <?php endforeach; ?>
            </p>
            <small>Bukti Twibbon</small>
            <p>
            <?php foreach(explode('|', userinfo()->twibbon) as $twibbon) : ?>
                <img src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
            <?php endforeach; ?>
            </p>
            <?php endif; ?>
        </div>
    </div>
<?= $this->endSection() ?>