<?php $pesertas = new \App\Models\M_Nilai_Acc_Sma() ?>

<?= form_open('lomba/verif-absen-sma', ['method' => 'post']) ?>
<table class="tabel" id="tabel">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Team</th>
            <th>Bukti</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        <?php foreach($pesertas->getAll('prelim', '1') as $peserta) : ?>
        <tr>
            <td>
                <?= $no++?>
            </td>
            <td>
                <?= $peserta->nama_tim ?>
            </td>
            <td>
                Ini bukti gambar (kolom absen)
            </td>
            <td>
                <input type="checkbox" checked="checked" class="checkbox" name="<?= $peserta->id ?>" value="1">
                <input type="hidden" name="absen_<?= $peserta->id ?>" value="<?= $peserta->absen_1 ?>">
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
    <tfoot>
        <td colspan="4">
            <button type="submit">Verifikasi</button>
        </td>
    </tfoot>
</table>
</form>