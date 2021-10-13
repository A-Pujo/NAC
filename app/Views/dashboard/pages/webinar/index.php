<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<div
    x-data="{
        webinar_id: 1 ?>
    }"
>
    <div class="grid grid-cols-12 p-24 gap-24 text-base-100">
        ig : <?= old('ig') ?>
        id : <?= old('webinar_id') ?>
        <div class="card col-span-12 lg:col-span-8 p-24 bg-neutral-100">
            <table class="tabel-card text-12 lg:text-16">
                <tr>
                    <td>Nama</td>
                    <td>:</td>
                    <td><?= $peserta->nama ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>:</td>
                    <td><?= $peserta->email ?></td>
                </tr>
                <tr>
                    <td>Instansi</td>
                    <td>:</td>
                    <td><?= $peserta->instansi ?></td>
                </tr>
                
                <?php if($peserta->npm) : // Warga STAN?>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td><?= $peserta->npm ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?= $peserta->prodi ?></td>
                    </tr>
                <?php endif ?>
                <tr>
                    <td>Nomor Whatsapp</td>
                    <td>:</td>
                    <td><?= $peserta->wa ?></td>
                </tr>
            </table>
        </div>
        <div class="col-span-12 overflow-x-auto">
            <table class="tabel">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Seminar</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Absensi</th>
                        <th>Sertifikat</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Seminar Internasional</td>
                        <td>20 Oktober 2021</td>
                        <td>Belum mendaftar</td>
                        <td>
                            <a @click="webinar_id = 1" class="btn btn-primary btn-sm">Daftar Sekarang</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">-</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">Password Absensi Salah</a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Seminar Universe</td>
                        <td>20 Oktober 2021</td>
                        <td>Telah mendaftar</td>
                        <td>
                            <a class="btn btn-primary btn-sm">Join Zoom</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">-</a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm">Belum tersedia</a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Seminar RT</td>
                        <td>Sedang berlangsung</td>
                        <td>Telah mendaftar</td>
                        <td>
                            <a class="btn btn-primary btn-sm"> - </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm"> Absen </a>
                        </td>
                        <td>
                            <a class="btn btn-primary btn-sm"> Download </a>
                        </td>
                    </tr>
                </tbody>
            </table>
            <small>*Batas waktu absensi hingga 1 jam setelah acara usai</small>
        </div>
    </div>
    <div x-show="webinar_id != 0" class="fixed top-0 left-0 w-screen h-screen flex justify-center items-center p-24 bg-neutral-400 bg-opacity-90">
        <div class="relative card bg-neutral-100 max-w-600 p-24 text-base-100 w-full">
            <h2 class="text-24 font-bold text-center">Form pendaftaran webinar #1</h2>
            <!-- <form method="post" action="<?=base_url('webinar/klaim') ?>" name="klaimTiket" onsubmit="return validasi()"> -->
            <?= form_open('webinar/klaim') ?>
            <!-- IG -->
            <div class="form-input">
                <label>Link bukti share twibbon</label>
                <div>
                    <input 
                        placeholder="contoh : https://www.instagram.com/p/CU40Gj-hVa7/?utm_source=ig_web_copy_link"
                        value="<?= old('ig') ?>"
                        type="text"
                        name="ig" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M12.586 4.586a2 2 0 112.828 2.828l-3 3a2 2 0 01-2.828 0 1 1 0 00-1.414 1.414 4 4 0 005.656 0l3-3a4 4 0 00-5.656-5.656l-1.5 1.5a1 1 0 101.414 1.414l1.5-1.5zm-5 5a2 2 0 012.828 0 1 1 0 101.414-1.414 4 4 0 00-5.656 0l-3 3a4 4 0 105.656 5.656l1.5-1.5a1 1 0 10-1.414-1.414l-1.5 1.5a2 2 0 11-2.828-2.828l3-3z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
                <span id="err-ig"><?= initValidation()->getError('ig') ?? '' ?></span>
            </div>
            <!-- PERTANYAAN -->
            <div class="form-input">
                <label>Pertanyaan untuk webinar ini?</label>
                <div>
                    <input 
                        placeholder="contoh : Bagaimana pengaruh ekonomi global terhadap keuangan daerah?"
                        value="<?= old('webinar_id')?>"
                        type="text"
                        name="pertanyaan" />
                    <i>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z" clip-rule="evenodd" />
                    </svg>
                    </i>
                </div>
                <span><?= initValidation()->getError('nama') ?? '' ?></span>
            </div>
            <!-- SUBMIT -->
            <input type="hidden" name="webinar_id" :value="webinar_id">
            <div class="flex flex-row justify-between">
                <span class="btn btn-error btn-sm" @click="webinar_id = 0">Cancel</span>
                <input type="submit" value="submit" name="submit" class="btn btn-primary btn-sm">
            </div>
        </form>
        </div>
    </div>
</div>
    <script>
        function validasi(){
            let ig = document.forms['klaimTiket']['ig'].value;
            if(!ig.includes("instagram.com/p/")){
                document.getElementById('err-ig').innerHTML = "Link bukti share twibbon tidak valid."
                // return false
            }
        }
    </script>
<?= $this->endSection() ?>