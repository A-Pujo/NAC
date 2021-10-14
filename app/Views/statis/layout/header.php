<div class="flex flex-row justify-between bg-neutral-100 text-base-100 px-24 py-16">
    <a href="<?=base_url() ?>" class="font-black text-3xl">
        <img src="<?= base_url('img/logo.png') ?>" alt="" class="w-58 p-8 bg-neutral-300 rounded-md">
    </a>
    <div class="hidden md:inline-block">
        <ul class="flex flex-row space-x-2">
            <li><a href="<?= base_url() ?>"class="btn btn-ghost">Home</a></li>
            <li><a href="<?= base_url('guide') ?>" class="btn btn-ghost">Panduan</a></li>
            <li><a href="<?= base_url('pengumuman') ?>" class="btn btn-ghost">Pengumuman</a></li>
            <li><a href="<?= base_url('webinar') ?>" class="btn btn-ghost">webinar</a></li>
            <li><a href="<?= base_url('dashboard') ?>" class="btn btn-primary">Dashboard</a></li>
        </ul>
    </div>
    <button class="relative btn btn-primary inline-block md:hidden"
    x-data="{NavbarPhone : false}"
    >
        <svg
        @click=" NavbarPhone = ! NavbarPhone"
        xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd" />
        </svg>
        <div 
            class="absolute right-0 top-96 z-50"
            x-show="NavbarPhone"
            @click.outside="NavbarPhone = false"
        >
            <div class="rounded-md bg-neutral-100 py-32 px-40">
                <ul class="text-base-100 text-16 space-y-16 flex flex-col items-center">
                    <li class="btn btn-primary btn-ghost whitespace-nowrap"><a href="<?= base_url() ?>">Home</a></li>
                    <li class="btn btn-primary btn-ghost whitespace-nowrap"><a href="<?= base_url('/guide') ?>">Panduan</a></li>
                    <li class="btn btn-primary btn-ghost whitespace-nowrap"><a href="<?= base_url('/pengumuman') ?>">Pengumuman</a></li>
                    <li class="btn btn-primary btn-ghost whitespace-nowrap"><a href="<?= base_url('/webinar') ?>">webinar</a></li>
                    <li class="btn btn-primary btn-ghost whitespace-nowrap"><a href="<?= base_url('/dashboard') ?>">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </button>
</div>