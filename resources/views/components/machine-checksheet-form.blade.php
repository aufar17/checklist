@props([
'groups' => collect(),
'user' => null,
'machineData' => [],
'groupedItems' => []
])

<div class="row mt-4">
    <div class="col-12">
        <div class="card shadow-sm rounded">
            <div class="card-header py-3 bg-danger border-bottom">
                <div class="d-flex align-items-center">
                    {{ $slot }}
                    <i class="fa-solid fa-file-invoice fs-4 me-2 text-white me-3"></i>
                    <h5 class="mb-0 fw-bold text-white">
                        {{ now()->translatedFormat('F') }} Checksheet
                    </h5>
                </div>
            </div>

            <div class="card-body p-2">
                <form class="px-4 py-3" action="{{ route('checksheet-machine-post') }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    {{-- Tanggal & Waktu --}}
                    <div class="row">
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">TANGGAL PEMERIKSAAN</label>
                                <input type="date" class="form-control" name="tanggal-pemeriksaan"
                                    value="{{ now()->format('Y-m-d') }}" readonly>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="mb-3">
                                <label class="form-label">WAKTU PEMERIKSAAN</label>
                                <input type="text" class="form-control" name="waktu-pemeriksaan"
                                    value="{{ now()->format('H:i') }}" readonly>
                            </div>
                        </div>
                    </div>

                    {{-- Pemeriksa --}}
                    <div class="row mt-2">
                        <div class="col-12">
                            <div class="mb-3">
                                <label class="form-label">PEMERIKSA</label>
                                <input type="text" class="form-control" name="pemeriksa"
                                    value="{{ strtoupper($user->name) }}" readonly>
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

                    {{-- Grouped Items --}}
                    @foreach ($groups as $group)
                    <div class="bg-secondary px-3 py-2 mt-4 mb-3 rounded">
                        <h5 class="text-white text-uppercase">{{ $group->desc }}</h5>
                    </div>

                    <div class="row mt-2">
                        @if (isset($groupedItems[$group->id]))
                        @foreach ($groupedItems[$group->id] as $item)
                        @if (!empty($item->instruction))
                        @php
                        $slug = $item->slug;
                        $standard = trim($item->standard);
                        $isNumeric = preg_match('/\d+(\.\d+)?\s*\w*/', $standard);
                        $isKebersihan = str_contains(strtolower($standard), 'bersih');
                        $useRadio = $standard !== '4-6bar(kg/cm2)/0,4-0,6 Mpa';

                        // Define options
                        $options = $isKebersihan
                        ? [
                        '3' => ['symbol' => 'O', 'desc' => 'Bersih / Level Ok'],
                        '2' => ['symbol' => 'Δ', 'desc' => 'Cukup bersih / kurang dari level sudah diisi'],
                        '1' => ['symbol' => 'X', 'desc' => 'Kurang bersih / kurang dari level belum diisi'],
                        ]
                        : [
                        '4' => ['symbol' => 'O', 'desc' => 'OK'],
                        '3' => ['symbol' => 'Δ', 'desc' => 'Ada masalah sudah Lapor Maintenance'],
                        '2' => ['symbol' => '▲', 'desc' => 'Ada masalah belum Lapor Maintenance'],
                        '1' => ['symbol' => 'X', 'desc' => 'Ada masalah mesin tidak bisa beroperasi'],
                        ];
                        @endphp

                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">
                                    {{ strtoupper($item->instruction) }}
                                    <i class="fa-solid fa-circle-question text-info ms-1 fs-6" data-bs-toggle="tooltip"
                                        data-bs-placement="right" title="Standard: {{ $standard }}"></i>
                                </label>

                                @if ($useRadio)
                                @foreach ($options as $index => $opt)
                                <div class="form-check d-flex align-items-center mb-1">
                                    <input type="radio" class="form-check-input border-dark me-2"
                                        id="radio{{ $item->id }}{{ $index }}" name="values[{{ $slug }}]"
                                        value="{{ $index }}">
                                    <label class="form-check-label" for="radio{{ $item->id }}{{ $index }}">
                                        <strong>{{ $opt['symbol'] }}</strong> — {{ $opt['desc'] }}
                                    </label>
                                </div>
                                @endforeach
                                @else
                                @if ($isNumeric)
                                <input type="number" step="0.01" class="form-control" name="values[{{ $slug }}]"
                                    placeholder="Tekanan angin">
                                @else
                                <input type="text" class="form-control" name="values[{{ $slug }}]"
                                    placeholder="Tekanan angin">
                                @endif
                                @endif

                                <small class="text-muted">Standard: {{ $standard }}</small>
                            </div>
                        </div>
                        @endif
                        @endforeach
                        @endif
                    </div>
                    @endforeach

                    <input type="hidden" name="machine_id" value="{{ $machineData['id'] ?? '' }}">
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-danger mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Preview & Tooltip Script --}}
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

    document.addEventListener('DOMContentLoaded', function () {
        const tooltips = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        tooltips.forEach(function (el) {
            new bootstrap.Tooltip(el);
        });
    });
</script>