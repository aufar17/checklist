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
                <form class="px-4 py-3">
                    @csrf
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">TANGGAL
                                    PEMERIKSAAN</label>
                                <input type="date" class="form-control" id="exampleInputDate"
                                    value="{{ now()->format('Y-m-d') }}" name="tanggal-pemeriksaan" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">WAKTU
                                    PEMERIKSAAN</label>
                                <input type="text" class="form-control" aria-describedby="emailHelp"
                                    value="{{ now()->format('H:i') }}" name="waktu-pemeriksaan" readonly>
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
                                <label for="" class="form-label">
                                    BUKTI PEMERIKSAAN
                                    <span class="mx-1" data-bs-toggle="tooltip" data-bs-placement="right"
                                        title="Kamera wajib timestamp">
                                        <i class="fa-solid fa-circle-info text-danger"></i>
                                    </span>

                                </label>

                                <input type="file" class="form-control" name="dokumentasi" id="dokumentasi"
                                    accept="image/*" capture="user">
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
                                    <input type="radio" class="form-check-input border-dark" id="radioposisi1"
                                        name="posisi">
                                    <label class="form-check-label" for="radioposisi1">Terhalang</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioposisi2"
                                        name="posisi">
                                    <label class="form-check-label" for="radioposisi2">Tidak
                                        Terhalang</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">PINTU</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopintu1"
                                        name="pintu">
                                    <label class="form-check-label" for="radiopintu1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopintu2"
                                        name="pintu">
                                    <label class="form-check-label" for="radiopintu2">Tidak Rusak</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">IDENTITAS HYDRANT</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioidentitas1"
                                        name="identitas">
                                    <label class="form-check-label" for="radioidentitas1">Ada</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioidentitas2"
                                        name="identitas">
                                    <label class="form-check-label" for="radioidentitas2">Tidak Ada</label>
                                </div>
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
                                    name="jumlah-selang">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">PANJANG</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopanjang-selang1"
                                        name="panjang-selang">
                                    <label class="form-check-label" for="radiopanjang-selang1">Ada</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopanjang-selang2"
                                        name="panjang-selang">
                                    <label class="form-check-label" for="radiopanjang-selang2">Tidak
                                        Ada</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisiselang1"
                                        name="kondisi-selang">
                                    <label class="form-check-label" for="radiokondisiselang1">Bocor</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisiselang2"
                                        name="kondisi-selang">
                                    <label class="form-check-label" for="radiokondisiselang2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">COUPLING</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingselang1"
                                        name="coupling-selang">
                                    <label class="form-check-label" for="radiocouplingselang1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingselang2"
                                        name="coupling-selang">
                                    <label class="form-check-label" for="radiocouplingselang2">Tidak</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white">Nozle</h5>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">JUMLAH</label>
                                <input type="number" class="form-control" aria-describedby="emailHelp"
                                    name="jumlah-nozle">
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">PANJANG</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopanjangnozle1"
                                        name="panjang-nozle">
                                    <label class="form-check-label" for="radiopanjangnozle1">Ada</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiopanjangnozle2"
                                        name="panjang-nozle">
                                    <label class="form-check-label" for="radiopanjangnozle2">Tidak
                                        Ada</label>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">SEAL</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioseal1"
                                        name="seal">
                                    <label class="form-check-label" for="radioseal1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radioseal2"
                                        name="seal">
                                    <label class="form-check-label" for="radioseal2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">BODY</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiobody1"
                                        name="body">
                                    <label class="form-check-label" for="radiobody1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiobody2"
                                        name="body">
                                    <label class="form-check-label" for="radiobody2">Tidak</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label class="form-label">COUPLING</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingnozle1"
                                        name="coupling-nozle">
                                    <label class="form-check-label" for="radiocouplingnozle1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiocouplingnozle2"
                                        name="coupling-nozle">
                                    <label class="form-check-label" for="radiocouplingnozle2">Tidak</label>
                                </div>
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
                                    name="jumlah-kran">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikran1"
                                        name="kondisi-kran">
                                    <label class="form-check-label" for="radiokondisikran1">Bocor/Rembes</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikran2"
                                        name="kondisi-kran">
                                    <label class="form-check-label" for="radiokondisikran2">Tidak</label>
                                </div>
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
                                    name="jumlah-kunci">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label class="form-label">KONDISI</label>
                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikunci1"
                                        name="kondisi-kunci">
                                    <label class="form-check-label" for="radiokondisikunci1">Rusak</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radiokondisikunci2"
                                        name="kondisi-kunci">
                                    <label class="form-check-label" for="radiokondisikunci2">Tidak</label>
                                </div>
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
                                                id="radiokondisimanipold1" name="kondisi-manipold">
                                            <label class="form-check-label"
                                                for="radiokondisimanipold1">Bocor/Rusak</label>
                                        </div>

                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisimanipold2" name="kondisi-manipold">
                                            <label class="form-check-label" for="radiokondisimanipold2">Tidak</label>
                                        </div>
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
                                                id="radiokondisisegel1" name="kondisi-segel">
                                            <label class="form-check-label" for="radiokondisisegel1">Ada</label>
                                        </div>

                                        <div class="form-check mx-1">
                                            <input type="radio" class="form-check-input border-dark"
                                                id="radiokondisisegel2" name="kondisi-segel">
                                            <label class="form-check-label" for="radiokondisisegel2">Tidak Ada</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-danger mt-2">Submit</button>
                </form>
            </div>

        </div>
    </div>
</div>