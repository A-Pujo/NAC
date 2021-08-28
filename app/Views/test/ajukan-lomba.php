<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?= print_r(userinfo()) ?>
    <br>
    <br>
    <table>
        <thead>
            <tr>
                <th>Lomba</th>
                <th>Voucher Partisipan</th>
                <th>Sisa Percobaan</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($data_partisipan as $data) : ?>
            <tr>
                <td><?= $daftar_lomba[$data->kode_lomba] ?></td>
                <td><?= $data->kode_voucher ?></td>
                <td><?= $data->percobaan ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <form action="<?= base_url('/lomba/starting-page/') ?>" name="form-join-lomba">
        <input type="text" name="kode_voucher">
        <button type="submit">join</button>
    </form>
</body>
</html>