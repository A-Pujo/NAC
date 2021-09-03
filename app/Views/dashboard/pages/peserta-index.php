<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="p-32">
        <table id="tabel" class="tabel">
            <thead>
                <tr>
                    <th>Nama Tim</th>
                    <th>Nama Perguruan Tinggi</th>
                    <th>Nama Ketua</th>
                    <th>Nama Anggota 1</th>
                    <th>Nama Anggota 2</th>
                    <th>Jenis Lomba</th>
                    <th>Whatsapp</th>
                    <th>Tanggal Pendaftaran</th>
                    <th>Update Pendaftaran</th>
                    <th>Nama Bank</th>
                    <th>Nama Nasabah</th>
                    <th>Nomor Rekening</th>
                    <th>Jumlah Transfer</th>
                    <th>Tanggal Pemabayaran</th>
                    <th>Update Pembayaran</th>
                    <th>Status Pendaftaran</th>
                    <th>Status Pembayaran</th>
                </tr>
            </thead>
            <tbody>

                <?php foreach($data_peserta as $peserta) : 
                        if($peserta->nama_bank != ' '):
                    ?>
                <tr>
                    <td><?= $peserta->nama_tim ?></td>
                    <td><?= $peserta->pt ?></td>
                    <td><?= $peserta->nama_ketua ?></td>
                    <td><?= $peserta->nama_1 ?></td>
                    <td><?= $peserta->nama_2 ?></td>
                    <td><?= $peserta->partisipan_jenis ?></td>
                    <td><?= $peserta->wa ?></td>
                    <td><?= $peserta->partisipan_dibuat ?></td>
                    <td><?= $peserta->partisipan_diupdate ?></td>
                    <td><?= $peserta->nama_bank ?></td>
                    <td><?= $peserta->nama_nasabah ?></td>
                    <td><?= $peserta->nomor_rekening ?></td>
                    <td><?= $peserta->jumlah_transfer ?></td>
                    <td><?= $peserta->pembayaran_dibuat ?></td>
                    <td><?= $peserta->pembayaran_diupdate ?></td>
                    <td>
                        <?php if($peserta->partisipan_aktif == 1) : ?>
                            <span class="verif-sukses"> Terverifikasi <span>
                        <?php else: ?>
                            <span class="verif-gagal"> Belum Terverifikasi <span>
                        <?php endif ?>
                    </td>
                    <td>
                        <?php if($peserta->pembayaran_aktif == 1) : ?>
                            <span class="verif-sukses"> Terverifikasi <span>
                        <?php else: ?>
                            <span class="verif-gagal"> Belum Terverifikasi <span>
                        <?php endif ?>
                    </td>
                </tr>
                <?php endif;
                endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <?= $this->include('dashboard/layout/datatables') ?>
<?= $this->endSection() ?>