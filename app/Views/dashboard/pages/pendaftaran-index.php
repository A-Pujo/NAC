<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="grid grid-cols-12 text-base-100 gap-x-32">
        <!-- Daftar Lomba -->
        <?php if( userinfo()->nama_tim == '' ) : ?>
            <h2 class="col-span-12 text-36 font-extrabold">Jenis Perlombaan</h2>
            <p class="col-span-12 text-16 mt-8">National Accounting Challenge 2021 hadir kembali dengan berbagai rangkaian perlombaan yang sangat menarik! Siapkan tim terbaikmu dan daftar segera!</p>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challenge for High School</h3>
                <p class="mt-8 text-16">Accounting Challenge for High School merupakan kompetisi yang ditujukan kepada siswa/i SMA/SMK/MA/sederajat di seluruh Indonesia yang memiliki minat di bidang akuntansi. Dalam kompetisi ini peserta dapat mengembangkan serta mengimplementasikan ilmu dan pengetahuan yang mereka miliki di bidang akuntasi.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=AccSMA') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challenge for University</h3>
                <p class="mt-8 text-16">Accounting Challenge for University merupakan kompetisi yang ditujukan kepada mahasiswa/i perguruan tinggi di seluruh Indonesia yang memiliki minat di bidang akuntansi. Dalam kompetisi ini peserta dapat mengembangkan serta mengimplementasikan ilmu dan pengetahuan yang mereka miliki di bidang akuntansi.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=AccUniv') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">NAC Call For Paper</h3>
                <p class="mt-8 text-16">NAC Call For Paper merupakan kompetisi yang ditujukan kepada mahasiswa/i perguruan tinggi di seluruh Indonesia yang memiliki minat dalam penulisan karya tulis di bidang akuntansi. Tahun ini NAC 2021 mengusung tema “The Presence of Accountant in Digital Transformation of the Economy for Resilient, Sustainable, and Inclusive Recovery”.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=CFP') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Unduh template surat pernyataan 
                <a href="https://drive.google.com/uc?export=download&id=1x0yaHmVVDuxS_mBux0GllXC7UxO-xx9d" class="underline hover:text-primary-100">Akuntansi SMA</a>
                <a href="https://drive.google.com/uc?export=download&id=1gArwtmwXdEkFjbnkA2PiUgltjHMNSARC" class="underline hover:text-primary-100">Akuntansi Universitas</a>
                <a href="https://drive.google.com/uc?export=download&id=1YuxF1ZZzebKnVB1WZfbUE5V91966KB2O" class="underline hover:text-primary-100">Call for Paper 1</a>
                <a href="https://drive.google.com/uc?export=download&id=1UJGDzSD1_cRywlrF88-My2BqML7_u7Gz" class="underline hover:text-primary-100">Call for Paper 2</a>
            </div>
        <?php else : ?>
            <h2 class="col-span-12 text-36 font-extrabold">Pendaftaran Lomba</h2>
            <p class="col-span-12 text-16 mt-8">Dibawah ini ringkasan pendaftaran lomba yang sedang Anda laksanakan</p>
            <p class="col-span-12 mt-24">Formulir Pendaftaran</p>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex justify-between items-center">
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
            <div class="col-span-12 lg:col-span-6 lg:row-span-2 rounded-md bg-neutral-100 p-24 mt-4">
                <table class="tabel-card">
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
                        <td><?= userinfo()->partisipan_jenis ?></td>
                    </tr>
                    <tr>
                        <td>Nomor Whatsapp</td>
                        <td>:</td>
                        <td><?= userinfo()->wa ?></td>
                    </tr>
                    <tr>
                        <td>Surat Pernyataan</td>
                        <td>:</td>
                        <td><a class="text-primary-200 hover:text-primary-100" href="<?= base_url('/uploads/partisipan/surat-pernyataan/'. userinfo()->surat_pernyataan) ?>" target="_blank">surat pernyataan</a></td>
                    </tr>
                </table>
            </div>
            <!-- KTM dan Twibbon -->
            <div class="col-span-12 lg:col-span-6 rounded-md bg-neutral-100 p-24 mt-4 grid grid-cols-3 gap-x-12 gap-y-12">
                <?php foreach(explode('|', userinfo()->ktm) as $ktm) : ?>
                    <div 
                        class="rounded-md overflow-hidden" 
                        @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>', imgTitle = 'Unggah bukti upload ktm'"
                    >
                        <img class="bg-base-100 object-cover" src="<?= base_url('/uploads/partisipan/ktm/'.$ktm)?>" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="col-span-12 lg:col-span-6 rounded-md bg-neutral-100 p-24 mt-4 grid grid-cols-3 gap-x-12 gap-y-12">
                <?php foreach(explode('|', userinfo()->twibbon) as $twibbon) : ?>
                    <div class="rounded-md overflow-hidden">
                        <img class="bg-base-100 object-cover" src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Accounting -->
            <!-- Pembayaran -->
            <p class="col-span-12 mt-24">Formulir Pembayaran</p>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-8 flex justify-between items-center">
                <?php if(!userinfo()->partisipan_aktif) : ?> 
                    <span>Silakan Anda menunggu status pendaftaran Anda telah terverifikasi sebelum Anda melanjutkan pembayaran</span>
                <?php elseif(userinfo()->nama_bank == '') : ?> 
                    <span>Jumlah yang harus Anda bayar sebesar <?= 'Rp.100.' . substr(userinfo()->wa, -3) ?></span>
                    <a href="" class="btn btn-sm btn-primary">Unggah bukti bayar</a>
                <?php else : ?>
                    <span> <?= userinfo()->nama_bank ?> </span>
                    <span> <?= userinfo()->nama_nasabah ?> </span>
                    <span> <?= userinfo()->nomor_rekening ?> </span>
                    <span> <?= userinfo()->jumlah_transfer ?> </span>
                    <?php if(userinfo()->pembayaran_aktif) : ?>
                            <span class="verif-sukses">Terverifikasi</span>
                        <?php else :?>
                            <span class="verif-gagal">Belum terverifikasi</span>
                        <?php endif?>
                    <span>
                        <img 
                        src="<?= base_url('img/s.jpg') ?>" class="h-24" alt=""
                        @click="imgShow = true, imgSrc = '<?= base_url('img/s.jpg')?>', imgTitle = 'Unggah bukti transfer'"
                    ></span>
                    <div data-tip="Anda Tidak dapat mengedit" class="tooltip tooltip-left">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                        </svg>
                    </div>
                <?php endif ?>
            </div>
            <!-- End Accounting -->

            <!-- CFP -->
            
            <!-- End CFP -->
            
            <!-- Pesan -->
            <p class="col-span-12 mt-8 text-10">Pastikan formulir Pendaftaran dan Pembayaran telah terverifikasi sebelum mengikuti perlombaan</p>
        <?php endif ?>

        <h2 class="col-span-12 text-36 font-extrabold mt-32">Webinar NAC Digital Series </h2>
        <p class="col-span-12 text-16 mt-8">Webinar NAC Digital Series adalah bagian dari rangkaian acara National Accounting Challenge 2021 yang akan menghadirkan narasumber-narasumber berkompeten di bidang akuntansi/audit. Brace yourself and #GetReadyToTransform with us!</p>
        <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
            Coming Soon!
        </div>
        <h2 class="col-span-12 text-36 font-extrabold mt-32">NAC Accounting Course</h2>
        <p class="col-span-12 text-16 mt-8">NAC Accounting Course adalah bagian dari rangkaian acara National Accounting Challenge 2021 berupa kelas pengenalan akuntansi yang dapat diikuti oleh seluruh siswa/i SMA/SMK/MA/sederajat di seluruh Indonesia. Kelas singkat ini akan dipandu oleh dosen PKN STAN melalui beberapa rangkaian video serta diakhiri dengan mini quiz untuk mengukur pemahaman peserta terhadap materi yang disajikan. Peserta course yang berhasil menyelesaikan kelas tersebut akan mendapatkan sertifikat berlisensi dari kampus PKN STAN.</p>
        <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
            Coming Soon!
        </div>


    </div>
<?= $this->endSection() ?>