<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <title>Dashboard</title>
</head>
<body>
    <div class="flex flex-row">
        <!-- Sidebar -->
        <div class="w-300 bg-neutral-200 min-h-screen">
            <?= $this->include('dashboard/layout/sidebar') ?>
        </div>
        <!-- End of Sidebar -->
        <div class="w-full bg-neutral-100">
            <div class="h-163 w-full flex justify-between items-center p-32">
                <?= $this->include('dashboard/layout/topbar') ?> 
            </div>
            <div class="">
                <?= $this->renderSection('content')?>
            </div>
            <div class="bg-gray-500">
                <?= $this->include('dashboard/layout/footer') ?>
            </div>
        </div>
    </div>



</body>
</html>