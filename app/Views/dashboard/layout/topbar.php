<!-- Open Sidebar -->
<button 
    class="btn btn-ghost text-base-100 font-bold text-16 lg:hidden" 
    @click="sidebar = true" 
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
    </button>
<!-- Judul -->
<h1 class="text-32 font-bold text-base-100"><?= $judul ?></h1>
<!-- User Info -->
<div class="flex py-16 px-24 space-x-16 border items-center border-primary-100 rounded-md">
    <div class="flex flex-col space-y-4 items-end text-base-100">
        <span class="font-bold text-16"><?= explode(' ',userinfo()->nama)[0] ?></span>
        <span class="font-light text-14 ">
            <?php if(isInRole('umum')) :?>
                Pengguna Umum
            <?php elseif(isInRole('admin')) :?>
                Admin
            <?php elseif(isInRole('tim registrasi')) :?>
                Tim Registrasi
            <?php elseif(isInRole('tim bendahara')) :?>
                Tim Bendahara
            <?php elseif(isInRole('peserta lomba')) :?>
                Admin
            <?php endif ?>
        </span>
    </div>
    <div>
        <img class="h-48 w-48 rounded-full" src="<?php echo userinfo()->avatar ?>" alt="avatar">
    </div>
    <div class="">
        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
    </div>
</div>