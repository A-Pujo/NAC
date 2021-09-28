<?= $this->extend('statis/layout/main')  ?>
<?= $this->section('content') ?>

    <div class="p-24 text-base-100">
        <form action="<?= base_url('/lomba/prelim') ?>" method="get">
            <!-- <input type="text" name="kode_voucher">
            <button type="submit">join</button> -->

            <div class="form-control">
                <label class="label">
                    <span class="label-text">Kode Voucher</span>
                </label> 
                <input name="voucher" type="text" placeholder="contoh : coifhuy" class="bg-neutral-200 border border-neutral-60 focus:border-primary-100 rounded-md p-8 text-base-100 text-12">
            </div>
            <button class="btn btn-primary btn-sm mt-8">Mulai</button>
        </form>
    </div>


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