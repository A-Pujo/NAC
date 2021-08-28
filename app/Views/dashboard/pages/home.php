<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <style>
        select, *{
            color: blue;
        }
    </style>

    <div class="text-base-100">
        <h1>
            Selamat Datang 
            <?php 
            if(isInRole('admin')){
                echo 'Admin';
            } else if(isInRole('tim registrasi')){
                echo 'Tim Registrasi';
            } else if(isInRole('tim bendahara')){
                echo 'Tim Bendahara';
            } else {
                
            }
            ?>        
        </h1>
        <?php if(isInRole('umum') and userinfo()->partisipan_aktif == 0) : ?>
            <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="btn btn-info">Update Pendaftaran</a>
        <?php endif; ?>
        <?php if(userinfo()->partisipan_aktif == 1 and userinfo()->pembayaran_aktif == 0) : ?>
            <a href="<?= base_url('/dashboard/pembayaran') ?>" class="btn btn-info">Lengkapi Pembayaranmu</a>
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