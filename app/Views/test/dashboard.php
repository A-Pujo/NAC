<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <div>
        <div>
            Pendaftaran awal:
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
                <form action="<?= base_url('/dashboard/update-pendaftaran') ?>" method="post" enctype="multipart/form-data">
                    <div>
                        <label>Perguruan Tinggi</label>
                        <input type="text" name="pt" value="<?= userinfo()->pt ?>" />
                        <?php if(initValidation()->hasError('pt')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('pt'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Nama Tim</label>
                        <input type="text" name="nama_tim" value="<?= userinfo()->nama_tim ?>" />
                        <?php if(initValidation()->hasError('nama_tim')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_tim'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Nama Ketua</label>
                        <input type="text" name="nama_ketua" value="<?= userinfo()->nama_ketua ?>" />
                        <?php if(initValidation()->hasError('nama_ketua')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_ketua'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Nama Anggota 1</label>
                        <input type="text" name="nama_1" value="<?= userinfo()->nama_1 ?>" />
                        <?php if(initValidation()->hasError('nama_1')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_1'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Nama Anggota 2</label>
                        <input type="text" name="nama_2" value="<?= userinfo()->nama_2 ?>" />
                        <?php if(initValidation()->hasError('nama_2')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_2'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Jenis Partisipsi</label>
                        <select name="partisipan_jenis">
                            <option value="">Pilih..</option>
                            <option value="individu" <?= userinfo()->partisipan_jenis == 'individu' ? 'selected' : '' ?> >individu</option>
                            <option value="tim" <?= userinfo()->partisipan_jenis == 'tim' ? 'selected' : '' ?> >Tim</option>
                        </select>
                        <?php if(initValidation()->hasError('partisipan_jenis')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('partisipan_jenis'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Whatsapp</label>
                        <input type="text" name="wa" value="<?= userinfo()->wa ?>" />
                        <?php if(initValidation()->hasError('wa')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('wa'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Kartu Tanda Mahasiswa</label>
                        <input type="file" name="ktm[]" multiple>
                        <?php if(initValidation()->hasError('ktm')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('ktm'); ?></small>
                        <?php endif; ?>
                    </div>
                    <div>
                        <label>Bukti Twibbon</label>
                        <input type="file" name="twibbon[]" multiple>
                        <?php if(initValidation()->hasError('twibbon')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('twibbon'); ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit">submit</button>
                </form>
            <?php endif; ?>
        </div>
        Status Pembayaran:
        <div>
            <?php if(userinfo()->pembayaran_aktif == 0) : ?>
                <b>Belum bayar</b>
                <form action="<?= base_url('/dashboard/update-pembayaran') ?>" method="post" enctype="multipart/form-data">
                    Isi bukti pembayaran
                    <div>
                        <label>Nama Bank</label>
                        <input type="text" name="nama_bank" value="<?= userinfo()->nama_bank ?>" />
                        <?php if(initValidation()->hasError('nama_bank')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_bank'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>Nama Nasabah</label>
                        <input type="text" name="nama_nasabah" value="<?= userinfo()->nama_nasabah ?>" />
                        <?php if(initValidation()->hasError('nama_nasabah')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nama_nasabah'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>Nomor Rekening</label>
                        <input type="text" name="nomor_rekening" value="<?= userinfo()->nomor_rekening ?>" />
                        <?php if(initValidation()->hasError('nomor_rekening')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('nomor_rekening'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>Jumlah Transfer</label>
                        <input type="number" name="jumlah_transfer" value="<?= userinfo()->jumlah_transfer ?>" />
                        <?php if(initValidation()->hasError('jumlah_transfer')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('jumlah_transfer'); ?></small>
                        <?php endif; ?>
                    </div>

                    <div>
                        <label>Bukti Transfer</label>
                        <input type="file" name="bukti_transfer" />
                        <?php if(initValidation()->hasError('bukti_transfer')) : ?>
                            <small style="color: red;"><?= initValidation()->getError('bukti_transfer'); ?></small>
                        <?php endif; ?>
                    </div>
                    <button type="submit">submit</button>
                </form>
            <?php else :?>
                <b>Udah bayar</b>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>