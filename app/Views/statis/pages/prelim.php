<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="px-64 pt-16 sticky top-0 z-50">
        <div class="card font-bold bg-accent text-base-100 p-16 flex space-x-16 flex-row justify-between items-center">
            <div class="mr-auto">
                <span><?= $daftar_lomba[$partisipan_info->partisipan_jenis] ?></span>
                <span>| <?= $partisipan_info->nama_tim ?></span>
                <span>| Bagian <?= $segmen ?></span>
            </div>
            <div class="flex flex-row items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                </svg>
                <span id="time"></span>
            </div>
            <div id="submit">
                <button class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
    <?= form_open(base_url('/lomba/submit-jawaban/'.$partisipan_info->kode_voucher . '/' . $segmen)) ?>
        <div class="text-base-100 px-64 py-16 flex flex-col space-y-16 max-w-1000">
            <!-- Start Pilgan -->
            <div class="card bg-accent p-16 space-y-8 font-bold">
                Bagian I : Pilihan Ganda
            </div>
            <?php $no_pilgan = 1 ?>
            <?php for($i=0 ; $i < 3; $i++) : ?>

                <div class="card bg-neutral-100 p-16 space-y-8">
                    <p><strong class="text-24"><?= $no_pilgan++ ?></strong> <?= $daftar_soal[$i]->soal_teks ?>?</p><input type="hidden" name="soal[]" value="<?= $daftar_soal[$i]->soal_id ?>">
                    <?php foreach($daftar_pilihan as $pilihan) : ?>
                        <?php if($pilihan->soal_id == $daftar_soal[$i]->soal_id) : ?>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="jawaban[<?=$daftar_soal[$i]->soal_id?>]" class="radio radio-primary flex-shrink-0" value="<?= $pilihan->jawaban_id ?>" <?= $pilihan->jawaban_kode == null ? 'checked' : '' ?>>
                                <span class=""><?= $pilihan->jawaban_teks ?></span>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endfor;?>
            <!-- End Pilgan -->
            <!-- Start B/S -->
            <div class="card bg-accent p-16 space-y-8 font-bold">
                Bagian II : Benar Salah
            </div>
            <?php $no_bs = 1?>
            <?php for($i=$i; $i < 5; $i++) : ?>
                <div class="card bg-neutral-100 p-16 space-y-8">
                    <p><strong class="text-24"><?= $no_pilgan++ ?></strong> <?= $daftar_soal[$i]->soal_teks ?>?</p><input type="hidden" name="soal[]" value="<?= $daftar_soal[$i]->soal_id ?>">
                    <?php foreach($daftar_pilihan as $pilihan) : ?>
                        <?php if($pilihan->soal_id == $daftar_soal[$i]->soal_id) : ?>
                            <label class="ml-8 flex flex-row space-x-8 items-center">
                                <input type="radio" name="jawaban[<?=$daftar_soal[$i]->soal_id?>]" class="radio radio-primary flex-shrink-0" value="<?= $pilihan->jawaban_id ?>" <?= $pilihan->jawaban_kode == null ? 'checked' : '' ?>>
                                <span class=""><?= $pilihan->jawaban_teks ?></span>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endfor ?>
            <!-- End B/S -->
        </div>
        <button class="btn btn-primary" type="submit">Submit</button>
    </form>
    <script>
// Set target : bulan 0-11
let countDownDate = new Date(2021,08,19,12,15,0,0).getTime();
// Adjustment time
let serverTime = <?= time()*1000 ?>;
let now = new Date().getTime();
let diff = serverTime - now;


// Update the count down every 1 second
let x = setInterval(function() {

  // Get today's date and time
  let now = new Date().getTime() + diff;
  
    
  // Find the distance between now and the count down date
  let distance = countDownDate - now;
    
  // Time calculations for days, hours, minutes and seconds
  let days = Math.floor(distance / (1000 * 60 * 60 * 24));
  let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
  let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
  let seconds = Math.floor((distance % (1000 * 60)) / 1000);
    
  // Output the result in an element with id="time"
  document.getElementById("time").innerHTML = hours + "h "
  + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "WAKTU HABIS";
    document.getElementById("submit").innerHTML = "";
  }
}, 1000);

</script>
<?= $this->endSection() ?>