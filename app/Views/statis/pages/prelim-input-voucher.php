<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>
<div class="p-24">
    <div class="flex space-y-16 flex-col p-24 sticky top-8 z-50">
        <!-- ALERt -->
        <div class="alert alert-info" x-data="{active: true}" x-show="active" id="info">
                <div class="flex-1">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="w-6 h-6 mx-2 stroke-current">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>                          
                    </svg>
                    <?php if(sekarang() < tanggal('start_pre')) : ?>
                        <label>Waktu pengerjaan soal akan dimulai dalam</span> <span id="time" class="btn btn-xs btn-primary"></label>
                        <?php else :?>
                        <label>Waktu pengerjaan soal akan tesisa</span> <span id="time" class="btn btn-xs btn-primary"></label>
                    <?php endif?>
                </div>
                <svg
                    @click="active = false"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 cursor-pointer" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
        </div>
        <!-- FLash Data -->
        <?= $this->include('component/pesan') ?>
    </div>
    <div class="p-24 text-base-100">
        <form action="<?= base_url('/lomba/get-soal-all') ?>" method="get">
            <div class="form-control">
                <label class="label">
                    <span class="label-text  text-base-100">Kode Voucher</span>
                </label> 
                <input name="voucher" type="text" placeholder="contoh : coifhuy" class="bg-neutral-200 border border-neutral-60 focus:border-primary-100 rounded-md p-8 text-base-100 text-12">
            </div>
            <button class="btn btn-primary btn-sm mt-8">Mulai</button>
        </form>
    </div>
</div>

    <script>
<?php if(sekarang() < tanggal('start_pre')) : ?>
    let countDownDate = new Date('<?= tanggal('start_pre') ?>').getTime();
<?php else :?>
    let countDownDate = new Date('<?= tanggal('finish_pre') ?>').getTime();
<?php endif?>
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
    document.getElementById("info-time").innerHTML = "";
  }
}, 1000);
</script>
<?= $this->endSection() ?>