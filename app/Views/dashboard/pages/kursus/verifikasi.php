<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="grid grid-cols-12 gap-24 p-32">

        <div class=" xl:col-span-3 sm:col-span-6 col-span-12 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <!-- Count Pendaftar -->
                <?= 150 - db()->table('peserta_kursus')->where('nama_peserta !=', '')->countAllResults() ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Kuota Peserta</span>
                <small>Sisa kuota tersedia</small>
            </div>
        </div>
        <div class=" xl:col-span-3 sm:col-span-6 col-span-12 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <!-- Count Pendaftar -->
                <?= db()->table('peserta_kursus')
                    ->where('nama_peserta !=', '')
                    ->where('verifikasi_peserta', 0)
                    ->countAllResults() ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Pendaftar</span>
                <small>Pendaftar yang belum diverifikasi</small>
            </div>
        </div>
        <div class=" xl:col-span-3 sm:col-span-6 col-span-12 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <!-- Count Pendaftar -->
                <?= db()->table('peserta_kursus')->where('peserta_ditolak', 1)->countAllResults() ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Pendaftar</span>
                <small>Pendaftar ditolak</small>
            </div>
        </div>
        <div class=" xl:col-span-3 sm:col-span-6 col-span-12 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
            <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
                <!-- Count Pendaftar -->
                <?= db()->table('peserta_kursus')->where('verifikasi_peserta', 1)->countAllResults() ?>
            </div>
            <div class="flex items-start flex-col text-base-200">
                <span class="text-18 font-bold mt-0">Peserta</span>
                <small>Pendaftar yang telah terverifikasi</small>
            </div>
        </div>
        <div class="col-span-12">
            <table id="tabel" class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Peserta</th>
                        <th>Nama Sekolah</th>
                        <th>Partisipan Aktif</th>
                        <th>Tanggal Pendaftaran</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1 ?>
                    <?php foreach($daftar_peserta as $peserta) : ?>
                        <?php if(!$peserta->peserta_ditolak ) : ?>
                                
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $peserta->nama_peserta ?></td>
                                    <td><?= $peserta->nama_sekolah ?></td>
                                    <td>
                                        <?php if($peserta->verifikasi_peserta == 1) : ?>
                                            <span class="verif-sukses"> Terverifikasi <span>
                                        <?php else: ?>
                                            <span class="verif-gagal"> Belum Terverifikasi <span>
                                        <?php endif ?>
                                    </td>
                                    <td><?= $peserta->data_pk_dibuat?></td>
                                    <td><a class="btn btn-sm btn-primary" href="<?= base_url('kursus/verifikasi/'.$peserta->id_user) ?>">Periksa</a></td>
                                </tr>
                        <?php endif;?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>