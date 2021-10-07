<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php 

$data_user = user_kursus();
$judul = [
    'Garis Besar Akuntansi dan Jenis-jenis Akuntansi',
    'Persamaan Dasar Akuntansi',
    'Saldo Normal, Transaksi, dan Jurnal Umum Bag. 1',
    'Transaksi dan Jurnal Umum Bag. 2',
    'Jurnal Penyesuaian',
    'Laporan Keuangan',
    'Pengenalan akuntansi Perusahaan Dagang'
];
$nilai_video = [
    $data_user->nilai_video_1,
    $data_user->nilai_video_2,
    $data_user->nilai_video_3,
    $data_user->nilai_video_4,
    $data_user->nilai_video_5,
    $data_user->nilai_video_6,
    $data_user->nilai_video_7,
];

?>
<div class="p-32 ">
    <div class="card bg-accent p-8 text-base-100">
    <span><b><?= $index ?></b> <?= $judul[$index-1] ?> </span>
    </div>
    <div class="card bg-neutral-100 w-min p-32 mt-24">
        <div class="card">
            <iframe src="<?= $video ?>" frameborder="0" width="400px" height="300px" allowfullscreen></iframe>
        </div>
    </div>
    <?php if($nilai_video[$index-1] == 0) : ?>
    <div>
        <a class="btn btn-primary mt-24" target="_blank" href="<?= base_url('kursus/kuis/video-'.$index) ?>">Kerjakan Kuis</a>
    </div>
    <?php endif ?>
</div>
<?= $this->endSection() ?>  