<?php 
$pesertas = new \App\Models\M_Nilai_Acc_Sma();

$absen_id = [
    $peserta->absen_1,
    $peserta->absen_2,
]

?>

<?= form_open('lomba/verif-absen-sma/1', ['method' => 'post']) ?>
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
                <div class="flex flex-row space-x-8">
                    <?php if($peserta->absen_1 == 1) : ?>
                        <span class="verif-sukses">Terverifikasi</span>
                    <?php elseif($peserta->absen_1 == '') :?>
                            <span class="verif-gagal">Tidak ada data</span>
                    <?php else :?>
                            <?php foreach(explode('|',$peserta->absen_1) as $file) : ?>
                                <img class="h-80" src="<?= base_url('uploads/partisipan/lomba/absen/'.$file) ?>"
                                    @click="imgShow = true, imgSrc = '<?= base_url('uploads/partisipan/lomba/absen/'.$file)?>', imgTitle = 'Absen <?=$peserta->nama_tim?>'"
                                >
                            <?php endforeach ?>

                    <?php endif?>
                </div>
            </td>
            <td>
                <input type="checkbox" class="checkbox checkbox-primary" name="check[<?= $peserta->id ?>]" value="<?= $peserta->absen_1 ?>">
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<button type="submit" class="btn btn-primary w-full">Verifikasi</button>
</form>