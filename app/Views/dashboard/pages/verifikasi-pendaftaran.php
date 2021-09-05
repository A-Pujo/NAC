<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="text-primary-100">
        <table id="tabel-partisipan" class="table w-full text-accent-content">
            <thead>
                <tr>
                    <th>Nama Tim</th>
                    <th>jenis Partisipasi</th>
                    <th>Nama Ketua</th>
                    <th>Status Verifikasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : 
                    if($partisipan->partisipan_aktif == 1):?>
                <tr>
                    <td><?= $partisipan->nama_tim ?></td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                    <td><?= $partisipan->nama_ketua ?></td>
                    <td><?= $partisipan->pembayaran_aktif == 0 ? 'Belum Terverifikasi' : 'Telah terverifikasi' ?></td>
                    <td><a class="btn btn-primary" href="<?= base_url('/dashboard/verifikasi-pembayaran/'.$partisipan->user_id) ?>">Periksa</a></td>
                </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>

<?= $this->endSection() ?>