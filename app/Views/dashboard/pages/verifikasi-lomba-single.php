<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-primary-100 p-32 text-14">
        <div class="bg-neutral-100 p-24 rounded-md inline-block">
            <table class="tabel-card">
                <tr>
                    <td>Nama Tim</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_tim ?></td>
                </tr>
                <tr>
                    <td>Nama Perguruan Tinggi</td>
                    <td>:</td>
                    <td><?= $partisipan->pt ?></td>
                </tr>
                <tr>
                    <td>Nama Ketua Tim</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_ketua ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 1</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_1 ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 2</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_2 ?></td>
                </tr>
                <tr>
                    <td>Jenis Lomba</td>
                    <td>:</td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                </tr>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $partisipan->wa ?></td>
                </tr>
                <tr>
                    <td>Surat Pernyataan</td>
                    <td>:</td>
                    <td><a class="text-primary-200 hover:text-primary-100" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'.$partisipan->surat_pernyataan) ?>" target="_blank">surat pernyataan</a></td>
                </tr>
            </table>
        </div>


        <p>Bukti KTM</p>
        <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24">
            <?php foreach(explode('|', $partisipan->ktm) as $ktm) : ?>
                <div class="border-2 rounded-l">
                    <img class="h-300 w-300" src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
                </div>
            <?php endforeach; ?>
        </div>
        <p>Bukti Twibbon</p>
        <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24">
            <?php foreach(explode('|', $partisipan->twibbon) as $twibbon) : ?>
                <div class="border-2 rounded-l">
                    <img class="h-300 w-300" src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
                </div>
            <?php endforeach; ?>
        </div>

        <?php if($partisipan->partisipan_aktif == 0) : ?>
        <p><a href="<?= base_url('/dashboard/aktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Verifikasi</a></p>
        <p><a href="<?= base_url('/dashboard/tolak-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-danger mt-24">Tolak dan Hapus Data</a></p>
        <?php else: ?>
        <p><a href="<?= base_url('/dashboard/deaktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Cabut Verifikasi</a></p>
        <?php endif; ?>
    </div>
    
<?= $this->endSection() ?>