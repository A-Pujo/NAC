<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="grid grid-cols-12 text-base-100 gap-x-32">
        <!-- Daftar Lomba -->
        <?php if( userinfo()->nama_tim == '' ) : ?>
            <h2 class="col-span-12 text-36 font-extrabold">Daftar Perlombaan</h2>
            <p class="col-span-12 text-16 mt-8">Dibawah ini adalah daftar perlombaan yang diselenggarakan NAC 2021</p>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challange For SMA</h3>
                <p class="mt-8 text-16">Sebuah perlombaan bla bla bla Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde perspiciatis aperiam tempore voluptatum, illum necessitatibus id. Rem non libero tenetur.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=AccSMA') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challange For SMA</h3>
                <p class="mt-8 text-16">Sebuah perlombaan bla bla bla Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde perspiciatis aperiam tempore voluptatum, illum necessitatibus id. Rem non libero tenetur.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=AccUniv') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 lg:col-span-4 rounded-md bg-neutral-100 p-24 mt-24">
                <h3 class="font-bold text-16">Accounting Challange For SMA</h3>
                <p class="mt-8 text-16">Sebuah perlombaan bla bla bla Lorem ipsum dolor, sit amet consectetur adipisicing elit. Unde perspiciatis aperiam tempore voluptatum, illum necessitatibus id. Rem non libero tenetur.</p>
                <a href="<?= base_url('dashboard/pendaftaran?lomba=CFP') ?>" class="btn btn-primary mt-16">Daftar</a>
                <a class="btn btn-primary btn-outline mt-16 ml-16">Informasi</a>
            </div>
            <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
                Unduh template surat pernyataan <a href="#" class="underline hover:text-primary-100">disini!</a>
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
                <?php foreach(explode('|', userinfo()->twibbon) as $twibbon) : ?>
                    <div 
                        class="rounded-md overflow-hidden" 
                        @click="imgShow = true, imgSrc = '<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>', imgTitle = 'Unggah bukti upload twibbon'"
                    >
                        <img class="bg-base-100 object-cover" src="<?= base_url('/uploads/partisipan/twibbon/'.$twibbon)?>" alt="" />
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
            <!-- Pesan -->
            <p class="col-span-12 mt-8 text-10">Pastikan formulir Pendaftaran dan Pembayaran telah terverifikasi sebelum mengikuti perlombaan</p>
        <?php endif ?>

        <h2 class="col-span-12 text-36 font-extrabold mt-32">Daftar Seminar</h2>
        <p class="col-span-12 text-16 mt-8">Dibawah ini adalah daftar seminar yang diselenggarakan NAC 2021</p>
        <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
            Coming Soon!
        </div>
        <h2 class="col-span-12 text-36 font-extrabold mt-32">Daftar Course</h2>
        <p class="col-span-12 text-16 mt-8">Course merupakan bla bla bla</p>
        <div class="col-span-12 rounded-md bg-neutral-100 p-24 mt-24">
            Coming Soon!
        </div>


    </div>
<?= $this->endSection() ?>