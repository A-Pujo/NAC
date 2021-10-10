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
    $video_kursus = [
        $data_user->video_kursus_1,
        $data_user->video_kursus_2,
        $data_user->video_kursus_3,
        $data_user->video_kursus_4,
        $data_user->video_kursus_5,
        $data_user->video_kursus_6,
        $data_user->video_kursus_7,
    ]

?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">

    <?php if(session()->getFlashData('alert')) :?>
        <div class=" col-span-12">
            <div class="alert alert-error">
                <div class="flex-1 items-center space-x-5">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                </svg>
                    <label><?= session()->getFlashData('alert')?></label>
                </div>
            </div>
        </div>
    <?php endif ?>
    <div class="col-span-12">
        <?= $this->include('component/pesan') ?>
    </div>
    <div class="card col-span-12 bg-primary-300 p-24 ">
        <?= user_kursus()->nama_peserta .' - '. user_kursus()->nama_sekolah ?>
    </div>
    <div class="card col-span-12 bg-primary-300 p-24">
        <span>Status peserta :</span>
        <?php if(
            $video_kursus[0] == 1 &&
            $video_kursus[1] == 1 &&
            $video_kursus[2] == 1 &&
            $video_kursus[3] == 1 &&
            $video_kursus[4] == 1 &&
            $video_kursus[5] == 1 &&
            $video_kursus[6] == 1
        ) : ?> 
            <a class="verif-sukses">Lulus</a>
            <!-- <a class="verif-sukses" target="_blank" href="<?= "http://localhost/cetak-pdf-nac/index.php?id=$data_user->id_peserta&pass=$data_user->wa" ?>">Lulus - Klik untuk lihat sertifikat Anda</a> -->
        <?php else :  ?>
            <span class="verif-gagal">Tidak Lulus</span>
        <?php endif ?>
        <span>Status kelulusan :</span>
        <?php if(
            $nilai_video[0] >= 14 &&
            $nilai_video[1] >= 14 &&
            $nilai_video[2] >= 14 &&
            $nilai_video[3] >= 14 &&
            $nilai_video[4] >= 14 &&
            $nilai_video[5] >= 14 &&
            $nilai_video[6] >= 14
        ) : ?> 
            <span class="verif-sukses">Lulus</span>
        <?php else :  ?>
            <span class="verif-gagal">Tidak Lulus</span>
        <?php endif ?>
    </div>

    <div class="card col-span-12 p-24">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Materi</th>
                    <th>Akses Video</th>
                    <th>Nilai Kuis</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i= 0 ; $i< count($judul); $i++ ) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $judul[$i] ?></td>
                        <td>
                            <div class="flex items-center">
                                <!-- <a href="<?= base_url('kursus/video-attempt/video_kursus_'.$i + 1) ?>" class="btn btn-primary btn-xs">Tonton</a> -->
                                <?php if($video_kursus[$i]) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <?php else :?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-error" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                                    </svg>
                                <?php endif ?>
                            </div>
                        </td>
                        <td>
                            <?php // if($nilai_video[$i]) : ?>
                                <!-- <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg> -->
                            <?php // else : ?>
                                <!-- <a href="<?= base_url('kursus/video-attempt/video_kursus_'.$i + 1) ?>" class="btn btn-primary btn-xs">Kerjakan</a> -->
                            <?php // endif ?>
                            <?php if(sekarang() < tanggal('pengumuman_course')) : ?>
                                Nilai belum tersedia
                            <?php else : ?>
                                <span class="<?= $nilai_video[$i] >= 14 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $nilai_video[$i] ?></span>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endfor ?>
            </tbody>
        </table>
        <small class="text-base-100">Sertifikat peserta akan diterbitkan jika Anda telah menonton seluruh video dan mengerjakan seluruh kuis. </small>
        <small class="text-base-100">Sertifikat kelulusan akan diterbitkan jika Anda telah mengerjakan seluruh kuis dengan nilai minimal 70% dari total maksimal nilai 20. </small>
        <small class="text-base-100">Sertifikat dapat Anda unduh di halaman ini. Jadwal pengunduhan sertifikat akan disampaikan kemudian. </small>
    </div>

</div>
<?= $this->endSection() ?>