<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Nama: <?= $peserta->nama_peserta ?></p>
    <p>Sekolah: <?= $peserta->nama_sekolah ?></p>
    <p><img src="<?= base_url('uploads/kursus/kartu-pelajar/'.$peserta->kartu_pelajar) ?>" alt="aa"></p>
    <p>
        <?php if($peserta->verifikasi_peserta == 1) : ?>
            <a href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/0') ?>">Cabut</a>
        <?php else : ?>
            <a href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/1') ?>">Aktivasi</a>
        <?php endif; ?>
    </p>
</body>
</html>