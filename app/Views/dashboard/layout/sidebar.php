<div class="sticky top-0 flex flex-col space-y-16 p-32 sidebar h-screen relative"
    :class="
        {'sidebar-expand' : sidebarExpand == true ,
        'sidebar-limit' : sidebarExpand == false }
    ">
    <span class="border-0 flex flex-nowrap justify-start items-center space-x-16">
        <span class="w-58 p-8 flex-shrink-0 bg-neutral-300 rounded-md">
            <img src="<?= base_url('img/logo.png') ?>" alt="">
        </span>
        <span 
            class="text-base-100 font-black text-24 whitespace-nowrap"
            x-show="sidebarExpand"
            >
            NAC 2021 
        </span>
    </span>

    <!-- Home  -->
    <a href="<?= base_url('/dashboard') ?>" class="<?= $halaman == 'beranda' ? 'aktif' : 'nonaktif' ?>">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
        </svg>
        <span >Beranda</span>
    </a>
    <!-- Umum -->
    <?php if(isInRole('umum') and userinfo()->nama_tim != '') : ?>
        <a href="<?= base_url('/dashboard/pendaftaran') ?>" class="<?= $halaman == 'pendaftaran' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
            <span >Pendaftaran</span>
        </a>
        <a href="<?= base_url('/dashboard/pembayaran') ?>" class="<?= $halaman == 'pembayaran' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M10 19v-5h4v5c0 .55.45 1 1 1h3c.55 0 1-.45 1-1v-7h1.7c.46 0 .68-.57.33-.87L12.67 3.6c-.38-.34-.96-.34-1.34 0l-8.36 7.53c-.34.3-.13.87.33.87H5v7c0 .55.45 1 1 1h3c.55 0 1-.45 1-1z"/></svg>
            <span >Pembayaran</span>
        </a>

    <!-- Admin -->
    <?php elseif(isInRole('admin')) : ?>
        <a href="<?= base_url('/dashboard/admin') ?>" class="<?= $halaman == 'admin' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
            <span >Team</span>
        </a>         

    <!-- Tim Registrasi -->
    <?php elseif(isInRole('tim registrasi')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pendaftaran') ?>" class="<?= $halaman == 'kelola-pendaftaran' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span >Verifikasi Pendaftaran</span>
        </a>
        <a href="<?= base_url('/dashboard/peserta_index') ?>" class="<?= $halaman == 'kelola-peserta' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
            </svg>
            <span >Daftar Pendaftaran</span>
        </a>

    <!-- Tim Bendahara -->
    <?php elseif(isInRole('tim bendahara')) : ?>
        <a href="<?= base_url('/dashboard/verifikasi-pembayaran') ?>" class="<?= $halaman == 'kelola-pembayaran' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
            <span >Verifikasi Pembayaran</span>
        </a>

    <!-- Tim Lomba -->
    <?php elseif(isInRole('tim lomba')) : ?>
        <!-- <a href="<?= base_url('/dashboard/verifikasi-lomba') ?>" class="<?= $halaman == 'kelola-pembayaran' ? 'aktif' : 'nonaktif' ?>">
            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#FCFEFF"><path d="M0 0h24v24H0V0z" fill="none"/><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z"/></svg>
            <span >Verifikasi Abstrak</span>
        </a> -->

    <!-- Peserta Lomba -->

    <?php elseif(isInRole('peserta lomba')) : ?>
        <a href="<?= base_url('/lomba/generate-voucher') ?>" class="link">Generate Voucher Lomba</a>
    <?php endif; ?>
    
    <!-- Logout -->
        <a href="<?= base_url('/auth/logout') ?>" class="nonaktif">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform rotate-180" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 102 0V4a1 1 0 00-1-1zm10.293 9.293a1 1 0 001.414 1.414l3-3a1 1 0 000-1.414l-3-3a1 1 0 10-1.414 1.414L14.586 9H7a1 1 0 100 2h7.586l-1.293 1.293z" clip-rule="evenodd" />
            </svg>
            <span >Logout</span>
        </a> 
        
        

        <!-- BUTTON -->
        <div class="absolute bottom-32 right-32">
            <!-- Btn Show -->
            <button 
            class="btn btn-primary text-base-100 text-14 font-bold lg:hidden" 
            @click="sidebar = false"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </button>
            <!-- Btn Expand -->
            <button 
                class="btn btn-primary text-base-100 text-14 font-bold hidden lg:inline-block " 
                @click="sidebarExpand = !sidebarExpand"
                :class="
                    {'rotate-0' : sidebarExpand == true ,
                    'rotate-180' : sidebarExpand == false }
                "
            >
                <svg 
                    :class="
                        {'rotate-0' : sidebarExpand == true ,
                        'rotate-180' : sidebarExpand == false }
                    "
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 transform transition" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M15.707 15.707a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 010 1.414zm-6 0a1 1 0 01-1.414 0l-5-5a1 1 0 010-1.414l5-5a1 1 0 011.414 1.414L5.414 10l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
            </button> 
        </div>
    </div>