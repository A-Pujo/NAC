<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php
    $pages = [
        'default' => 'Pilih Halaman',
        // 'daful' => 'Daful SMA',
        // 'verif-absen-1-1' => 'Verifikasi Absen SMA TM Semifinal',
        // 'verif-absen-1-2' => 'Verifikasi Absen SMA Opening Ceremony',
        // 'verif-absen-1-3' => 'Verifikasi Absen SMA Webinar #1 ',
        // 'verif-absen-1-4' => 'Verifikasi Absen SMA FGD Essay',
        // 'verif-absen-1-5' => 'Verifikasi Absen SMA Fun Games ',
        // 'verif-absen-1-6' => 'Verifikasi Absen SMA Webinar #2 ',
        // 'verif-absen-2-7' => 'Verifikasi Absen SMA Webinar #3 ',
        // 'verif-absen-2-8' => 'Verifikasi Absen SMA TM Final ',
        // 'verif-absen-2-9' => 'Verifikasi Absen SMA Final Round',
        // 'verif-absen-2-10' => 'Verifikasi Absen SMA Closing Ceremony ',
        'verif-absen-1-1' => 'Verifikasi_1 Absen SMA TM Semifinal',
        'verif-absen-1-2' => 'Verifikasi_2 Absen SMA Opening Ceremony',
        'verif-absen-1-3' => 'Verifikasi_3 Absen SMA Webinar #1 ',
        'verif-absen-1-4' => 'Verifikasi_4 Absen SMA Fast and Furious',
        'verif-absen-1-5' => 'Verifikasi_5 Absen SMA Fun Games ',
        'verif-absen-1-6' => 'Verifikasi_6 Absen SMA Breakdown the Case ',
        'verif-absen-1-6' => 'Verifikasi_6 Absen SMA Breakdown the Case ',
        'verif-absen-1-7' => 'Verifikasi_7 Absen SMA Webinar #2 ',
        'verif-absen-2-8' => 'Verifikasi_8 Absen SMA Webinar #3 ',
        'verif-absen-2-9' => 'Verifikasi_9 Absen SMA TM Final ',
        'verif-absen-2-10' => 'Verifikasi_10 Absen SMA Final Round',
        'verif-absen-2-11' => 'Verifikasi_11 Absen SMA Closing Ceremony ',
    ];
    $pages_key = array_keys($pages);
?>

    <div class="p-32 grid grid-cols-12 gap-24 text-base-100">
      <div class="col-span-12">
        <div class="form-select" x-data="{menu : '<?= $pages[$_GET['page'] ?? 'default'] ?>', dropdown: false}">
            <label>Pilih Data</label>
            <div
                @click="dropdown = !dropdown"
                >
                <span x-text="menu"></span>
                <i class="">
                    <svg
                    class="transition transform h-18"
                    :class="{'rotate-0': !dropdown,'rotate-180': dropdown}"
                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                </i>
            </div>
            <div x-show="dropdown" @click.outside="dropdown = false">
                <ul>
                    <?php $i = 0; foreach($pages as $page) : $i++?>
                        <li><a href="<?= base_url('dashboard/regis-sma?page='.$pages_key[$i - 1]) ?>"><?= $page ?></a></li>
                    <?php endforeach ?>
                </ul>
            </div>
        </div>
      </div>
      <div class="col-span-12">
        <?= $this->include('component/pesan') ?>
      </div>
      <div class="col-span-12">
          <?php 
                if(($_GET['page'] ?? false) && str_contains($_GET['page'], 'absen')){
                    echo $this->include('dashboard/pages/regis/sma/verif-absen');
                } elseif(($_GET['page'] ?? false)) {
                    echo $this->include('dashboard/pages/regis/sma/'.$_GET['page']);
                }
            ?>
      </div>
    </div>
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>