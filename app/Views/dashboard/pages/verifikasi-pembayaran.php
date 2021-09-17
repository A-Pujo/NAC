<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="grid grid-cols-6 gap-x-8 gap-y-16">
        
        <div class=" col-span-3 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <?= countPartisipan('nama_bank !=', '') ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Potensi Transfer Masuk</span>
                <span class="text-24 font-black leading-none"><></span>
                <small>Pendaftar yang telah mengunggah bukti transfer</small>
            </div>
        </div>
        <div class=" col-span-3 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <?= countPartisipan('pembayaran_aktif', '1') ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Potensi Transfer Masuk</span>
                <span class="text-24 font-black leading-none">Rp.750.000</span>
                <small>Pendaftar yang telah mengunggah bukti transfer</small>
            </div>
        </div>

        <div class="col-span-6 mt-36">
            <table id="tabel" class="tabel">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Tim</th>
                        <th>Jenis Partisipasi</th>
                        <th>Nama Ketua</th>
                        <th>Status Verifikasi</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no=1 ?>
                    <?php foreach($data_partisipan as $partisipan) : 
                        if(($_GET['p'] ?? true ) == $partisipan->partisipan_jenis and $partisipan->nama_bank): 
                    ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $partisipan->nama_tim ?></td>
                        <td><?= $partisipan->partisipan_jenis ?></td>
                        <td><?= $partisipan->nama_ketua ?></td>
                        <td>
                            <?php if($partisipan->pembayaran_aktif == 1) : ?>
                                <span class="verif-sukses"> Terverifikasi <span>
                            <?php else: ?>
                                <span class="verif-gagal"> Belum Terverifikasi <span>
                            <?php endif ?>
                        </td>
                        <td><a class="btn btn-primary" href="<?= base_url('/dashboard/verifikasi-pembayaran/'.$partisipan->user_id) ?>">Periksa</a></td>
                    </tr>
                    <?php endif;
                    endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>