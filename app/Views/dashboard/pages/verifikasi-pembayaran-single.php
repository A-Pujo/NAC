<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-primary-100 p-32 text-14">
        <div class="bg-neutral-100 p-24 rounded-md inline-block">
            <table class="tabel-card">
                <tr>
                    <td>Nama Bank</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_bank ?></td>
                </tr>
                <tr>
                    <td>Nama Nasabah</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_nasabah ?></td>
                </tr>
                <tr>
                    <td>Nomor Rekening</td>
                    <td>:</td>
                    <td><?= $partisipan->nomor_rekening ?></td>
                </tr>
                <tr>
                    <td>Jumlah transfer</td>
                    <td>:</td>
                    <td><b>Rp.<?= substr($partisipan->jumlah_transfer,0, -3).'.'. substr($partisipan->jumlah_transfer, -3)?></b></td>
                </tr>
            </table>
        </div>
        <p>Bukti Transfer</p>
        <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24 mb-24">
            <?php foreach(explode('|', $partisipan->bukti_transfer) as $bukti_transfer) : ?>
                <div 
                    class="rounded-md overflow-hidden cursor-pointer" 
                    @click="imgShow = true, imgSrc = '<?= base_url('/uploads/pembayaran/bukti/'.$bukti_transfer)?>', imgTitle = 'Unggah bukti transfer'"
                >
                    <img class="bg-base-100 object-cover h-full" src="<?= base_url('/uploads/pembayaran/bukti/'.$bukti_transfer)?>" alt="" />
                </div>
            <?php endforeach; ?>
        </div>
        
        <?php if($partisipan->pembayaran_aktif == 0) : ?>
        <p><a href="<?= base_url('/dashboard/aktivasi-pembayaran/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary">Verifikasi</a></p>
        <?php else: ?>
        <p><a href="<?= base_url('/dashboard/deaktivasi-pembayaran/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary">Cabut verifikasi</a></p>
        <?php endif; ?>
    </div>

<?= $this->endSection() ?>