<?php
$model = new \App\Models\M_Webinar();
$webinar_id = explode('-',$_GET['page'])[1];
?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Whatsapp</th>
            <th>Pertanyaan</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        <?php foreach($model->getPertanyaan('pertanyaan_'.$webinar_id) as $pertanyaan) : ?>
        <tr>
            <td><?= $no++?></td>
            <td><?= $pertanyaan['nama'] ?></td>
            <td><?= $pertanyaan['wa'] ?></td>
            <td><?= $pertanyaan['pertanyaan_'.$webinar_id] ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>