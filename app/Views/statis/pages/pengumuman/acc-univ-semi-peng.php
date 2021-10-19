
<div>
  <h1 class="text-24 font-bold">Pengumuman Kelulusan Seleksi Preliminary Accounting for High School</h1>
  <small><?= tanggal($_GET['halaman']) ?></small><br>
    <table class="tabel mt-24" >
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Tim</th>
          <th>Sekolah</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php $no=1; foreach(md('univ')->getAll('prelim', 1, 'semifinal', 'DESC') as $partisipan) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $partisipan['nama_tim'] ?></td>
          <td><?= $partisipan['pt'] ?></td>
          <td>
              <?php if($partisipan['semifinal'] == 1) : ?>
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
