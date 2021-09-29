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
    <?php if(sekarang()>tanggal('start_course') && sekarang() < tanggal('close_course')) : ?>
    <div class="card col-span-12 bg-primary-300 p-24 ">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/ACmbZe0j0sk" title="YouTube video player" allowfullscreen></iframe>
    </div>  
    <?php endif?>
    <div class="card col-span-12 bg-primary-300 p-24 ">
        <?= user_kursus()->nama_peserta .' - '. user_kursus()->nama_sekolah ?>
    </div>
    <div class="card col-span-12 bg-primary-300 p-24 flex flex-row items-center space-x-8">
        <?php if(sekarang() < tanggal('start_course')) : ?>
            <span>Masa pengerjaan Course akan dimulai dalam </span> 
        <?php elseif(sekarang() < tanggal('finish_course')) : ?>
            <span>Masa pengerjaan Course akan ditutup dalam </span> 
        <?php else: ?>
            <span>Masa pengerjaan Course telah selesai </span> 
        <?php endif ?>
        <span id="time" class="btn btn-secondary btn-xs"></span>
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
                            <div class="flex items-center">
                                <a href="<?= base_url('kursus/video-attempt/video_kursus_'.$i + 1) ?>" class="btn btn-primary btn-xs">Tonton</a>
                                <?php if($video_kursus[$i]) : ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                <?php endif ?>
                            </div>
                        </td>
                        <td>
                            <?php if($nilai_video[$i]) : ?>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-success" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                            <?php else : ?>
                                <a href="<?= base_url('kursus/video-attempt/video_kursus_'.$i + 1) ?>" class="btn btn-primary btn-xs">Kerjakan</a>
                            <?php endif ?>
                        </td>
                    </tr>
                <?php endfor ?>
            </tbody>
        </table>
        <small class="text-base-100">Sertifikat peserta akan diterbitkan jika Anda telah menonton seluruh video dan mengerjakan seluruh kuis. </small>
        <small class="text-base-100">Sertifikat kelulusan akan diterbitkan jika Anda telah mengerjakan seluruh kuis dengan nilai minimal 75%. </small>
    </div>

</div>
<script>
        // Set target : bulan 0-11
<?php if(sekarang() < tanggal('start_course')) : ?>
    let countDownDate = new Date('<?= tanggal('start_course') ?>').getTime();
<?php else :?>
    let countDownDate = new Date('<?= tanggal('finish_course') ?>').getTime();
<?php endif?>
// Adjustment time
let serverTime = <?= time()*1000 ?>;
let now = new Date().getTime();
let diff = serverTime - now;


// Update the count down every 1 second
let x = setInterval(function() {

  // Get today's date and time
  let now = new Date().getTime() + diff;
  
    
  // Find the distance between now and the count down date
  let distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="time"
  document.getElementById("time").innerHTML = days + "hari " + hours + "jam "
  + minutes + "menit " + seconds + "detik ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "Waktu habis";
  }
}, 1000);
    </script>


<?= $this->endSection() ?>