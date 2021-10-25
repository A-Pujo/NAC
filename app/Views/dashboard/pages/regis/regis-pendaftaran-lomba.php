<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-24 grid grid-cols-12 gap-16">
        <div class="alert alert-info col-span-12">
            <div class="flex-1">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                </svg> 
                <label>Data dibawah merupakan data pendaftar lomba yang telah terverifikasi tahap Pendaftaran dan terverifikasi tahap Pembayaran</label>
            </div>
        </div>
        <div class="col-span-12">
        <table id="tabel" class="tabel col-span-12">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Tim</th>
                    <th>Email</th>
                    <th>Nama Sekolah / Perguruan Tinggi</th>
                    <th>Provinsi</th>
                    <th>Nama Ketua</th>
                    <th>Nama Anggota 1</th>
                    <th>Nama Anggota 2</th>
                    <th>Jenis Lomba</th>
                    <th>Whatsapp</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; foreach(md('peserta_lomba')->getPeserta() as $peserta) : ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= $peserta->nama_tim ?></td>
                    <td><?= $peserta->email ?></td>
                    <td><?= $peserta->pt ?></td>
                    <td><?= $peserta->provinsi ?></td>
                    <td><?= $peserta->nama_ketua ?></td>
                    <td><?= $peserta->nama_1 ?></td>
                    <td><?= $peserta->nama_2 ?></td>
                    <td>
                        <?php if($peserta->partisipan_jenis == 'AccSMA') : ?>
                            Accounting for High School
                        <?php elseif($peserta->partisipan_jenis == 'AccUniv') : ?>
                            Accounting for University
                        <?php else :?>
                            Call for Paper
                        <?php endif ?>
                    </td>
                    <td><?= $peserta->wa ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>