<?php $model = new \App\Models\M_Webinar ?>
<?= form_open(base_url('webinar/verif-absen/2'))?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama</th>
            <th>Whastapp</th>
            <th>Password</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        <?php foreach($model->getVerifAbsen('webinar_2') as $peserta) : ?>
        <tr>
            <td><?= $no++?></td>
            <td><?= $peserta->nama?></td>
            <td><?= $peserta->wa?></td>
            <td><?= $peserta->webinar_2 ?></td>
            <td><input type="checkbox" class="checkbox checkbox-primary" name="check[]" value="<?= $peserta->id ?>"></td>
        </tr>        
        <?php endforeach ?>
    </tbody>
</table>
<button type="submit" class="btn btn-neutral">Simpan</button>
<?= form_close() ?>