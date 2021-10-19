
<div>
  <h1 class="text-24 font-bold">Pengumuman Kelulusan Seleksi Full Paper Call for Paper</h1>
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
        <?php $no=1; foreach(md('cfp')->getAll('id !=', 0, 'full_paper', 'DESC') as $partisipan) : ?>
        <tr>
          <td><?= $no++ ?></td>
          <td><?= $partisipan['nama_tim'] ?></td>
          <td><?= $partisipan['pt'] ?></td>
          <td>
              <?php if($partisipan['full_paper'] == 1) : ?>
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
