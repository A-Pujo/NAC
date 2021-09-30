<?= $this->extend('dashboard/layout/main')  ?>

<?= $this->section('content') ?>
<?= form_open('kursus/submit-jawaban/'.$kuis, ['method' => 'post']) ?>
    <div class="p-32  flex flex-col space-y-16 text-base-100 max-w-1000">
    
            <?php $no_pilgan = 1 ?>
            <?php foreach($soal as $s) : ?>
    
            <div class="card bg-neutral-100 p-16 space-y-8">
                <p><strong class="text-24"><?= $no_pilgan++ ?></strong> <?= $s->soal_teks ?></p>
                <input type="hidden" name="soal[<?= $s->soal_id ?>]" value="<?= $s->soal_id ?>" />
                
                <?php foreach($pilihan as $p) : ?>
                    <?php if($p->soal_id == $s->soal_id) : ?>
                        <label class="ml-8 flex flex-row space-x-8 items-center <?= $p->jawaban_teks == ''? 'hidden': '' ?>">
                            <input class="radio radio-primary flex-shrink-0" type="radio"
                                name="jawaban[<?= $s->soal_id ?>]"
                                value="<?= $p->jawaban_id ?>"
                                <?= $p->jawaban_teks == ''? 'checked': '' ?>
                                />
                            <span class=""><?= $p->jawaban_teks ?></span> 
                        </label>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <?php endforeach;?>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
<?= $this->endSection() ?>























        <input type="submit" value="submit">
    </form>
</body>
</html>