<?=  form_open('acara/verif-kelulusan/univ/semifinal/nilai_1/nilai_2')?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Tim</th>
            <th>FGD X Essay</th>
            <th>Fun Games</th>
            <th>Lulus</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1; foreach(md('univ')->getAll('prelim', 1) as $peserta) : ?>
        <tr>
            <td><?= $no++ ?></td>
            <td><?= $peserta['nama_tim'] ?></td>
            <td><input type="text" class="input-text" name="nilai_1[<?= $peserta['id'] ?>]" value="<?= $peserta['nilai_1'] ?>"></td>
            <td><input type="text" class="input-text" name="nilai_2[<?= $peserta['id'] ?>]" value="<?= $peserta['nilai_2'] ?>"></td>
            <td><input type="checkbox" class="checkbox checkbox-primary" <?= $peserta['semifinal'] ? 'checked': '' ?> name="check[]" value="<?= $peserta['id'] ?>"></td>
            <input type="hidden" name="ids[]" value="<?= $peserta['id'] ?>">
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<?= form_submit('submit', 'submit') ?>
<?= form_close() ?>