<div class="p-32 grid grid-cols-12 gap-24">
    <div class=" col-span-4 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
        <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
            <?= db()->table('peserta_kursus')
                ->where('verifikasi_peserta', 1)
                ->countAllResults()
            ?>
        </div>
        <div class="flex items-start flex-col text-base-200">
            <span class="text-18 font-bold mt-0">Pendaftar</span>
            <small>Pendaftar yang telah diverifikasi</small>
        </div>
    </div>
    <div class=" col-span-4 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
        <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
            <?= db()->table('peserta_kursus')
                ->where('video_kursus_1', 1)
                ->orWhere('video_kursus_2', 1)
                ->orWhere('video_kursus_3', 1)
                ->orWhere('video_kursus_4', 1)
                ->orWhere('video_kursus_5', 1)
                ->orWhere('video_kursus_6', 1)
                ->orWhere('video_kursus_7', 1)
                ->countAllResults()
            ?>
        </div>
        <div class="flex items-start flex-col text-base-200">
            <span class="text-18 font-bold mt-0">Lulus</span>
            <small>Peserta yang menonton seluruh video dan mengerjakan kuis</small>
        </div>
    </div>
    <div class=" col-span-4 rounded-md bg-primary-300 flex items-center p-24 space-x-8">
    <div class="rounded-full flex justify-center items-center flex-shrink-0 w-48 h-48 font-extrabold text-24 bg-primary-200 text-neutral-100">
            <?= db()->table('peserta_kursus')
                ->where('nilai_video_1 >=', 14)
                ->Where('nilai_video_2 >=', 14)
                ->Where('nilai_video_3 >=', 14)
                ->Where('nilai_video_4 >=', 14)
                ->Where('nilai_video_5 >=', 14)
                ->Where('nilai_video_6 >=', 14)
                ->Where('nilai_video_7 >=', 14)
                ->countAllResults()
            ?>
        </div>
        <div class="flex items-start flex-col text-base-200">
            <span class="text-18 font-bold mt-0">Pendaftar</span>
            <small>Peserta yang mengerjakan kuis dengan nilai minimal 14</small>
        </div>
    </div>
    <div class="col-span-12">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Peserta</th>
                    <th>Email</th>
                    <th>Nama Sekolah</th>
                    <th>Kelulusan Partisipasi</th>
                    <th>Kelulusan Nilai Minimal</th>
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
                <?php $no=1; foreach(md('kursus')->getAll() as $peserta) : ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $peserta->nama_peserta ?></td>
                        <td><?= $peserta->email ?></td>
                        <td><?= $peserta->nama_sekolah ?></td>
                        <td>
                            <?php if(
                                $peserta->video_kursus_1 == 1 &&
                                $peserta->video_kursus_2 == 1 &&
                                $peserta->video_kursus_3 == 1 &&
                                $peserta->video_kursus_4 == 1 &&
                                $peserta->video_kursus_5 == 1 &&
                                $peserta->video_kursus_6 == 1 &&
                                $peserta->video_kursus_7 == 1
                            ) : ?>
                                <a target="_blank" href="<?= "http://localhost/cetak-pdf-nac/index.php?id=$peserta->id_peserta&pass=$peserta->wa" ?>"  class="verif-sukses"> Lulus <a>
                            <?php else : ?>
                                <a class="verif-gagal"> Tidak lulus <a>
                            <?php endif ?>
                        </td>
                        <td>
                            <?php if(
                                $peserta->nilai_video_1 >= 14 &&
                                $peserta->nilai_video_2 >= 14 &&
                                $peserta->nilai_video_3 >= 14 &&
                                $peserta->nilai_video_4 >= 14 &&
                                $peserta->nilai_video_5 >= 14 &&
                                $peserta->nilai_video_6 >= 14 &&
                                $peserta->nilai_video_7 >= 14
                            ) : ?>
                                <a class="verif-sukses"> Lulus <a>
                            <?php else : ?>
                                <a class="verif-gagal"> Tidak lulus <a>
                            <?php endif ?>
                        </td>
                        <td><span class="<?= $peserta->video_kursus_1 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_1 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_2 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_2 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_3 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_3 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_4 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_4 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_5 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_5 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_6 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_6 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->video_kursus_7 ? 'verif-sukses' : 'verif-gagal' ?>"><?= $peserta->video_kursus_7 ? 'ya' : 'tidak' ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_1 < 14? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_1 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_2 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_2 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_3 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_3 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_4 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_4 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_5 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_5 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_6 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_6 ?></span></td>
                        <td><span class="<?= $peserta->nilai_video_7 < 14 ? 'verif-gagal' : 'verif-sukses' ?>"><?= $peserta->nilai_video_7 ?></span></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>