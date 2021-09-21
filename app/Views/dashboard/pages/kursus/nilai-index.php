<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Nama Sekolah</th>
                    <th>Akses Video 1</th>
                    <th>Akses Video 2</th>
                    <th>Akses Video 3</th>
                    <th>Akses Video 4</th>
                    <th>Akses Video 5</th>
                    <th>Akses Video 6</th>
                    <th>Akses Video 7</th>
                    <th>Nilai Kuis 1</th>
                    <th>Nilai Kuis 2</th>
                    <th>Nilai Kuis 3</th>
                    <th>Nilai Kuis 4</th>
                    <th>Nilai Kuis 5</th>
                    <th>Nilai Kuis 6</th>
                    <th>Nilai Kuis 7</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1 ?>
                <?php foreach($daftar_peserta as $peserta) : ?>
                    <?php if($peserta->verifikasi_peserta) :?>
                            
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $peserta->nama_peserta ?></td>
                        <td><?= $peserta->nama_sekolah ?></td>
                        <td><?= $peserta->video_kursus_1 ?></td>
                        <td><?= $peserta->video_kursus_2 ?></td>
                        <td><?= $peserta->video_kursus_3 ?></td>
                        <td><?= $peserta->video_kursus_4 ?></td>
                        <td><?= $peserta->video_kursus_5 ?></td>
                        <td><?= $peserta->video_kursus_6 ?></td>
                        <td><?= $peserta->video_kursus_7 ?></td>
                        <td><?= $peserta->nilai_video_1 ?></td>
                        <td><?= $peserta->nilai_video_2 ?></td>
                        <td><?= $peserta->nilai_video_3 ?></td>
                        <td><?= $peserta->nilai_video_4 ?></td>
                        <td><?= $peserta->nilai_video_5 ?></td>
                        <td><?= $peserta->nilai_video_6 ?></td>
                        <td><?= $peserta->nilai_video_7 ?></td>
                    </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>