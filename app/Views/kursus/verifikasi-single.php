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
    <p><input type="text" name="alasan" /></p>
    <p>
        <?php if($peserta->verifikasi_peserta == 1) : ?>
            <a href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/0') ?>">Cabut</a>
        <?php else : ?>
            <a href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/1') ?>">Aktivasi</a>

            <?php if($peserta->peserta_ditolak == 0) : ?>
                <a href="<?= base_url('kursus/tolak-peserta/' . $peserta->id_user . '/1') ?>" id="uri-tolak">Tolak</a>
            <?php else: ?>
                <a href="<?= base_url('kursus/tolak-peserta/' . $peserta->id_user . '/0') ?>">Cabut Tolak</a>
            <?php endif; ?>
            
        <?php endif; ?>
    </p>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            let href = $('#uri-tolak').attr('href');
           $('input[name=alasan]').keyup(function(){
                if($(this).val() == null){
                    $('#uri-tolak').attr('href', href);
                } else {
                    $('#uri-tolak').attr('href', href + '?alasan_ditolak=' + $(this).val());
                }
           });
        });
    </script>
</body>
</html>