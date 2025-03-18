@props([
'groups' => collect(),
'user' => null,
'machineData' => [],
])

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm rounded">
            <div class="card-header py-3 bg-danger border-bottom">
                <div class="d-flex flex-column align-items-start">
                    <div class="d-flex align-items-center">
                        {{ $slot }}
                        <i class="fa-solid fa-file-invoice fs-4 me-2 text-white me-3"></i>
                        <h5 class="mb-0 fw-bold text-white">
                            {{ now()->translatedFormat('F') }} Checksheet
                        </h5>
                    </div>
                </div>
            </div>

            <div class="card-body p-2">
                <form class="px-4 py-3" action="{{ route('checksheet-post') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Tanggal dan Waktu Pemeriksaan --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">TANGGAL PEMERIKSAAN</label>
                                <input type="date" class="form-control" value="{{ now()->format('Y-m-d') }}"
                                    name="tanggal-pemeriksaan" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">WAKTU PEMERIKSAAN</label>
                                <input type="text" class="form-control" value="{{ now()->format('H:i') }}"
                                    name="waktu-pemeriksaan" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Pemeriksa --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">PEMERIKSA</label>
                                <input type="text" class="form-control" value="{{ strtoupper($user->name) }}"
                                    name="pemeriksa" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Dokumentasi --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">BUKTI PEMERIKSAAN</label>
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

                    @foreach ($groups as $group)
                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white text-uppercase">{{ $group->desc }}</h5>
                    </div>

                    <div class="row mt-2">
                        @foreach ($group->machineItems as $item)
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">{{ strtoupper($item->instruction) }}</label>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radio{{ $item->id }}1"
                                        name="values[{{ $item->slug ?? $item->id }}]" value="1"
                                        onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radio{{ $item->id }}1">Bagus</label>
                                </div>

                                <div class="form-check mx-1">
                                    <input type="radio" class="form-check-input border-dark" id="radio{{ $item->id }}0"
                                        name="values[{{ $item->slug ?? $item->id }}]" value="0"
                                        onchange="toggleNotes(this)">
                                    <label class="form-check-label" for="radio{{ $item->id }}0">Rusak</label>
                                </div>

                                <textarea name="notes[{{ $item->slug ?? $item->id }}]"
                                    class="form-control mt-2 notes-field" style="display: none;"
                                    placeholder="Tambahkan catatan..."></textarea>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    @endforeach

                    {{-- Hidden Fields & Submit --}}
                    <input type="hidden" name="machine_id" value="{{ $machineData['id'] ?? '' }}">
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-danger mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Script Preview Gambar --}}
<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function () {
            const output = document.getElementById('preview');
            output.src = reader.result;
            output.classList.remove('d-none');
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

{{-- Script Toggle Catatan --}}
<script>
    function toggleNotes(radio) {
        const parentDiv = radio.closest('.mb-3');
        const notesField = parentDiv.querySelector('.notes-field');

        if (radio.value === "0") {
            notesField.style.display = "block";
        } else {
            notesField.style.display = "none";
            notesField.value = "";
        }
    }
</script>