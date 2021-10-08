<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>

<?php 
    $user_lomba = db()->table('partisipan_lomba')->where('partisipan_id', userinfo()->partisipan_id)->get()->getRow();

    $kuota_habis_semua = false;

    if($user_lomba->kuota_1 == 0 and $user_lomba->kuota_2 == 0 and $user_lomba->kuota_3 == 0){
        $kuota_habis_semua = true;
    }

?>
    
<div class="grid grid-cols-12 gap-24 p-32 text-base-100">

    <div class="card col-span-12 p-24 bg-neutral-100">
        <table class="tabel-card text-12 lg:text-16">
            <tr>
                <td>Nama Tim</td>
                <td>:</td>
                <td><?= userinfo()->nama_tim ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><?= userinfo()->pt ?></td>
            </tr>
            <tr>
                <td>Nama Ketua Tim</td>
                <td>:</td>
                <td><?= userinfo()->nama_ketua ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 1</td>
                <td>:</td>
                <td><?= userinfo()->nama_1 ?></td>
            </tr>
            <tr>
                <td>Nama Anggota 2</td>
                <td>:</td>
                <td><?= userinfo()->nama_2 ?></td>
            </tr>
            <tr>
                <td>Jenis Lomba</td>
                <td>:</td>
                <td>Accounting for High School</td>
                <!-- <td><?= userinfo()->partisipan_jenis == 'AccSMA' ? 'Accounting for High School' : (userinfo()->partisipan_jenis == 'AccUniv'  ? 'Accounting for University' : 'Call for Paper') ?></td> -->
            </tr>
            <tr>
                <td>Nomor Whatsapp</td>
                <td>:</td>
                <td><?= userinfo()->wa ?></td>
            </tr>
        </table>
    </div>
    <div class="card col-span-12 p-24 bg-neutral-100">
        <?php 
            $data = db()->table('partisipan_lomba')
                        ->join('data_partisipan', 'data_partisipan.partisipan_id=partisipan_lomba.partisipan_id ')
                        ->where('user_id', userinfo()->id)
                        ->get()->getRow();
            $voucher = ! empty($data) ?  $data->kode_voucher : false;
            
            $kode_segmen = ['qw', 'as', 'zx'];
            if($voucher) :
        ?>
            <span>Voucher untuk pengerjaan soal Preliminary Round tim Anda adalah 
                    <?php foreach($kode_segmen as $segmen) : ?>
                    <?= $voucher.$segmen ?>
                    <div 
                        data-tip="Salin voucher"
                        class="inline tooltip tooltip-primary"
                    >
                        <svg 
                            data-clipboard-text="<?= $voucher.$segmen ?>" 
                            class="h-5 w-5 copy cursor-pointer inline"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                        </svg>
                    </div>
                    <?php endforeach ?>
            </span>

            <small>Satu kode voucher diperuntukkan untuk satu anggota tim.</small>
            <small>Jaga kerahasiaan voucher tim Anda. Pastikan tidak ada peserta selain anggota tim Anda yang mengetahuinya.</small>
        <?php else : ?>
            <span>Sebelum Anda memulai pengerjaan Preliminary Round, silakan Anda mengambil voucher dengan mengunjungi
                <a href="<?= base_url('lomba/generate-voucher') ?>" class="btn btn-xs btn-primary">tautan ini</a>
            </span>
        <?php endif?>

    </div>
    <div class="col-span-12 ">
        <table class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Tahap</th>
                    <th>Tanggal Pelaksanaan</th>
                    <th>Nilai</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Simulasi Preliminary Round</td>
                    <td><?= tanggal('start_pre') ?></td>
                    <td>
                        <?php if($kuota_habis_semua) : ?>
                            <a href="<?= base_url('lomba/reviu-lju/' . $voucher) ?>" target="_blank">cek di sini</a>
                        <?php else : ?>
                            Nilai belum
                        <?php endif; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
    <script>
        new ClipboardJS('.copy');
    </script>


<?= $this->endSection() ?>