<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php 
if(userinfo()->partisipan_jenis == 'AccUniv'){
    if(date(userinfo()->pertama_input) <= date('2021-09-24 23:59:59')){
        $jumlah_transfer = '110000';
    } else {
        $jumlah_transfer = '120000';
    }
} elseif(userinfo()->partisipan_jenis == 'AccSMA'){
    if(date(userinfo()->pertama_input) <= date('2021-09-24 23:59:59')){
        $jumlah_transfer = '80000';
    } else {
        $jumlah_transfer = '90000';
    }
} else{
    if(date(userinfo()->partisipan_diupdate) <= date('2021-10-06 23:59:59')){
        $jumlah_transfer = '50000';
    } else {
        $jumlah_transfer = '70000';
    }
}
if((userinfo()->id+1) > 999){
    userinfo()->id = (userinfo()->id+1)-1000;
}
$jumlah_transfer = substr($jumlah_transfer, 0, (strlen($jumlah_transfer) - strlen(userinfo()->id + 1))) . (userinfo()->id + 1)  ;    

?>

    <div class="grid grid-cols-12 text-base-100 gap-x-24 p-32">

        <h2 class="col-span-12 text-36 font-extrabold">Lomba NAC </h2>
        <p class="col-span-12 text-16 mt-8">National Accounting Challenge 2021 hadir kembali dengan berbagai rangkaian perlombaan yang sangat menarik! Siapkan tim terbaikmu dan daftar segera!</p>
        <!-- 1. ALERT -->
            <!-- User Ditolak -->
            <?php if(userinfo()->partisipan_ditolak == 1) : ?>
            <div class="alert alert-error col-span-12" x-data="{alert : '<?= userinfo()->alasan_ditolak ?>'}" x-show="alert">
                <div class="flex-1">
                    <!-- Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg> 
                    <label class="mr-auto" x-text="alert"></label>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor" @click="alert = ''">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
            <?php endif; ?>

        <!-- 2. USER BELUM DAFTAR : TAMPILKAN MENU DAFTAR -->
        <?php if( userinfo()->nama_tim == '' ) : ?>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challenge for High School</h3>
                <p class="mt-8 text-16">Accounting Challenge for High School merupakan kompetisi yang ditujukan kepada siswa/i SMA/SMK/MA/sederajat di seluruh Indonesia yang memiliki minat di bidang akuntansi. Dalam kompetisi ini peserta dapat mengembangkan serta mengimplementasikan ilmu dan pengetahuan yang mereka miliki di bidang akuntasi.</p>
                <?php if(sekarang() < tanggal('close_acc_sma')) : ?>
                    <a href="<?= base_url('dashboard/pendaftaran?lomba=AccSMA') ?>" class="btn btn-primary mt-16">Daftar</a>
                    <a href="<?= base_url('guide?halaman=acc-sma-booklet') ?>" class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
                <?php else : ?>
                    <div class="h-px w-full bg-primary-60"></div>
                    <p class="mt-4 text-16">Pendaftaran Accounting for High School telah ditutup.</p>
                <?php endif ?>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challenge for University</h3>
                <p class="mt-8 text-16">Accounting Challenge for University merupakan kompetisi yang ditujukan kepada mahasiswa/i perguruan tinggi di seluruh Indonesia yang memiliki minat di bidang akuntansi. Dalam kompetisi ini peserta dapat mengembangkan serta mengimplementasikan ilmu dan pengetahuan yang mereka miliki di bidang akuntansi.</p>
                <?php if(sekarang() < tanggal('close_acc_univ')) : ?>
                    <a href="<?= base_url('dashboard/pendaftaran?lomba=AccUniv') ?>" class="btn btn-primary mt-16">Daftar</a>
                    <a href="<?= base_url('guide?halaman=acc-univ-booklet') ?>" class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
                <?php else : ?>
                    <div class="h-px w-full bg-primary-60"></div>
                    <p class="mt-4 text-16">Pendaftaran Accounting for University telah ditutup.</p>
                <?php endif ?>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">NAC Call For Paper</h3>
                <p class="mt-8 text-16">NAC Call For Paper merupakan kompetisi yang ditujukan kepada mahasiswa/i perguruan tinggi di seluruh Indonesia yang memiliki minat dalam penulisan karya tulis di bidang akuntansi. Tahun ini NAC 2021 mengusung tema “The Presence of Accountant in Digital Transformation of the Economy for Resilient, Sustainable, and Inclusive Recovery”.</p>
                <?php if(sekarang() < tanggal('close_abstrak')) : ?>
                    <a href="<?= base_url('dashboard/pendaftaran?lomba=CFP') ?>" class="btn btn-primary mt-16">Daftar</a>
                    <a href="<?= base_url('guide?halaman=cfp-booklet') ?>" class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
                <?php else : ?>
                    <div class="h-px w-full bg-primary-60"></div>
                    <p class="mt-4 text-16">Pendaftaran Call for Paper telah ditutup.</p>
                <?php endif ?>


            </div>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24 leading-3">
                Sebelum melakukan pendaftaran, silakan Anda mengunduh <a class="btn btn-primary btn-xs" href="<?= base_url('guide?halaman=twib') ?>">twibbon</a> dan <a class="btn btn-primary btn-xs" href="<?= base_url('guide?halaman=sp') ?>" >surat pernyataan</a> terlebih dahulu.
            </div>
        <?php elseif(!userinfo()->partisipan_aktif or !userinfo()->pembayaran_aktif) : ?>
        <!-- 3. USER SUDAH DAFTAR : TAMPILKAN BIODATA PENDAFTARAN -->
            <h2 class="col-span-12 text-36 font-extrabold">Pendaftaran Lomba</h2>
            <p class="col-span-12 text-16 mt-8">Dibawah ini ringkasan pendaftaran lomba yang sedang Anda laksanakan</p>
            <p class="col-span-12 mt-24">Formulir Pendaftaran</p>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4">
                <img src="<?= userinfo()->avatar ?>" alt="avatar" class="h-24 rounded-full">
                <span> <?= userinfo()->nama_tim ?> </span>
                <span> <?= userinfo()->partisipan_jenis == 'AccSMA' ? 'Accounting SMA' : (userinfo()->partisipan_jenis == 'AccUniv' ? 'Accounting Universitas' : 'Paper') ?> </span>
                <span> <?= userinfo()->pt ?></span>
                <?php if(userinfo()->partisipan_aktif) : ?>
                    <span class="verif-sukses">Terverifikasi</span>
                    <div data-tip="Anda Tidak dapat mengedit" class="tooltip tooltip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </div>
                <?php else :?>
                    <span class="verif-gagal">Belum terverifikasi</span>
                    <a href="<?= base_url('/dashboard/pendaftaran') ?>" data-tip="Edit Pendaftaran" class="tooltip tooltip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </a>
                <?php endif?>
            </div>
            <div class="col-span-12 lg:col-span-6 lg:row-span-2 rounded-md bg-neutral-100 p-24 mt-16">
                <table class="tabel-card text-12 lg:text-16">
                    <tr>
                        <td>Nama Tim</td>
                        <td>:</td>
                        <td><?= userinfo()->nama_tim ?></td>
                    </tr>
                    <tr>
                        <td>Nama Perguruan Tinggi</td>
                        <td>:</td>
                        <td><?= userinfo()->pt ?></td>
                    </tr>
                    <tr>
                        <td>Nama Ketua Tim</td>
                        <td>:</td>
                        <td><?= userinfo()->nama_ketua ?></td>
                    </tr>
                    <tr>
                        <td>Nama Anggota 1</td>
                        <td>:</td>
                        <td><?= userinfo()->nama_1 ?></td>
                    </tr>
                    <tr>
                        <td>Nama Anggota 2</td>
                        <td>:</td>
                        <td><?= userinfo()->nama_2 ?></td>
                    </tr>
                    <tr>
                        <td>Jenis Lomba</td>
                        <td>:</td>
                        <td><?= userinfo()->partisipan_jenis == 'AccSMA' ? 'Accounting for High School' : (userinfo()->partisipan_jenis == 'AccUniv'  ? 'Accounting for University' : 'Call for Paper') ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Whatsapp</td>
                        <td>:</td>
                        <td><?= userinfo()->wa ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Whatsapp</td>
                        <td>:</td>
                        <td><?= userinfo()->provinsi ?></td>
                    </tr>
                    <tr>
                        <td class="last">Surat Pernyataan</td>
                        <td>:</td>
                        <td><a class="btn btn-xs btn-primary" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'. userinfo()->surat_pernyataan) ?>" target="_blank">surat pernyataan</a></td>
                    </tr>
                    <?php if(userinfo()->partisipan_jenis == 'CFP') : ?>
                    <tr>
                        <td class="last">Abstrak</td>
                        <td>:</td>
                        <td>
                            <?php foreach(explode('|', userinfo()->file_abstrak) as $abstrak) : ?>
                                <a class="btn btn-xs btn-primary" href="<?= base_url('/uploads/partisipan/lomba/abstrak/'. $abstrak) ?>" target="_blank">abstrak</a>
                            <?php endforeach?>
                        </td>
                    </tr>
                    <?php endif ?>
                </table>
            </div>
            <!-- KTM dan Twibbon -->
            <div class="col-span-12 lg:col-span-6 rounded-md bg-neutral-100 p-24 mt-16 grid grid-cols-3 gap-x-16">
                <?php foreach(explode('|', userinfo()->ktm) as $ktm) : ?>
                    <div 
                        class="rounded-md overflow-hidden cursor-pointer" 
                        @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>', imgTitle = 'Unggah KTM'"
                    >
                        <img class="bg-base-100 object-cover h-full" src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-span-12 lg:col-span-6 rounded-md bg-neutral-100 p-24 mt-16 grid grid-cols-3 gap-x-16">
                <?php foreach(explode('|', userinfo()->twibbon) as $twibbon) : ?>
                    <div 
                        class="rounded-md overflow-hidden cursor-pointer"
                        @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>', imgTitle = 'Unggah bukti upload Twibbon'"
                    >
                        <img class="bg-base-100 object-cover" src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- 4. UPLOAD PAPER FOR CFP -->
            <?php if(userinfo()->partisipan_jenis == 'CFP' ) : ?>
            <p class="col-span-12 mt-24">Formulir Unggah Full Paper</p>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4">
                <?php if(sekarang() < tanggal('close_abstrak') ) : ?>
                    <!-- Belum pengumuman -->
                    <span>Silakan Anda memantau perkembangan pendaftaran Anda. Pastikan pendaftaran Anda telah terverifikasi sebelum tenggat waktu pendaftaran selesai. Apabila lolos dalam seleksi Abstrak, Anda dapat melanjutkan ke tahap pengumpulan Full Paper</span>
                <?php elseif(sekarang() > tanggal('cfp-abstrak') ) : ?>
                    <?php if(userinfo()->file_paper) : ?>
                        <!-- Udah aplot full paper :) -->
                        <span>Paper Anda telah berhasil diunggah, silakan Anda melakukan pembayaran agar Anda dapat melanjutkan ke tahap berikutnya</span>
                        <?php foreach(explode('|', userinfo()->file_paper) as $file) : ?>
                            <a class="btn btn-primary btn-xs" href="<?= base_url('/uploads/partisipan/lomba/paper/'.$file) ?>" target="_blank">Dokumen Paper</a> &nbsp;
                        <?php endforeach; ?>
                        <?php if(userinfo()->nama_bank) : ?>
                            <div data-tip="Anda Tidak dapat mengedit" class="tooltip tooltip-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </div>
                        <?php else :?>
                            <a href="<?= base_url('/dashboard/upload-paper-show')  ?>" data-tip="Edit Paper" class="tooltip tooltip-left">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                        <?php endif?>
                    <?php elseif(userinfo()->lolos_abstrak) : ?>
                        <!-- Udah pengumuman dan lolos -->
                        <?php if(sekarang() > tanggal('close_paper')) : ?>
                            <span>Formulir unggah full paper telah ditutup</span>
                        <?php else : ?>
                            <span>Selamat, Anda lolos tahap seleksi abstrak. Silakan Anda mengunggah berkas full paper pada tautan <a href="<?= base_url('dashboard/upload-paper-show') ?>" class="btn btn-xs btn-primary">berikut</a></span>
                        <?php endif ?>
                    <?php elseif(!userinfo()->lolos_abstrak) : ?>
                        <!-- Udah pengumuman dan tidak lolos :) -->
                        <span>Mohon maaf, Anda tidak lolos tahap seleksi abstrak.
                    <?php endif ?>
                <?php endif ?>
            </div>
            <?php endif ?>

            
            <!-- 5. PEMBAYARAN : ACC TERVERIFIKASI DAN CFP UDAH UP FULL PAPER-->
            <p class="col-span-12 mt-24">Formulir Pembayaran</p>

            
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4">
                <!-- Peserta Acc belum terverifikasi -->
                <?php if((userinfo()->partisipan_jenis == 'AccSMA' or userinfo()->partisipan_jenis == 'AccUniv') and !userinfo()->partisipan_aktif) : ?> 
                    <span>Silakan Anda menunggu status pendaftaran Anda telah terverifikasi sebelum Anda melanjutkan pembayaran</span>
                <!-- Peserta CFP belum upload full paper -->
                <?php elseif(userinfo()->partisipan_jenis == 'CFP' and !userinfo()->file_paper)  :?> 
                    <span>Anda dapat melakukan pembayaran setelah dinyatakan lolos abstrak dan telah mengunggah full paper.</span>
                <?php elseif(userinfo()->nama_bank == '') : ?> 
                    <span>Jumlah yang harus Anda bayar sebesar Rp.<?= substr($jumlah_transfer,0, -3).'.'. substr($jumlah_transfer, -3)?>
                        <div 
                            data-tip="Salin nomor rekening"
                            class="inline tooltip tooltip-primary"
                        >
                            <svg 
                                data-clipboard-text="<?= $jumlah_transfer ?>" 
                                class="h-5 w-5 copy cursor-pointer inline"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                    <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>.
                        Pembayaran dapat Anda transfer ke rekening BRI 105801009301500
                        <div 
                            data-tip="Salin nomor rekening"
                            class="inline tooltip tooltip-primary"
                        >
                            <svg 
                                data-clipboard-text="105801009301500" 
                                class="h-5 w-5 copy cursor-pointer inline"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M7 9a2 2 0 012-2h6a2 2 0 012 2v6a2 2 0 01-2 2H9a2 2 0 01-2-2V9z" />
                                    <path d="M5 3a2 2 0 00-2 2v6a2 2 0 002 2V5h8a2 2 0 00-2-2H5z" />
                            </svg>
                        </div>
                        a.n. Riza Intan Savitri.
                    </span>
                    <a href="<?= base_url('dashboard/pembayaran') ?>" class="btn btn-sm btn-primary">Unggah bukti bayar</a><br>
                    
                <?php else : ?>
                    <span> <?= userinfo()->nama_bank ?> </span>
                    <span> <?= userinfo()->nama_nasabah ?> </span>
                    <span> <?= userinfo()->nomor_rekening ?> </span>
                    <span> Rp.<?= substr(userinfo()->jumlah_transfer,0, -3).'.'. substr(userinfo()->jumlah_transfer, -3)?></span>
                    <span>
                        <img 
                        src="<?= base_url('/uploads/pembayaran/bukti/'.userinfo()->bukti_transfer) ?>" class="h-24 cursor-pointer" alt=""
                        @click="imgShow = true, imgSrc = '<?= base_url('/uploads/pembayaran/bukti/'.userinfo()->bukti_transfer)?>', imgTitle = 'Unggah bukti transfer'"
                    ></span>
                    <?php if(userinfo()->pembayaran_aktif) : ?>
                        <span class="verif-sukses">Terverifikasi</span>
                        <div data-tip="Anda Tidak dapat mengedit" class="tooltip tooltip-right lg:tooltip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </div>
                    <?php else :?>
                        <span class="verif-gagal">Belum terverifikasi</span>
                        <a href="<?= base_url('/dashboard/pembayaran') ?>" data-tip="Edit Pembayaran" class="tooltip tooltip-right lg:tooltip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                    <?php endif?>
                <?php endif ?>
            </div>
            <!-- End Accounting -->

            <!-- CFP -->
            
            <!-- End CFP -->
            
            <!-- Pesan -->
            
            <p class="col-span-12 mt-8 text-10">Pastikan formulir Pendaftaran dan Pembayaran telah terverifikasi sebelum mengikuti perlombaan</p>
            <p class="col-span-12 mt-2 text-10">Jika terdapat kendala selama proses pendaftaran, silakan menghubungi CP yang tertera pada bagian bawah halaman ini</p>
        <?php else : ?>
        <!-- 6. PENDAFTARAN SELESAI -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex flex-col lg:flex-row justify-between items-start lg:items-center space-y-4">
                <span>Selamat, pendaftaran Anda telah terverifikasi. Silakan menunggu informasi selanjutnya.</span>
            </div>
        <?php endif ?>

        <!-- B. COURSE -->
        <h2 id="course" class="col-span-12 text-36 font-extrabold mt-32">NAC Accounting Course</h2>
        <p class="col-span-12 text-16 mt-8">NAC Accounting Course adalah bagian dari rangkaian acara National Accounting Challenge 2021 berupa kelas pengenalan akuntansi yang dapat diikuti oleh seluruh siswa/i SMA/SMK/MA/sederajat di seluruh Indonesia. Kelas singkat ini akan dipandu oleh dosen PKN STAN melalui beberapa rangkaian video serta diakhiri dengan mini quiz untuk mengukur pemahaman peserta terhadap materi yang disajikan. Peserta course yang berhasil menyelesaikan kelas tersebut akan mendapatkan sertifikat berlisensi dari kampus PKN STAN.</p>
        <!-- Course masih atau telah tutup -->
        <?php if(user_kursus()->peserta_ditolak ?? false) : ?>
            <!-- Udah daftar tapi ditolak -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24 flex flex-col md:flex-row justify-between">
                Mohon maaf, pendaftaran Anda belum dapat kami terima. <?= user_kursus()->alasan_ditolak ?>
            </div>
        <?php elseif(user_kursus() ?? false) : ?>
            <!-- Udah daftar belom d verif -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24 flex flex-col md:flex-row justify-between">
                <span><?= user_kursus()->nama_peserta?> </span>
                <span><?= user_kursus()->nama_sekolah?> </span>
                <span>
                    <img 
                    src="<?= base_url('/uploads/kursus/kartu-pelajar/'.user_kursus()->kartu_pelajar) ?>" class="h-24 cursor-pointer" alt=""
                    @click="imgShow = true, imgSrc = '<?= base_url('/uploads/kursus/kartu-pelajar/'.user_kursus()->kartu_pelajar)?>', imgTitle = 'Unggah Kartu Pelajar / Kartu NISN'"
                ></span>
                <span>
                    <img 
                    src="<?= base_url('/uploads/kursus/twibbon/'.user_kursus()->twibbon_kursus) ?>" class="h-24 cursor-pointer" alt=""
                    @click="imgShow = true, imgSrc = '<?= base_url('/uploads/kursus/twibbon/'.user_kursus()->twibbon_kursus)?>', imgTitle = 'Unggah twibbon'"
                ></span>
                <?php if(user_kursus()->verifikasi_peserta) : ?>
                        <span class="verif-sukses">Terverifikasi</span>
                        <div data-tip="Anda Tidak dapat mengedit" class="tooltip tooltip-right lg:tooltip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </div>
                    <?php else :?>
                        <span class="verif-gagal">Belum terverifikasi</span>
                        <a href="<?= base_url('/kursus/registrasi')  ?>" data-tip="Edit Pembayaran" class="tooltip tooltip-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                            </svg>
                        </a>
                <?php endif?>
            </div>
            <?php if(user_kursus()->verifikasi_peserta ?? false) : ?>
                <!-- Udah d verif -->
                <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Selamat, pendaftaran Anda telah kami terima.
                </div>
            <?php endif ?>

        <?php elseif(sekarang()< tanggal('open_course')) : ?>
            <!-- Belum d buka -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Coming Soon!
            </div>
        <?php elseif(sekarang()> tanggal('close_course')) : ?>
            <!-- Udah d tutup -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Pendaftaran Course telah di tutup!
            </div>
        <?php else : ?>
            <!-- Gas Daftar  -->
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Daftar Course sekarang dengan mengunjungi <a href="<?= base_url('/kursus/registrasi')  ?>" class="btn btn-xs btn-primary">tautan ini</a>. Untuk informasi lebih lengkap, Anda dapat melihat booklet Course pada halaman panduan.
            </div>
        <?php endif ?>
        <!-- C. WEBINAR -->
        <h2 class="col-span-12 text-36 font-extrabold mt-32">Webinar NAC Digital Series </h2>
        <p class="col-span-12 text-16 mt-8">Webinar NAC Digital Series adalah bagian dari rangkaian acara National Accounting Challenge 2021 yang akan menghadirkan narasumber-narasumber berkompeten di bidang akuntansi/audit. Brace yourself and #GetReadyToTransform with us!</p>
        <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
            Daftar webinar dapat diakses pada tautan <a href="<?= base_url('webinar') ?>" class="btn btn-xs btn-primary">berikut ini</a>
        </div>


    </div>
    <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<script>
    new ClipboardJS('.copy');
</script>
<?= $this->endSection() ?>