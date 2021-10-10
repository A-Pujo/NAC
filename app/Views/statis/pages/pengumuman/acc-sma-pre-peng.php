<div x-data="{all:false}">
  <h1 class="text-24 font-bold">Pengumuman Kelulusan Seleksi Preliminary Accounting for High School</h1>
  <small><?= tanggal($_GET['halaman']) ?></small><br>
  <button @click="all = !all" class="btn btn-primary btn-sm">Tampilkan semua data</button>
  <table class="tabel mt-24" >
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>SMA</th>
        <th x-show="all">Nilai</th>
        <th x-show="all">Status</th>
      </tr>
    </thead>
    <tbody>
    <?php $no=1 ?>
      <?php foreach(
          db()->table('data_partisipan')
          ->join('nilai_acc_sma', 'nilai_acc_sma.partisipan_id = data_partisipan.partisipan_id')
          ->orderBy('prelim', 'DESC')
          ->orderBy('segmen_1', 'DESC')
          ->get()->getResult() as $partisipan) : ?>
      <tr <?= $partisipan->prelim ? '' : 'x-show="all"' ?>>
        <td><?= $no++ ?> </td>
        <td><?= $partisipan->nama_tim ?></td>
        <td><?= $partisipan->pt ?></td>
        <td x-show="all"><?= $partisipan->segmen_1 + $partisipan->segmen_2 + $partisipan->segmen_3 ?></td>
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
</div>
