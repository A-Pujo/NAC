<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Tim</th>
                    <th>Nama Ketua</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($data_partisipan as $partisipan) : 
                    if($partisipan->partisipan_jenis == 'CFP' && $partisipan->partisipan_aktif ):?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $partisipan->nama_tim ?></td>
                                <td><?= $partisipan->nama_ketua ?></td>
                                <td>
                                    <?php if($partisipan->lolos_abstrak == 1) : ?>
                                        <span class="verif-sukses"> Lolos <span>
                                    <?php else: ?>
                                        <span class="verif-gagal"> Tidak Lolos <span>
                                    <?php endif ?>
                                </td>
                                <td><a class="btn btn-primary" href="<?= base_url('/dashboard/verifikasi-abstrak/'.$partisipan->user_id) ?>">Periksa</a></td>
                            </tr>
                    <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>