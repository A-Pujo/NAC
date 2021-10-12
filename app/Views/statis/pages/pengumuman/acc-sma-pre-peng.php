<div x-data="{all:false}">
  <h1 class="text-24 font-bold">Pengumuman Kelulusan Seleksi Preliminary Accounting for High School</h1>
  <small><?= tanggal($_GET['halaman']) ?></small><br>
  <button @click="all = !all" class="btn btn-primary btn-sm">Tampilkan semua data</button>
    <table class="tabel mt-24 " >
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Tim</th>
          <th>Sekolah</th>
          <th x-show="all">Nilai</th>
          <th x-show="all">Jumlah Jawaban Salah</th>
          <th x-show="all">Status</th>
        </tr>
      </thead>
      <tbody>
      <?php $no=1 ?>
        <?php foreach(
            db()->table('data_partisipan')
            ->select('(segmen_1 + segmen_2 + segmen_3) as nilai_total, nama_tim, pt, prelim, prelim_jawab_salah')
            ->join('nilai_acc_sma', 'nilai_acc_sma.partisipan_id = data_partisipan.partisipan_id')
            ->orderBy('prelim', 'DESC')
            ->orderBy('nilai_total', 'DESC')
            ->get()->getResult() as $partisipan) : ?>
        <tr <?= $partisipan->prelim ? '' : 'x-show="all"' ?>>
          <td><?= $no++ ?> <?=  ($no == 20 || $no == 21 || $no == 22 || $no == 23) ? '*' : '' ?></td>
          <td><?= $partisipan->nama_tim ?></td>
          <td><?= $partisipan->pt ?></td>
          <td x-show="all"><?= $partisipan->nilai_total ?></td>
          <td x-show="all"><?= $partisipan->prelim_jawab_salah ?></td>
          <td x-show="all">
            <?php if($partisipan->prelim == 1) : ?>
                <span class="verif-sukses"> Lulus <span>
            <?php else: ?>
                <span class="verif-gagal"> Tidak Lulus <span>
            <?php endif ?>
          </td>
        </tr>
        <?php endforeach ?>
      </tbody>
    </table>
  <small x-show="all">*Peringkat peserta yang mendapat skor sama didasarkan atas hasil tes ulang yang dilaksanakan pada Senin, 11 Oktober 2021</small>
</div>
