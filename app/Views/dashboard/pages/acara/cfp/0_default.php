<?php
    $pesertas = new \App\Models\M_Nilai_CFP();
?>

<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Tim</th>
            <th>Perguruan Tinggi</th>
        </tr>
    </thead>
    <tbody>
    <?php $no=1 ?>
        <?php foreach($pesertas->getAll() as $peserta) : ?>
        <tr>
        <td><?= $no++ ?> </td>
        <td><?= $peserta->nama_tim ?></td>
        <td><?= $peserta->pt ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>