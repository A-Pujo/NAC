<?php  $model = new App\Models\M_Webinar ?>


<div class="space-y-16">
  <?php for($i = 1 ; $i< 4; $i++) : ?>
    <div class="card bg-neutral-200 p-16">
      Webinar #<?= $i ?>
    </div>
    <div class="w-full stats border border-primary-100 grid-flow-row md:grid-flow-col">
      <div class="stat bg-neutral-300 text-base-100">
        <div class="stat-figure text-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
        </svg>
        </div> 
        <div class="stat-title">STAN</div> 
        <div class="stat-value"><?= $model->countStan('webinar_'.$i) ?></div> 
        <div class="stat-desc">Pendaftar mahasiswa PKN STAN</div>
      </div> 
      <div class="stat bg-neutral-300 text-base-100">
        <div class="stat-figure text-secondary">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
        </svg>
        </div> 
        <div class="stat-title">Non PKN STAN</div> 
        <div class="stat-value"><?= $model->countNonStan('webinar_'.$i) ?></div> 
        <div class="stat-desc">Pendaftar non mahasiswa PKN STAN</div>
      </div> 
      <div class="stat bg-neutral-300 text-base-100">
        <div class="stat-figure text-secondary">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
          </svg>
        </div> 
        <div class="stat-title">Absen</div> 
        <div class="stat-value"><?= $model->countAbsen('webinar_'.$i) ?></div> 
        <div class="stat-desc text-error"><a href="<?= base_url('dashboard/regis-webinar?page=verif-webinar-'.$i) ?>"><?= $model->countVerifAbsen('webinar_'.$i) ?> butuh verifikasi</a></div>
      </div>
    </div>
  <?php endfor ?>
</div>
  