<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="text-base-100 max-w-600 p-32">
        <div>
            <?= form_open_multipart(base_url('/main-round/submit-kuisioner'), ['method' => 'post']) ?>
                <?= csrf_field() ?>

                <input type="hidden" name="id_peserta_mr" value="<?= user_main_round()->id_peserta_mr ?>">

                <div class="form-input">
                    <div>
                        <div class="card bg-neutral-100 p-16 space-y-8">
                            <p>1. Apakah Peserta dapat berkumpul saat pelaksanaan Main Round (18-23 Oktober 2021) dengan tetap mematuhi protokol kesehatan?</p>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="kuisioner_1" class="radio radio-primary flex-shrink-0" value="1" checked>
                                <span class="">Ya</span>
                                <input type="radio" name="kuisioner_1" class="radio radio-primary flex-shrink-0" value="0">
                                <span class="">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-input">
                    <div>
                        <div class="card bg-neutral-100 p-16 space-y-8">
                            <p>2. Apakah Peserta bersedia mengikuti seluruh rangkaian acara National Accounting Challenge 2021?</p>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="kuisioner_2" class="radio radio-primary flex-shrink-0" value="1" checked>
                                <span class="">Ya</span>
                                <input type="radio" name="kuisioner_2" class="radio radio-primary flex-shrink-0" value="0">
                                <span class="">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-input">
                    <div>
                        <div class="card bg-neutral-100 p-16 space-y-8">
                            <p>3. Apakah Peserta bersedia mematuhi peraturan dan tata tertib selama perlombaan berlangsung?</p>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="kuisioner_3" class="radio radio-primary flex-shrink-0" value="1" checked>
                                <span class="">Ya</span>
                                <input type="radio" name="kuisioner_3" class="radio radio-primary flex-shrink-0" value="0">
                                <span class="">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-input">
                    <div>
                        <div class="card bg-neutral-100 p-16 space-y-8">
                            <p>4. Apakah Peserta bersedia untuk menjunjung tinggi integritas dan berkompetisi secara sehat?</p>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="kuisioner_4" class="radio radio-primary flex-shrink-0" value="1" checked>
                                <span class="">Ya</span>
                                <input type="radio" name="kuisioner_4" class="radio radio-primary flex-shrink-0" value="0">
                                <span class="">Tidak</span>
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-block btn-primary">submit</button>
            </form>
        </div>
    </div>

<?= $this->endSection() ?>

<div class="text-base-100 px-64 pt-16 pb-96 flex flex-row items-start space-x-16">
    <div class=" flex flex-col space-y-16 flex-grow">
        <!-- Start Soal -->
            
        </div>
    </div>
</div>