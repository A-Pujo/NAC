<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
<?php
    $isError = empty(initValidation()->getErrors()) ? false : true;
    if($isError){
        // handling kalo error
        $pt = ! initValidation()->hasError('pt') ? old('pt') : '' ;
        $nama_tim = ! initValidation()->hasError('nama_tim') ? old('nama_tim') : '' ;
        $nama_ketua = ! initValidation()->hasError('nama_ketua') ? old('nama_ketua') : '' ;
        $nama_1 = ! initValidation()->hasError('nama_1') ? old('nama_1') : '' ;
        $nama_2 = ! initValidation()->hasError('nama_2') ? old('nama_2') : '' ;
        $wa = ! initValidation()->hasError('wa') ? old('wa') : '';
    } else {
        // seed awal value input
        $pt = userinfo()->pt;
        $nama_tim = userinfo()->nama_tim;
        $nama_ketua = userinfo()->nama_ketua;
        $nama_1 = userinfo()->nama_1;
        $nama_2 = userinfo()->nama_2;
        $wa = userinfo()->wa;
    }
    // print_r(initValidation()->getErrors());

    // API provinsi
    $provincies = ["Nanggroe Aceh Darussalam", "Sumatera Utara", "Sumatera Selatan", "Sumatera Barat", "Bengkulu", "Riau", "Kepulauan Riau", "Jambi", "Lampung", "Bangka Belitung", "Kalimantan Barat", "Kalimantan Timur", "Kalimantan Selatan", "Kalimantan Tengah", "Kalimantan Utara", "Banten", "DKI Jakarta", "Jawa Barat", "Jawa Tengah", "DI Yogyakarta", "Jawa timur", "Bali", "Nusa Tenggara Timur", "Nusa Tenggara Barat", "Gorontalo", "Sulawesi Barat", "Sulawesi Tengah", "Sulawesi Utara", "Sulawesi Tenggara", "Sulawesi Selatan", "Maluku Utara", "Maluku", "Papua Barat", "Papua"];

