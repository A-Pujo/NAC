<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-32 grid grid-cols-12 gap-24 text-base-100">
      <div class="col-span-12">
        <table class="tabel" id="tabel">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Tim</th>
                <th>PT</th>
                <th>Prelim Jawab Salah</th>
                <th>Prelim Jawab Benar</th>
                <th>Nilai</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
            <?php $no=1 ?>
              <?php foreach(
                  db()->table('data_partisipan')
                  ->select(
                    '(segmen_1 + segmen_2 + segmen_3) as nilai_total,
                    nama_tim,
                    pt,
                    prelim,
                    prelim_jawab_benar,
                    prelim_jawab_salah
                    ')
                  ->join('nilai_acc_univ', 'nilai_acc_univ.partisipan_id = data_partisipan.partisipan_id')
                  ->orderBy('prelim', 'DESC')
                  ->orderBy('nilai_total', 'DESC')
                  ->get()->getResult() as $partisipan) : ?>
              <tr <?= $partisipan->prelim ? '' : 'x-show="all"' ?>>
                <td><?= $no++ ?> </td>
                <td><?= $partisipan->nama_tim ?></td>
                <td><?= $partisipan->pt ?></td>
                <td><?= $partisipan->prelim_jawab_salah ?></td>
                <td><?= $partisipan->prelim_jawab_benar ?></td>
                <td x-show="all"><?= $partisipan->nilai_total ?></td>
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
      <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>
