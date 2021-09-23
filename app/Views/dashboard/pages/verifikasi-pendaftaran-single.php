<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-primary-100 p-32 text-14">
        <div class="bg-neutral-100 p-24 rounded-md inline-block">
            <table class="tabel-card">
                <tr>
                    <td>Nama Tim</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_tim ?></td>
                </tr>
                <tr>
                    <td>Nama Perguruan Tinggi</td>
                    <td>:</td>
                    <td><?= $partisipan->pt ?></td>
                </tr>
                <tr>
                    <td>Provinsi</td>
                    <td>:</td>
                    <td><?= $partisipan->provinsi ?></td>
                </tr>
                <tr>
                    <td>Nama Ketua Tim</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_ketua ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 1</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_1 ?></td>
                </tr>
                <tr>
                    <td>Nama Anggota 2</td>
                    <td>:</td>
                    <td><?= $partisipan->nama_2 ?></td>
                </tr>
                <tr>
                    <td>Jenis Lomba</td>
                    <td>:</td>
                    <td><?= $partisipan->partisipan_jenis ?></td>
                </tr>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $partisipan->wa ?></td>
                </tr>
                <tr>
                    <td>Surat Pernyataan</td>
                    <td>:</td>
                    <td><a class="text-primary-200 hover:text-primary-100" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'.$partisipan->surat_pernyataan) ?>" target="_blank">surat pernyataan</a></td>
                </tr>
                <?php if($partisipan->partisipan_jenis == 'CFP'): ?>
                <tr>
                    <td>Dokumen Abstrak</td>
                    <td>:</td>
                    <td>
                        <?php foreach(explode('|', $partisipan->file_abstrak) as $file) : ?>
                        <a class="text-primary-200 hover:text-primary-100" href="<?= base_url('/uploads/partisipan/lomba/abstrak/'.$file) ?>" target="_blank">dokumen abstrak</a> &nbsp;
                        <?php endforeach; ?>
                    </td>
                </tr>
                <?php endif; ?>
            </table>
        </div>


        <p>Bukti KTM</p>
        <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24">
            <?php foreach(explode('|', $partisipan->ktm) as $ktm) : ?>
                <div 
                    class="rounded-md overflow-hidden cursor-pointer" 
                    @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>', imgTitle = 'Unggah KTM'"
                >
                    <img class="bg-base-100 object-cover h-full" src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
                </div>
            <?php endforeach; ?>
        </div>
        <p>Bukti Twibbon</p>
        <div class="bg-neutral-100 p-24 rounded-md flex flex-row space-x-24">
            <?php foreach(explode('|', $partisipan->twibbon) as $twibbon) : ?>
                <div 
                    class="rounded-md overflow-hidden cursor-pointer" 
                    @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>', imgTitle = 'Unggah bukti upload Twibbon'"
                >
                    <img class="bg-base-100 object-cover h-full" src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
                </div>
            <?php endforeach; ?>
        </div>
        
        <div class="form-input">
            <label>Alasan ditolak</label>
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

        <?php if($partisipan->partisipan_aktif == 0) : ?>
        <p><a href="<?= base_url('/dashboard/aktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Verifikasi</a></p>
        <p><a href="<?= base_url('/dashboard/tolak-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-danger mt-24" id="uri-tolak">Tolak dan Hapus Data</a></p>
        <?php else: ?>
        <p><a href="<?= base_url('/dashboard/deaktivasi-partisipan/'.$partisipan->user_id) ?>" class="btn btn-block btn-primary mt-24">Cabut Verifikasi</a></p>
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