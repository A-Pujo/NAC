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
        <?php 
          $partisipans = new App\Models\M_Nilai_Acc_Sma();
          foreach($partisipans->getPrelim()  
        as $partisipan) : ?>
        <tr <?= $partisipan->prelim ? '' : 'x-show="all"' ?>>
          <td><?= $no++ ?></td>
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
</div>
