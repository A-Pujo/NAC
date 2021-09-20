<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php print_r(initValidation()->getErrors()) ?>
    <?= form_open_multipart(base_url('kursus/registrasi'), ['method' => 'post']) ?>
        <label>Nama Peserta</label>
        <input type="text" name="nama_peserta" value="<?=(! empty($peserta->nama_peserta)) ? $peserta->nama_peserta : '' ?>"/>
        <label>Nama Sekolah</label>
        <input type="text" name="nama_sekolah" value="<?=(! empty($peserta->nama_sekolah)) ? $peserta->nama_sekolah : '' ?>">
        <label>Bukti Kartu Pelajar</label>
        <input type="file" name="kartu_pelajar">
        <input type="hidden" name="old_kartu_pelajar" value="<?=(! empty($peserta->kartu_pelajar)) ? $peserta->kartu_pelajar : '' ?>">
        <input type="submit" value="aih">
    </form>
</body>
</html>