?>

    <div class="text-base-100 max-w-600 p-32">
        <h1 class="font-bold text-24">
            <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                Accounting for High School
            <?php elseif(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccUniv'): ?>
                Accounting for University
            <?php else : ?>
                Call for Paper
            <?php endif?>
        </h1>
        <div>
            <?php if(userinfo()->partisipan_aktif == 0 or userinfo()->pembayaran_aktif == 0) : ?>
                <?= form_open_multipart(base_url('/dashboard/update-pendaftaran'), ['method' => 'post']) ?>
                    <?= csrf_field() ?>

                    <div class="form-input">
                        <label> Nama
                            <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                                Sekolah
                            <?php else: ?>
                                Perguruan Tinggi
                            <?php endif?>
                        </label>
                        <div>
                            <input 
                                
                                <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                                    placeholder="contoh : SMAN 1 Muara Karang"
                                <?php else: ?>
                                    placeholder="contoh : Politeknik Keuangan Negara STAN"
                                <?php endif?>
                                
                                value="<?= $pt ?>"
                                type="text"
                                name="pt" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('pt') ?? '' ?></span>
                    </div>

                    <!-- Nama Tim -->
                    <div class="form-input">
                        <label>Nama Tim</label>
                        <div>
                            <input 
                                placeholder="contoh : Elang"
                                value="<?= $nama_tim ?>"
                                type="text"
                                name="nama_tim" />
                            <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                            </svg>
                            </i>
                        </div>
                        <input type="hidden" name="nama_tim_lama" value="<?= userinfo()->nama_tim ?>" />
                        <span><?= initValidation()->getError('nama_tim') ?? '' ?></span>
                    </div>

                    <!-- Ketua -->
                    <div class="form-input">
                        <label>Nama Ketua Tim</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $nama_ketua ?>"
                                type="text"
                                name="nama_ketua" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_ketua') ?? '' ?></span>
                    </div>

                    <!-- Anggota 1 -->
                    <div class="form-input">
                        <label>Nama Anggota 1</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $nama_1 ?>"
                                type="text"
                                name="nama_1" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_1') ?? '' ?></span>
                    </div>

                    <!-- Anggota 2 -->
                    <div class="form-input">
                        <label>Nama Anggota 2</label>
                        <div>
                            <input 
                                placeholder="contoh : Fulan Wulan"
                                value="<?= $nama_2 ?>"
                                type="text"
                                name="nama_2" />
                            <i>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('nama_2') ?? '' ?></span>
                    </div>

                    <!-- Jenis Partisipasi -->
                    <input type="hidden" name="partisipan_jenis" value="<?= userinfo()->partisipan_jenis == null ? $jenis_lomba : userinfo()->partisipan_jenis ?>"/>

                    <!-- WA -->
                    <div class="form-input">
                        <label>Whatsapp Ketua Tim</label>
                        <div>
                            <input 
                                placeholder="contoh : 0816xxxxx"
                                value="<?= $wa ?>"
                                type="text"
                                name="wa" />
                            <i>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z" clip-rule="evenodd" />
                            </svg>
                            </i>
                        </div>
                        <span><?= initValidation()->getError('wa') ?? '' ?></span>
                    </div>

                    <!-- Provinsi -->
                    <div class="form-select" x-data="{provinsi : '<?= userinfo()->provinsi == null ? 'Pilih Provinsi' : userinfo()->provinsi ?>', dropdown : false}">
                        <label>Pilih Provinsi</label>
                        <div
                            @click="dropdown = !dropdown"
                            >
                            <span x-text="provinsi"></span>
                            <i class="">
                                <svg
                                class="transition transform h-18"
                                :class="{'rotate-0': !dropdown,'rotate-180': dropdown}"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                            </i>
                        </div>
                        <div x-show="dropdown" @click.outside="dropdown = false">
                            <ul>
                                <?php foreach($provincies as $p) : ?>
                                <li @click="provinsi = '<?= $p ?>'"><?= $p ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <!-- <div class="border border-neutral-60 hover:border-primary-100 rounded-md p-8 text-base-100 text-12 mt-8">
                            <ul class="divide-y divide-primary-100 max-h-300 overflow-auto">
                                <?php foreach($provincies as $p) : ?>
                                <li @click="provinsi = '<?= $p ?>'" class="cursor-pointer p-8"><?= $p ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div> -->
                        <span><?= initValidation()->getError('provinsi') ?? '' ?></span>
                        <!-- Input data -->
                        <select name="provinsi">
                            <option x-text="provinsi"></option>
                        </select>
                    </div>

                    <!-- Abstrak -->
                    <?php if($jenis_lomba == 'CFP') : ?>
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="file_abstrak">Dokumen Abstrak</label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="file_abstrak">Upload Data</label>
                        <input type="file" id="file_abstrak" @change="files = $event.target.files" name="file_abstrak[]" multiple />
                        <input type="hidden" value="<?= userinfo()->file_abstrak ?>" name="old_file_abstrak">
                        <span><?= initValidation()->getError('file_abstrak') ?? '' ?></span>

                        <small>Abstrak berupa berkas dengan format pdf, doc atau docx</small>
                        <small>Ukuran maksimal untuk setiap file 5 Mb</small>
                        <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu file</small>
                    </div>
                    <?php endif; ?>
                    
                    <!-- SP -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="surat_pernyataan">Surat Pernyataan</label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="surat_pernyataan">Upload Data</label>
                        <input type="file" id="surat_pernyataan" @change="files = $event.target.files" name="surat_pernyataan" />
                        <input type="hidden" value="<?= userinfo()->surat_pernyataan ?>" name="old_surat_pernyataan">
                        <span><?= initValidation()->getError('surat_pernyataan') ?? '' ?></span>
                        <small>Surat Pernyataan berupa berkas dengan format pdf, doc atau docx</small>
                        <small>
                            Ukuran maksimal file 500 Kb
                        </small>
                    </div>

                    <!-- KTM -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="ktm">Foto
                            <?php if(($_GET['lomba'] ?? userinfo()->partisipan_jenis) == 'AccSMA'):?>
                                Kartu Pelajar
                            <?php else: ?>
                                KTM
                            <?php endif?>
                        </label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="ktm">Upload Data</label>
                        <input type="file" id="ktm" @change="files = $event.target.files" name="ktm[]" multiple/>
                        <input type="hidden" value="<?= userinfo()->ktm ?>" name="old_ktm">
                        <span><?= initValidation()->getError('ktm') ?? '' ?></span>
                        <small>Foto KTM berupa gambar dengan format jpg, jpeg atau png</small>
                        <small>Ukuran maksimal untuk setiap file 500 Kb</small>
                        <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu gambar</small>
                    </div>

                    <!-- Twibbon -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="twibbon">Foto Twibbon</label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="twibbon">Upload Data</label>
                        <input type="file" id="twibbon" @change="files = $event.target.files" name="twibbon[]" multiple/>
                        <input type="hidden" value="<?= userinfo()->twibbon ?>" name="old_twibbon">
                        <span><?= initValidation()->getError('twibbon') ?? '' ?></span>

                        <small>Foto Twibbon berupa gambar dengan format jpg, jpeg atau png</small>
                        <small>Ukuran maksimal untuk setiap file 500 Kb</small>
                        <small>Gunakan tombol <b>ctrl</b> untuk menyeleksi lebih dari satu gambar</small>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">submit</button>
                </form>

            <?php endif; ?>
        </div>
    </div>

<?= $this->endSection() ?>