<?= $this->extend('dashboard/layout/main')  ?>
<?= $this->section('content') ?>
    <div class="text-base-100 max-w-600 p-32">
        <h1 class="font-bold text-24">
            Unggah Full Paper
        </h1>
        <div>
                <?= form_open_multipart(base_url('/dashboard/upload-paper'), ['method' => 'post']) ?>
                    <?= csrf_field() ?>

                    <!-- SP -->
                    <div class="form-upload" x-data="{files : ''}">
                        <label for="file_paper">Upload Full Paper</label>
                        <div x-show="files">
                            <!-- Loop the image -->
                            <template x-for="file in files" x-if="files">
                                <div>
                                    <img :src="URL.createObjectURL(file)">
                                    <div>
                                        <span x-text="file.name"></span>
                                        <span x-text="file.size / 1000 + ' Kb'"></span>
                                    </div> 
                                </div>
                            </template>
                        </div>
                        <label for="file_paper">Upload Data</label>
                        <input type="file" id="file_paper" @change="files = $event.target.files" name="file_paper[]" multiple/>
                        <input type="hidden" name="old_file_paper" value="<?= userinfo()->file_paper ?>">
                        <span><?= initValidation()->getError('file_paper') ?? '' ?></span>
                        <small>Full paper berupa berkas dengan format pdf, doc atau docx</small>
                        <small>
                            Ukuran maksimal file 10000 Kb
                        </small>
                    </div>

                    <button type="submit" class="btn btn-block btn-primary">submit</button>
                </form>
        </div>
    </div>

<?= $this->endSection() ?>