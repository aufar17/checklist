<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm rounded">
            <div class="card-header py-3 bg-danger border-bottom">
                <div class="d-flex flex-column align-items-start">
                    <div class="d-flex align-items-center"> {{ $slot }}
                        <i class="fa-solid fa-file-invoice fs-4 me-2 text-white me-3"></i>
                        <h5 class="mb-0 fw-bold text-white">{{ now()->translatedFormat('F') }} Checksheet
                        </h5>
                    </div>
                </div>
            </div>
            <div class="card-body p-2">
                <form class="px-4 py-3" action="{{ route('checksheet-post') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">TANGGAL
                                    PEMERIKSAAN</label>
                                <input type="date" class="form-control" id="exampleInputDate" value="{{
                                    now()->format('Y-m-d') }}" name="tanggal-pemeriksaan" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">WAKTU
                                    PEMERIKSAAN</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" value="{{
                                    now()->format('H:i') }}" name="waktu-pemeriksaan" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="selectPemeriksa" class="form-label">PEMERIKSA</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp" value="{{ $name }}"
                                    name="pemeriksa" readonly>
                            </div>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="dokumentasi" class="form-label">Bukti Pemeriksaan</label>
                                <div class="input-group">
                                    <input type="file" class="form-control d-none" name="documentation" id="dokumentasi"
                                        accept="image/*" required onchange="previewImage(event)">
                                    <button type="button" class="btn btn-primary"
                                        onclick="document.getElementById('dokumentasi').click()">
                                        <i class="fa fa-camera"></i> Ambil Gambar
                                    </button>
                                </div>
                                <div class="mt-3">
                                    <img id="preview" src="" class="img-thumbnail d-none" style="max-width: 200px;">
                                </div>
                            </div>

                        </div>
                    </div>



                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Kondisi Box Hydrant</h5>
                    </div>

                    <div class="row mt-2">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">POSISI</label>



                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioposisi2"
                                        name="values[posisi]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioposisi2">Tidak
                                        Terhalang</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioposisi1"
                                        name="values[posisi]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioposisi1">Terhalang</label>
                                </div>
                                <textarea name="notes[posisi]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">PINTU</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopintu2"
                                        name="values[pintu]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiopintu2">Bagus</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopintu1"
                                        name="values[pintu]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiopintu1">Rusak</label>
                                </div>
                                <textarea name="notes[pintu]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>

                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">IDENTITAS HYDRANT</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioidentitas1"
                                        name="values[identitas]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioidentitas1">Ada</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioidentitas2"
                                        name="values[identitas]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioidentitas2">Tidak Ada</label>
                                </div>
                                <textarea name="notes[identitas]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Selang</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputjumlahselang1" class="form-label">JUMLAH</label>
                                <input type="number" class="form-control" aria-describedby="emailHelp"
                                    name="values[jumlah-selang]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisiselang2"
                                        name="values[kondisi-selang]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisiselang2">Bagus</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisiselang1"
                                        name="values[kondisi-selang]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisiselang1">Bocor</label>
                                </div>
                                <textarea name="notes[kondisi-selang]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>


                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">COUPLING</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingselang1"
                                        name="values[coupling-selang]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiocouplingselang1">Bagus</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingselang2"
                                        name="values[coupling-selang]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiocouplingselang2">Rusak</label>
                                </div>
                                <textarea name="notes[coupling-selang]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Nozle</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">JUMLAH</label>
                                <input type="number" class="form-control" aria-describedby="emailHelp"
                                    name="values[jumlah-nozle]">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">SEAL</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioseal2"
                                        name="values[seal-nozle]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioseal2">Bagus</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioseal1"
                                        name="values[seal-nozle]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radioseal1">Rusak</label>
                                </div>
                                <textarea name="notes[seal-nozle]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>


                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">BODY</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiobody2"
                                        name="values[body-nozle]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiobody2">Bagus</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiobody1"
                                        name="values[body-nozle]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiobody1">Rusak</label>
                                </div>
                                <textarea name="notes[body-nozle]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">COUPLING</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingnozle1"
                                        name="values[coupling-nozle]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiocouplingnozle1">Bagus</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingnozle2"
                                        name="values[coupling-nozle]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiocouplingnozle2">Rusak</label>
                                </div>
                                <textarea name="notes[coupling-nozle]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Kran</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">JUMLAH</label>
                                <input type="number" class="form-control" aria-describedby="emailHelp"
                                    name="values[jumlah-kran]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikran2"
                                        name="values[kondisi-kran]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisikran2">Bagus</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikran1"
                                        name="values[kondisi-kran]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisikran1">Bocor/Rembes</label>
                                </div>
                                <textarea name="notes[kondisi-kran]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>


                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Kunci Pembuka Kran</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">JUMLAH</label>
                                <input type="number" class="form-control" aria-describedby="emailHelp"
                                    name="values[jumlah-kunci]">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikunci2"
                                        name="values[kondisi-kunci]" value=1 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisikunci2">Bagus</label>
                                </div>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikunci1"
                                        name="values[kondisi-kunci]" value=0 onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radiokondisikunci1">Rusak</label>
                                </div>
                                <textarea name="notes[kondisi-kunci]" class="form-control mt-2 notes-field"
                                    style="display: none;" placeholder="Tambahkan catatan..."></textarea>


                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                                <h5 class="text-white">Manipold</h5>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">KONDISI</label>
                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisimanipold2" name="values[kondisi-manipold]" value=1
                                                onchange="toggleNotes(this)">
                                            <label class="form-check-label" for="radiokondisimanipold2">Bagus</label>
                                        </div>
                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisimanipold1" name="values[kondisi-manipold]" value=0
                                                onchange="toggleNotes(this)">
                                            <label class="form-check-label"
                                                for="radiokondisimanipold1">Bocor/Rusak</label>
                                        </div>
                                        <textarea name="notes[kondisi-manipold]" class="form-control mt-2 notes-field"
                                            style="display: none;" placeholder="Tambahkan catatan..."></textarea>


                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                                <h5 class="text-white">Segel Pemeriksaan</h5>
                            </div>
                            <div class="row mt-2">
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <label class="form-label">KONDISI</label>
                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisisegel1" name="values[kondisi-segel]" value=1
                                                onchange="toggleNotes(this)">
                                            <label class="form-check-label" for="radiokondisisegel1">Ada</label>
                                        </div>

                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisisegel2" name="values[kondisi-segel]" value=0
                                                onchange="toggleNotes(this)">
                                            <label class="form-check-label" for="radiokondisisegel2">Tidak Ada</label>
                                        </div>
                                        <textarea name="notes[kondisi-segel]" class="form-control mt-2 notes-field"
                                            style="display: none;" placeholder="Tambahkan catatan..."></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{ $hydrantid }}
                    <input hidden type="number" name="status" value=1>
                    <button type="submit" class="btn btn-danger mt-2">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>

<script>
    function previewImage(event) {
        var reader = new FileReader();
        reader.onload = function() {
            var output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
    
</script>

<script>
    function toggleNotes(radio) {
        var parentDiv = radio.closest('.mb-3');  
        var notesField = parentDiv.querySelector('.notes-field'); 

        if (radio.value === "0") {
            notesField.style.display = "block"; 
        } else {
            notesField.style.display = "none";  
            notesField.value = ""; 
        }
    }
</script>