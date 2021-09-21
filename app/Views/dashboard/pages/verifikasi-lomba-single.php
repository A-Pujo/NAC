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
                <td>File Abstrak</td>
                    <td>:</td>
                    <td>
                        <?php foreach(explode('|', $partisipan->file_abstrak) as $file) : ?>
                        <a class="text-primary-200 hover:text-primary-100" href="<?= base_url('/uploads/partisipan/lomba/abstrak/'.$file) ?>" target="_blank">File Abstrak</a>
                        <?php endforeach; ?>
                    </td>
                </tr>
            </table>
        </div>

        <?php if($partisipan->lolos_abstrak == 0) : ?>
            <p><a href="<?= base_url('/dashboard/lolos-abstrak/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Lulus</a></p>
        <?php else: ?>
            <p><a href="<?= base_url('/dashboard/cabut-lolos-abstrak/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Cabut Kelulusan</a></p>
        <?php endif; ?>
    </div>
    
<?= $this->endSection() ?>