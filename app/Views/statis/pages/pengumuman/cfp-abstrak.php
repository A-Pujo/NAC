<div>
  <h1 class="text-24 font-bold">Pengumuman Kelulusan Seleksi Abstrak Call for Paper</h1>
  <small><?= tanggal($_GET['halaman']) ?></small>
  <table class="tabel mt-24">
    <thead>
      <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>Perguruan Tinggi</th>
      </tr>
    </thead>
    <tbody>
      <?php $no=1 ?>
      <?php foreach(db()->table('data_partisipan')->where('lolos_abstrak', 1)->get()->getResult() as $partisipan) : ?>
      <tr>
        <td><?= $no++ ?> </td>
        <td><?= $partisipan->nama_tim ?></td>
        <td><?= $partisipan->pt ?></td>
      </tr>
      <?php endforeach ?>
    </tbody>
  </table>
</div>
