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
                    placeholder="contoh : Fulan Wulan"
                    type="text"
                    name="alasan" />
                <i>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
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