<?php 
$pesertas = new \App\Models\M_Nilai_CFP();
$absen_id = explode('-',$_GET['page'])[3];
$tahap_id = explode('-',$_GET['page'])[2];
$tahap = ['full_paper'];
?>

<?= form_open('lomba/verif-absen-univ/'.$absen_id, ['method' => 'post']) ?>
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
        <?php foreach($pesertas->getAll($tahap[$tahap_id - 1], '1') as $peserta) : ?>
        <tr>
            <td>
                <?= $no++?>
            </td>
            <td>
                <a href="<?= base_url('dashboard/biodata/'.$peserta['partisipan_id']) ?>" target="_blank" class="link">
                    <?= $peserta['nama_tim'] ?>
                </a>
            </td>
            <td>
                <div class="flex flex-row space-x-8">
                    <?php if($peserta['absen_'.$absen_id] == 1) : ?>
                        <span class="verif-sukses">Terverifikasi</span>
                    <?php elseif($peserta['absen_'.$absen_id] == '') :?>
                            <span class="verif-gagal">Tidak ada data</span>
                    <?php else :?>
                            <?php foreach(explode('|',$peserta['absen_'.$absen_id]) as $file) : ?>
                                <img class="h-80" src="<?= base_url('uploads/partisipan/lomba/absen/'.$file) ?>"
                                    @click="imgShow = true, imgSrc = '<?= base_url('uploads/partisipan/lomba/absen/'.$file)?>', imgTitle = 'Absen <?=$peserta['nama_tim']?>'"
                                >
                            <?php endforeach ?>

                    <?php endif?>
                </div>
            </td>
            <td>
                <input type="checkbox" class="checkbox checkbox-primary" name="check[<?= $peserta['id'] ?>]" value="<?= $peserta['absen_'.$absen_id] ?>">
            </td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
<button type="submit" class="btn btn-primary w-full">Verifikasi</button>
</form>