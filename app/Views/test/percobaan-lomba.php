<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= print_r($partisipan_info) ?>
    <br>
    Lagi lomba <b><?= $daftar_lomba[$partisipan_info->kode_lomba] ?></b>
    <br>

    <?= form_open_multipart(base_url('/lomba/submit-jawaban/'.$partisipan_info->kode_voucher)) ?>

    <?php foreach($daftar_soal as $soal) : ?>

    <p><?= $soal->soal_teks ?> <input type="hidden" name="soal[]" value="<?= $soal->soal_id ?>"></p>

    <?php if($partisipan_info->kode_lomba == 'AuditUniv') : ?>
        <label>Jawaban 1</label> <br>
        <input type="file" name="jawaban_1" /> <br><br>
        <?php if(initValidation()->hasError('jawbaan_1')) : ?>
            <p><i style="color: red;"><?= initValidation()->getError('jawaban_1') ?></i></p>
        <?php endif; ?>
        <label>Jawaban 2</label> <br>
        <input type="file" name="jawaban_2" /> <br><br>
        <?php if(initValidation()->hasError('jawaban_2')) : ?>
            <p><i style="color: red;"><?= initValidation()->getError('jawaban_2') ?></i></p>
        <?php endif; ?>
    <?php else : ?>
        <?php foreach($daftar_pilihan as $pilihan) : ?>
            <?php if($pilihan->soal_id == $soal->soal_id) : ?>
                <input type="radio" name="jawaban[<?=$soal->soal_id?>]" value="<?= $pilihan->jawaban_id ?>">
                <label><?= $pilihan->jawaban_teks ?></label>
            <?php endif; ?>
        <?php endforeach; ?>
    <?php endif; ?>

    <?php endforeach; ?>
    <br><button type="submit">gas</button>
    </form>
</body>
</html>