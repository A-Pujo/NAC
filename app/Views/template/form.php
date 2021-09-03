<div class="p-32 bg-gray-900 w-560 space-y-8">
            <!-- Input -->
            <div class="form-input">
                <label>Nama Tim</label>
                <div>
                    <input 
                        placeholder="contoh : PKN STAN"
                        value="<?= old('nama_tim') ?? userinfo()->nama_tim ?>"
                        type="text"
                        name="nama_tim" />
                    <i>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z" />
                        </svg>
                    </i>
                </div>
                <span><?= initValidation()->getError('nama_tim') ?? '' ?></span>
            </div>
            <!-- Upload File -->
            <div class="form-upload" x-data="{files : ''}">
                <label for="ktm">Foto KTM</label>
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
                <label for="ktm">Upload Data</label>
                <input type="file" id="ktm" @change="files = $event.target.files" multiple>
                <span>Error Display</span>
            </div>
            <!-- Select -->
            <div class="form-select" x-data="{lomba : 'Pilih Jenis Lomba', dropdown : false}">
                <label>Pilih Jenis Lomba</label>
                <div
                    @click="dropdown = !dropdown"
                    >
                    <span x-text="lomba"></span>
                    <i class="">
                        <svg
                        class="transition transform h-18"
                        :class="{'rotate-0': !dropdown,'rotate-180': dropdown}"
                        xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M24 24H0V0h24v24z" fill="none" opacity=".87"/><path d="M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6-1.41-1.41z"/></svg>
                    </i>
                </div>
                <div x-show="dropdown" @click.outside="dropdown = false">
                    <ul>
                        <li @click="lomba = 'Accounting SMA'">Accounting SMA</li>
                        <li @click="lomba = 'Accounting Universitas'">Accounting Universitas</li>
                    </ul>
                </div>
                <span><?= initValidation()->getError('partisipan_jenis') ?? '' ?></span>
                <!-- Input data -->
                <select name="partisipan_jenis">
                    <option x-text="lomba == 'Accounting SMA' ? 'AccSMA' : (lomba == 'Accounting Universitas' ? 'AccUniv' : '') "></option>
                </select>
            </div> 

        </div>