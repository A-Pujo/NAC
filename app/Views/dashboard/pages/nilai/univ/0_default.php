<?php
    $pesertas = new \App\Models\M_Nilai_Acc_Univ();
    $pesertas = $pesertas->getAll();
?>

<table class="tabel" id="tabel">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Tim</th>
        <th>Perguruan Tinggi</th>
        <th>Prelim</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1 ?>
        <?php foreach($pesertas as $peserta) : ?>
        <tr>
        <td><?= $no++ ?> </td>
        <td><?= $peserta->nama_tim ?></td>
        <td><?= $peserta->pt ?></td>
        <td>
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