<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-32 space-y-24">
    <div class="bg-neutral-100 p-24 rounded-md inline-block">
        <table class="tabel-card">
            <tr>
                <td>Nama Peserta</td>
                <td>:</td>
                <td><?= $peserta->nama_peserta ?></td>
            </tr>
            <tr>
                <td>Nama Sekolah</td>
                <td>:</td>
                <td><?= $peserta->nama_sekolah ?></td>
            </tr>
        </table>
    </div>
    <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24">
        <div 
            class="rounded-md overflow-hidden cursor-pointer" 
            @click="imgShow = true, imgSrc = '<?= base_url('uploads/kursus/kartu-pelajar/'.$peserta->kartu_pelajar) ?>', imgTitle = 'Bukti Pendukung'"
        >
            <img class="bg-base-100 object-cover h-full" src="<?= base_url('uploads/kursus/kartu-pelajar/'.$peserta->kartu_pelajar) ?>" alt="" />
        </div>
    </div>

    <?php if($peserta->verifikasi_peserta == 1) : ?>
            <a class="btn btn-primary btn-block" href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/0') ?>">Cabut Verifikasi</a>
        <?php else : ?>
            <a class="btn btn-primary btn-block" href="<?= base_url('kursus/aktivasi-peserta/' . $peserta->id_user . '/1') ?>">Verifikasi</a>

            <?php if($peserta->peserta_ditolak == 0) : ?>
                    <!-- Alasan ditolak-->
                <div class="form-input">
                    <label class="text-base-100">Alasan</label>
                    <div>
                        <input 
                            placeholder="Jangan lupa di akhir kalimat diberi tanda baca titik (.)"
                            type="text"
                            name="alasan" />
                        <i>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M13.477 14.89A6 6 0 015.11 6.524l8.367 8.368zm1.414-1.414L6.524 5.11a6 6 0 018.367 8.367zM18 10a8 8 0 11-16 0 8 8 0 0116 0z" clip-rule="evenodd" />
                        </svg>
                        </i>
                    </div>
                </div>
                <a class="btn btn-primary btn-block" href="<?= base_url('kursus/tolak-peserta/' . $peserta->id_user . '/1') ?>" id="uri-tolak">Tolak</a>
            <?php else: ?>
                <a class="btn btn-primary btn-block" href="<?= base_url('kursus/tolak-peserta/' . $peserta->id_user . '/0') ?>">Cabut Tolak</a>
            <?php endif; ?>

    <?php endif; ?>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            let href = $('#uri-tolak').attr('href');
           $('input[name=alasan]').keyup(function(){
                if($(this).val() == null){
                    $('#uri-tolak').attr('href', href);
                } else {
                    $('#uri-tolak').attr('href', href + '?alasan_ditolak=' + $(this).val());
                }
           });
        });
</script>
<?= $this->endSection() ?>