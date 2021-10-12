<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32 grid grid-cols-12 gap-24 text-base-100">
      <div class="col-span-12">
        <table class="tabel" id="tabel">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Tim</th>
                <th>SMA</th>
                <th>Prelim Jawab Salah</th>
                <th>Prelim Jawab Benar</th>
                <th>Nilai</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1 ?>
              <?php foreach($pesertas as $peserta) : ?>
              <tr>
                <td><?= $no++ ?> </td>
                <td><?= $peserta->nama_tim ?></td>
                <td><?= $peserta->pt ?></td>
                <td><?= $peserta->prelim_jawab_salah ?></td>
                <td><?= $peserta->prelim_jawab_benar ?></td>
                <td ><?= $peserta->segmen_1 + $peserta->segmen_2 + $peserta->segmen_3 ?></td>
                <td >
                  <?php if($peserta->prelim == 1) : ?>
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
      <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>
