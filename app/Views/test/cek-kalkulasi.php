<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Cek Jawaban dan Kalkulasi Nilai <br>
    <?php foreach($jawaban_partisipan as $jawaban) : ?>
        <?php if($jawaban->kode_lomba == 'AccUniv' or $jawaban->kode_lomba == 'AccSMA') : ?>
            <p style="<?= $jawaban->jawaban_kode != $jawaban->jawaban_kode_benar ? 'color: red;' : '' ?>">
                <?= $jawaban->soal_teks ?> <br>
                <?= $jawaban->jawaban_kode ?> . <?= $jawaban->jawaban_teks ?> 
                &nbsp; <b>(Jawaban benar: <?= $jawaban->jawaban_kode_benar ?>)</b>
            </p>
        <?php else: ?>
            <p style="background: aquamarine;">
                <?= $jawaban->soal_teks ?> <br>
                <a href="<?= base_url('/uploads/partisipan/lomba/audit/'.$jawaban->jawaban_teks) ?>" target="_blank">Cek jawaban</a>
            </p>
        <?php endif; ?>
    <?php endforeach; ?>
    <?= form_open(base_url('/admin-lomba/update-kalkulasi/'.$nilai->kode_voucher)) ?>
        <input type="number" value="<?= $nilai->kuantitas_nilai ?>" name="kuantitas_nilai" />
        <button type="submit">update</button>
    </form>
</body>
</html>