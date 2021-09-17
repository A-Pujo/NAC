<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>Nama Tim</th>
                    <th>Nama Ketua</th>
                    <th>Lolos Abstrak</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($data_partisipan as $partisipan) : 
                    if(($partisipan->role_id == 0 and $partisipan->nama_tim != '') and $partisipan->partisipan_aktif == 1):?>
                            <tr>
                                <td><?= $partisipan->nama_tim ?></td>
                                <td><?= $partisipan->nama_ketua ?></td>
                                <td>
                                    <?php if($partisipan->lolos_abstrak == 1) : ?>
                                        <span class="verif-sukses"> Terverifikasi <span>
                                    <?php else: ?>
                                        <span class="verif-gagal"> Belum Terverifikasi <span>
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