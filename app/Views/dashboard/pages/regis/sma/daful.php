<?php
    $pesertas = new \App\Models\M_Data_Main_Round();
    $pesertas = $pesertas->getDataSMA();
?>
<table class="tabel" id="tabel">
<thead>
        <tr>
            <th>No</th>
            <th>Email</th>
            <th>Nama Tim</th>
            <th>Sekolah</th>
            <th>Alamat Sekolah</th>
            <th>Nama Ketua</th>
            <th>NIS Ketua</th>
            <th>TTL Ketua</th>
            <th>Jurusan Ketua</th>
            <th>Kelas Ketua</th>
            <th>WA Ketua</th>
            <th>Alamat Ketua</th>
            <th>Email Ketua</th>
            <th>Nama Anggota 1</th>
            <th>NIS Anggota 1</th>
            <th>TTL Anggota 1</th>
            <th>Jurusan Anggota 1</th>
            <th>Kelas Anggota 1</th>
            <th>WA Anggota 1</th>
            <th>Alamat Anggota 1</th>
            <th>Email Anggota 1</th>
            <th>Nama Anggota 2</th>
            <th>NIS Anggota 2</th>
            <th>TTL Anggota 2</th>
            <th>Jurusan Anggota 2</th>
            <th>Kelas Anggota 2</th>
            <th>WA Anggota 2</th>
            <th>Alamat Anggota 2</th>
            <th>Email Anggota 2</th>
            <th>Pertanyaan 1</th>
            <th>Pertanyaan 2</th>
            <th>Pertanyaan 3</th>
            <th>Pertanyaan 4</th>
        </tr>
    </thead>
    <tbody>
        <?php $no=1 ?>
        <?php foreach($pesertas as $peserta) : ?>
        <tr>
            <td><?= $no++ ?> </td>
            <td><?= $peserta->email ?></td>
            <td><?= $peserta->nama_tim ?></td>
            <td><?= $peserta->instansi ?></td>
            <td><?= $peserta->alamat_instansi ?></td>
            <td><?= $peserta->nama_ketua ?></td>
            <td><?= $peserta->nis_nim_ketua ?></td>
            <td><?= $peserta->ttl_ketua ?></td>
            <td><?= $peserta->jurusan_ketua ?></td>
            <td><?= $peserta->kelas_semester_ketua ?></td>
            <td><?= $peserta->wa_ketua ?></td>
            <td><?= $peserta->alamat_ketua ?></td>
            <td><?= $peserta->email_ketua ?></td>
            <td><?= $peserta->nama_1 ?></td>
            <td><?= $peserta->nis_nim_1 ?></td>
            <td><?= $peserta->ttl_1 ?></td>
            <td><?= $peserta->jurusan_1 ?></td>
            <td><?= $peserta->kelas_semester_1 ?></td>
            <td><?= $peserta->wa_1 ?></td>
            <td><?= $peserta->alamat_1 ?></td>
            <td><?= $peserta->email_1 ?></td>
            <td><?= $peserta->nama_2 ?></td>
            <td><?= $peserta->nis_nim_2 ?></td>
            <td><?= $peserta->ttl_2 ?></td>
            <td><?= $peserta->jurusan_2 ?></td>
            <td><?= $peserta->kelas_semester_2 ?></td>
            <td><?= $peserta->wa_2 ?></td>
            <td><?= $peserta->alamat_2 ?></td>
            <td><?= $peserta->email_2 ?></td>
            <td><?= $peserta->kuisioner_1 ?></td>
            <td><?= $peserta->kuisioner_2 ?></td>
            <td><?= $peserta->kuisioner_3 ?></td>
            <td><?= $peserta->kuisioner_4 ?></td>
        </tr>
        <?php endforeach ?>
    </tbody>
</table>
