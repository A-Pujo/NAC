<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('css/style.css')?>">
    <title>Document</title>
</head>
<body>
    <?= $this->include('statis/layout/header') ?>
    <?= $this->renderSection('content') ?>
    <?= $this->include('statis/layout/footer') ?>
</body>
</html>