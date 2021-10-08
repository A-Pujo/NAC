<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>

    <?= form_open(base_url('/lomba/submit-jawaban/'.$partisipan_info->kode_voucher . '/' . $segmen)) ?>
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
                <input type="submit" name="nav" value="finish" class="btn btn-primary btn-sm">
            </div>
        </div>
    </div>

    <div class="text-base-100 px-64 pt-16 pb-96 flex flex-row items-start space-x-16">
        <!-- Start Soal -->
        <div class=" flex flex-col space-y-16 flex-grow">
            <div class="card bg-accent p-16 space-y-8 font-bold">
                <?php if($_GET['step'] == 9 || $_GET['step'] == 10 ) : ?>
                    Bagian II : Benar / Salah
                <?php else :?>
                    Bagian I : Pilihan Ganda
                <?php endif ?>
                
            </div>
            <?php $i = $_GET['step'] * 5 - 5; $max_i = $i + 5 ?>
            <?php for($i ; $i < $max_i; $i++) : ?>
    
                <div class="card bg-neutral-100 p-16 space-y-8">
                    <p><strong class="text-24"><?= $i + 1 ?></strong> <?= $daftar_soal[$i]->soal_teks ?>?</p>
                    <?php foreach($daftar_pilihan as $pilihan) : ?>
                        <?php if($pilihan->soal_id == $daftar_soal[$i]->soal_id) : ?>
                            <label class="ml-8 flex flex-row space-x-8 items-center <?= $pilihan->jawaban_kode == '' ? 'hidden' : '' ?>">
                                <input type="radio" name="jawaban[<?= $jawaban_user[$i]->jawaban_partisipan_id ?>]" class="radio radio-primary flex-shrink-0" value="<?= $pilihan->jawaban_id ?>" <?= $pilihan->jawaban_id == $jawaban_user[$i]->jawaban_id ? 'checked' : '' ?>>
                                <span class=""><?= $pilihan->jawaban_teks ?></span>
                            </label>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
                <input type="hidden" value="<?= $jawaban_user[$i]->jawaban_partisipan_id ?>" name="jawaban_user_id[]">
            <?php endfor;?>
            <!-- End Soal -->
    
            <!-- Navigasi -->
            <input type="hidden" value="<?= $_GET['step'] ?>" name="step">
            <div class="flex justify-between">
                <?php if($_GET['step'] != 1) : ?>
                    <input class="btn btn-accent" type="submit" value="prev" name="nav">
                <?php endif ?>
                <?php if($_GET['step'] != 10) : ?>
                    <input class="btn btn-accent" type="submit" value="next" name="nav">
                <?php endif ?>
            </div>
        </div>
        <div class="card bg-accent p-16  sticky top-96 z-40 hidden md:block">
            <div class="grid grid-cols-5 grid-flow-row gap-8">
                <?php for($j=0; $j<50; $j++): ?>
                <input 
                    class="btn btn-primary btn-xs h-32 w-32 <?= !$jawaban_user[$j]->jawaban_kode ? 'btn-outline' : '' ?>"
                    type="submit"
                    name="nav"
                    value="<?= $j + 1?>"
                >
                    
                <?php endfor ?>
            </div>
            <div class="mt-8 space-y-4">
                <div>
                    <span class="btn btn-primary btn-xs h-32 w-32">#</span> : Jawaban terisi
                </div>
                <div>
                    <span class="btn btn-primary btn-xs h-32 w-32 btn-outline">#</span> : Jawaban kosong
                </div>
            </div>
        </div>
    </div>
    </form>
    <script>
// === COUNT DOWN === //

// let countDownDate = new Date(2021,08,19,12,15,0,0).getTime();
let countDownDate = new Date('<?= tanggal('finish_pre') ?>').getTime();
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
  document.getElementById("time").innerHTML = hours + "h " + minutes + "m " + seconds + "s ";
    
  // If the count down is over, write some text 
  if (distance < 0) {
    clearInterval(x);
    document.getElementById("time").innerHTML = "WAKTU HABIS";
    document.getElementById("submit").innerHTML = "";
  }
}, 1000);

</script>
<?= $this->endSection() ?>