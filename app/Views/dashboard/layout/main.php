<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> 
    <title>JUDUL</title>
</head>
<body>
    <div class="flex flex-row">
        <div class="bg-green-500 min-h-screen items-stretch">
            <?= $this->include('dashboard/layout/sidebar') ?>
        </div>
        <div class="w-full bg-gray-200">
            <div class="bg-blue-500">
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