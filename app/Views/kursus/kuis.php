<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= form_open('kursus/submit-jawaban/'.$kuis, ['method' => 'post']) ?>
        <?php foreach($soal as $s) : ?>
            <label><?= $s->soal_teks ?></label>
            <input type="hidden" name="soal[<?= $s->soal_id ?>]" value="<?= $s->soal_id ?>" /> <br>
            <?php foreach($pilihan as $p) : ?>
                <?php if($p->soal_id == $s->soal_id) : ?>
                    <input type="radio" name="jawaban[<?= $s->soal_id ?>]" value="<?= $p->jawaban_id ?>" /> <label><?= $p->jawaban_teks ?></label> <br>
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endforeach; ?>
        <input type="submit" value="submit">
    </form>
</body>
</html>