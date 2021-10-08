<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LJU</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">
</head>
<body>
    <div class="container py-5">
        <h4 class="text-center">Lembar Reviu LJU - Kode Voucher: <b><?= $voucher ?></b></h4>
        <div class="container my-3">
            <div class="row my-3">
                <div class="col-3 text-center"><b>Nilai Total</b></div>
                <div class="col-3 text-center">Nilai segmen 1</div>
                <div class="col-3 text-center">Nilai segmen 2</div>
                <div class="col-3 text-center">Nilai segmen 3</div>
            </div>
            <div class="row my-3">
                <div class="col-3 text-center"><?= $nilai->segmen_1 + $nilai->segmen_2 + $nilai->segmen_3 ?></div>
                <div class="col-3 text-center"><?= $nilai->segmen_1 ?></div>
                <div class="col-3 text-center"><?= $nilai->segmen_2 ?></div>
                <div class="col-3 text-center"><?= $nilai->segmen_3 ?></div>
            </div>
        </div>
        <div class="container p-4">
            <?php if(empty($record_jawaban)) : ?>
                <div class="container mx-auto text-center">
                    <h5>Tidak ditemukan!</h5>
                    <p>Pastikan kode vouchermu valid.</p>
                    <img class="w-25" src="https://assets.website-files.com/5d5e2ff58f10c53dcffd8683/5db1e0f5e74e346627cb495f_levitate.gif" />
                </div>
            <?php else : ?>
                <?php $i = 1 ?>
                <?php foreach($record_jawaban as $jawaban) : ?>
                    <!-- <p style="<?= $jawaban->jawaban_kode != $jawaban->jawaban_kode_benar ? 'color: red;' : '' ?>"> -->
                    <p>
                        <?= $i . '. ' . $jawaban->soal_teks ?>
                        <br>
                        Jawaban: <b><?= $jawaban->jawaban_teks ?></b>
                        <!-- &nbsp; <b>(Jawaban benar: <?= $jawaban->jawaban_kode_benar ?>)</b> -->
                    </p>
                    <hr>
                    <?php $i++; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>
</body>
</html>