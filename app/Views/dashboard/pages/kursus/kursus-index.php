<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
<?php
    $judul = [
        '1. Intro (pa agung + pa kodirin)',
        '2. Akuntansi jasa vs dagang (pa kodirin)',
        '3. Saldo normal ( pa kodirin)',
        '4. Contol jurnal (pa kodirin)',
        '5. Adjustment (pa agung)',
        '7. Lapkeu (pa agung)',
        '8. Akt dagang (pa agung)',
    ];
    $nilai_video = [
        user_kursus()->nilai_video_1,
        user_kursus()->nilai_video_2,
        user_kursus()->nilai_video_3,
        user_kursus()->nilai_video_4,
        user_kursus()->nilai_video_5,
        user_kursus()->nilai_video_6,
        user_kursus()->nilai_video_7,
    ];
    $video_kursus = [
        user_kursus()->video_kursus_1,
        user_kursus()->video_kursus_2,
        user_kursus()->video_kursus_3,
        user_kursus()->video_kursus_4,
        user_kursus()->video_kursus_5,
        user_kursus()->video_kursus_6,
        user_kursus()->video_kursus_7,
    ]

?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">

    <div class="card col-span-12 bg-primary-300 p-24 ">
    <iframe width="560" height="315" src="https://www.youtube.com/embed/yHha7DVndZw" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
    <div class="card col-span-12 bg-primary-300 p-24 ">
        <?= user_kursus()->nama_peserta .' - '. user_kursus()->nama_sekolah ?>
    </div>

    <div class="card col-span-12 p-24">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Materi</th>
                    <th>Akses Video</th>
                    <th>Nilai Course</th>
                </tr>
            </thead>
            <tbody>
                <?php for($i= 0 ; $i< count($judul); $i++ ) : ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= $judul[$i] ?></td>
                        <td>
                            <?php if($video_kursus[$i]) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            <?php else : ?>
                                <a href="<?= base_url('kursus/video-attempt/video_kursus_'.$i) ?>" class="btn btn-primary btn-xs">Tonton</a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if($nilai_video[$i]) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            <?php else : ?>
                                <a href="<?= base_url('') ?>" class="btn btn-primary btn-xs">Kerjakan</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endfor ?>
            </tbody>
        </table>
        <small class="text-base-100">Sertifikat akan diterbitkan jika Anda telah menonton seluruh video dan mengerjakan seluruh kuis dengan nilai minimum XX per materi. </small>
    </div>

</div>


<?= $this->endSection() ?>