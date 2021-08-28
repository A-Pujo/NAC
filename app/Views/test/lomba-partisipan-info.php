<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= print_r($partisipan_info) ?>
    <br>
    Lagi lomba <b><?= $daftar_lomba[$partisipan_info->kode_lomba] ?></b>
    <br>
    <a href="<?=base_url('/lomba/percobaan-lomba/'.$kode_voucher)?>">Coba</a>
</body>
</html>