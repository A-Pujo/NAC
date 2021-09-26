<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Tim</th>
                    <th>Email</th>
                    <th>Jenis Partisipasi</th>
                    <th>Partisipan Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($data_partisipan as $partisipan) : 
                    if(($partisipan->role_id == 0 and $partisipan->nama_tim != '') or $partisipan->partisipan_aktif == 1):?>
                            
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $partisipan->nama_tim ?></td>
                                <td><?= $partisipan->email ?></td>
                                <td>
                                    <?= $partisipan->partisipan_jenis == 'AccSMA' ? 'Accounting for High School' : ($partisipan->partisipan_jenis == 'AccUniv' ? 'Accounting for Universitas' : 'Call for Paper') ?>
                                </td>
                                <td>
                                    <?php if($partisipan->partisipan_aktif == 1) : ?>
                                        <span class="verif-sukses"> Terverifikasi <span>
                                    <?php else: ?>
                                        <span class="verif-gagal"> Belum Terverifikasi <span>
                                    <?php endif ?>
                                </td>
                                <td><a class="btn btn-sm btn-primary" href="<?= base_url('/dashboard/verifikasi-pendaftaran/'.$partisipan->user_id) ?>">Periksa</a></td>
                            </tr>
                    <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>