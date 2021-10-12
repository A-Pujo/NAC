<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link rel="shortcut icon" href="<?= base_url('img/logo.png')?>" type="image/x-icon">
    <title>NAC</title>
</head>
<body style="font-family: 'Raleway', sans-serif;" class="text-base-100">
    <div class="px-16 sm:px-32 md:px-48 lg:px-96 grid grid-cols-12 gap-16 bg-neutral-200 py-80">
        <div class="col-span-12 card bg-accent p-24">
            <span class="text-24 font-bold">Lembar jawaban hasil pengerjaan Preliminary Round tim <?= $partisipan->nama_tim ?></span>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-accent p-24">
            <span class="text-24 font-bold">Total Nilai <?= $nilai->segmen_1 + $nilai->segmen_2 + $nilai->segmen_3 ?></span>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-accent p-24">
            <span class="text-24 font-bold"><?= $voucher ?>qw : <?= $nilai->segmen_1 ?></span>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-accent p-24">
            <span class="text-24 font-bold"><?= $voucher ?>as : <?= $nilai->segmen_2 ?></span>
        </div>
        <div class="col-span-12 md:col-span-6 lg:col-span-3 card bg-accent p-24">
            <span class="text-24 font-bold"><?= $voucher ?>zx : <?= $nilai->segmen_3 ?></span>
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-16">
            <div class="col-span-12 card bg-accent p-16 sticky top-16 z-50">
                <span>Bagian 1 : Hasil pengerjaan voucher: <?= $voucher ?>qw</span>
            </div>

            <?php $i = 1; ?>

            <?php foreach($record_jawaban as $jawaban) : ?>
                <?php if($jawaban->segmen == 1) : ?>
                <div class="col-span-12 card bg-neutral-100 p-16">
                    <p><strong class="text-24"><?= $i++ ?>.</strong> <?= $jawaban->soal_teks ?></p>
                    <p><strong>Jawab :</strong> <?= $jawaban->jawaban_kode == '' ? 'Tidak menjawab' : $jawaban->jawaban_teks ?></p>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-16">
            <div class="col-span-12 card bg-accent p-16 sticky top-16 z-50">
                <span>Bagian 2 : Hasil pengerjaan voucher: <?= $voucher ?>as</span>
            </div>
            <?php foreach($record_jawaban as $jawaban) : ?>
                <?php if($jawaban->segmen == 2) : ?>
                <div class="col-span-12 card bg-neutral-100 p-16">
                    <p><strong class="text-24"><?= $i++ ?>.</strong> <?= $jawaban->soal_teks ?></p>
                    <p><strong>Jawab :</strong> <?= $jawaban->jawaban_kode == '' ? 'Tidak menjawab' : $jawaban->jawaban_teks ?></p>
                </div>
                <?php endif ?>
            <?php endforeach; ?>
        </div>
        <div class="col-span-12 grid grid-cols-12 gap-16">
            <div class="col-span-12 card bg-accent p-16 sticky top-16 z-50">
                <span>Bagian 3 : Hasil pengerjaan voucher: <?= $voucher ?>zx</span>
            </div>
            <?php foreach($record_jawaban as $jawaban) : ?>
                <?php if($jawaban->segmen == 3) : ?>
                <div class="col-span-12 card bg-neutral-100 p-16">
                    <p><strong class="text-24"><?= $i++ ?>.</strong> <?= $jawaban->soal_teks ?></p>
                    <p><strong>Jawab :</strong> <?= $jawaban->jawaban_kode == '' ? 'Tidak menjawab' : $jawaban->jawaban_teks ?></p>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>