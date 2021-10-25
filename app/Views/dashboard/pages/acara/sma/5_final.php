<?=  form_open('acara/verif-kelulusan/sma/final/nilai_5/nilai_6')?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>Nilai Pemaparan</th>
            <th>Nilai Final</th>
            <th>Final</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('sma')->getAll('semifinal', 1) as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta['nama_tim'] ?></td>
            <td><input type="text" class="input-text" name="nilai_5[<?= $peserta['id'] ?>]" value="<?= $peserta['nilai_5'] ?>"></td>
            <td><input type="text" class="input-text" name="nilai_6[<?= $peserta['id'] ?>]" value="<?= $peserta['nilai_6'] ?>"></td>
            <td><input type="checkbox" class="checkbox checkbox-primary" <?= $peserta['final'] ? 'checked': '' ?> name="check[]" value="<?= $peserta['id'] ?>"></td>
            <input type="hidden" name="ids[]" value="<?= $peserta['id'] ?>">
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= form_submit('submit', 'submit') ?>
<?= form_close() ?>