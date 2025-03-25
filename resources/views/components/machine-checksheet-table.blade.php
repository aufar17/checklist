@props(['user','machines', 'machine_items', 'inspections','daysInMonth','imagePaths'])

<style>
    table,
    th,
    td {
        border: 1px solid black !important;
        border-collapse: collapse;
    }

    th,
    td {
        font-size: 16px;
        padding: 4px;
        text-align: center;
    }

    .header {
        font-weight: bold;
        background-color: #e0e0e0;
    }
</style>


<div class="row mb-3">
    <div class="col-md-7 text-start">
        <h4>Dept. Production Engineering</h4>
    </div>
</div>

<div class="row align-items-stretch mb-3">
    <div class="col-md-7 d-flex flex-column justify-content-start">
        <div class="text-center bg-secondary py-1 mb-2">
            <h2 class="text-white mb-0">DAILY CHECK MESIN</h2>
        </div>

        <div class="row mb-2">
            <div class="col"><strong>Bulan:</strong> {{ \Carbon\Carbon::now()->translatedFormat('F Y') }}</div>
            <div class="col offset-4"><strong>No Mesin:</strong> {{ $machines->no_machine }}</div>
        </div>
        <div class="row mb-2">
            <div class="col"><strong>Line:</strong> {{ $machines->line }}</div>
            <div class="col offset-4"><strong>Maker:</strong> {{ $machines->maker }}</div>
        </div>
        <div class="row">
            <div class="col"><strong>Mesin:</strong> {{ $machines->name }}</div>
            <div class="col offset-4"><strong>No Fixed Asset:</strong> {{ $machines->no_fixed_asset }}</div>
        </div>
    </div>

    <div class="col-md-5 d-flex align-items-stretch">
        <div class="table-responsive w-100">
            <table class="w-100 h-100" style="border: 1px solid #000;">
                <tr class="header" style="background-color: #e0e0e0;">
                    <td colspan="3" style="text-align: center;">MAINTENANCE</td>
                    <td colspan="6" style="text-align: center;">PRODUKSI</td>
                </tr>
                <tr style="height: 100px;">
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                    <td colspan="3"></td>
                </tr>
                <tr>
                    <td colspan="3" style="text-align: center;">PIC</td>
                    <td colspan="3" style="text-align: center;">Supervisor</td>
                    <td colspan="3" style="text-align: center;">Foreman</td>
                </tr>
            </table>
        </div>
    </div>
</div>




<div class="table-responsive overflow-x-auto">
    <table class="table table-striped table-hover" style="width: 100%;">
        <thead>
            @php
            use Carbon\Carbon;
            $currentDate = Carbon::now();
            $daysInMonth = $currentDate->daysInMonth;
            @endphp
            <tr class="header">
                <th rowspan="2">No</th>
                <th rowspan="2">Bagian</th>
                <th rowspan="2">Instruksi Kerja</th>
                <th rowspan="2">Standard</th>
                <th colspan="{{ $daysInMonth }}" style="border-bottom: 1px solid black;">Tanggal</th>
            </tr>
            <tr class="header">
                @for ($i = 1; $i <= $daysInMonth; $i++) <th>{{ $i }}</th>
                    @endfor
            </tr>
        </thead>
        <tbody>
            @php
            $valueMap = [4 => 'O', 3 => 'Δ', 2 => '▲', 1 => 'X'];
            $colorMap = ['O' => 'black', 'Δ' => 'black', '▲' => 'black', 'X' => 'black'];
            @endphp

            @foreach ($machine_items as $item)
            <tr>
                <td data-label="No">{{ $loop->iteration }}</td>
                <td data-label="Bagian">{{ $item->machineGroups->desc ?? '-' }}</td>
                <td data-label="Instruksi Kerja">{{ $item->instruction }}</td>
                <td data-label="Standard">{{ $item->standard }}</td>

                @for ($i = 1; $i <= $daysInMonth; $i++) @php $key=$item->id . '_' . $i;
                    $inspection = $inspections->get($key);
                    $symbol = '';
                    $color = '';

                    if ($inspection) {
                    $rawValue = $inspection->value;
                    $symbol = $valueMap[$rawValue] ?? $rawValue;
                    $color = $colorMap[$symbol] ?? 'black';
                    }
                    @endphp
                    <td style="color: {{ $color }};" data-label="Tanggal {{ $i }}">{{ $symbol }}</td>
                    @endfor
            </tr>
            @endforeach

            @foreach (['PIC Maintenance', 'Line Guide', 'Foreman Produksi'] as $roleIndex => $roleName)
            <tr>
                <td colspan="4" style="font-weight: bold;" data-label="Petugas">
                    Dicek Setiap (Shift 2) Oleh {{ $roleName }}
                </td>

                @for ($i = 1; $i <= $daysInMonth; $i++) <td data-label="Tanggal {{ $i }}" class="text-center">
                    @php
                    $user = $user ?? Auth::user();
                    $userGolongan = $user->golongan ?? null;
                    $userActing = $user->acting ?? null;
                    $isValidated = false;
                    $operatorInspected = false;
                    $inspectionDate = null;
                    $previousValidated = false;

                    foreach ($machine_items as $item) {
                    $key = $item->id . '_' . $i;

                    if (isset($inspections[$key])) {
                    $inspection = $inspections[$key];
                    $operatorInspected = true;

                    $isValidated = match ($roleIndex) {
                    0 => !empty($inspection->pic_maintenance),
                    1 => !empty($inspection->line_guide),
                    2 => !empty($inspection->foreman_produksi),
                    default => false,
                    };

                    $inspectionDate = match ($roleIndex) {
                    0 => optional($inspection->pic_maintenance_date)->format('d-m-Y'),
                    1 => optional($inspection->line_guide_date)->format('d-m-Y'),
                    2 => optional($inspection->foreman_produksi_date)->format('d-m-Y'),
                    default => null,
                    };

                    if ($roleIndex == 0) {
                    $previousValidated = true;
                    } elseif ($roleIndex == 1) {
                    $previousValidated = !empty($inspection->pic_maintenance);
                    } elseif ($roleIndex == 2) {
                    $previousValidated = !empty($inspection->line_guide);
                    }

                    break;
                    }
                    }

                    $showButton = $previousValidated && match ($roleIndex) {
                    0 => ($userGolongan == 3 && $userActing == 1),
                    1 => ($userGolongan == 4 && $userActing == 2),
                    2 => ($userGolongan == 4 && $userActing == 1),
                    default => false,
                    };
                    @endphp

                    @if ($isValidated)
                    <span class="text-success fw-bold">✅</span>
                    @elseif ($showButton && $operatorInspected)
                    <button type="button" class="btn btn-sm badge bg-success" data-bs-toggle="modal"
                        data-bs-target="#inspectionModal-{{ $roleIndex }}-{{ $i }}">
                        Check
                    </button>

                    <!-- Modal Validasi -->
                    <div class="modal fade" id="inspectionModal-{{ $roleIndex }}-{{ $i }}" tabindex="-1"
                        aria-labelledby="modalLabel-{{ $roleIndex }}-{{ $i }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="modalLabel-{{ $roleIndex }}-{{ $i }}">
                                        Inspeksi <strong class="text-danger">{{ $inspectionDate ?? 'Belum Diinspeksi'
                                            }}</strong> - {{ $roleName }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-start">
                                    <span>Validasi inspeksi hari ini?</span>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Tutup</button>
                                    <form action="{{ route('check') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="role_index" value="{{ $roleIndex ?? '' }}">
                                        <input type="hidden" name="tanggal" value="{{ $i }}">
                                        <input type="hidden" name="machine_id" value="{{ $machines->id }}">

                                        <button type="submit" class="btn btn-primary" onclick="disableButton(this)">
                                            Validasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    </td>
                    @endfor
            </tr>
            @endforeach




        </tbody>
    </table>
</div>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="bg-secondary py-2 px-3 mb-2">
            <h4 class="text-white mb-0">Gambar</h4>
        </div>

        <div class="border p-3 mb-4">
            <div class="d-flex flex-wrap gap-3">
                @foreach ($imagePaths as $path)
                <img src="{{ asset($path) }}" alt="Gambar" style="max-width: 200px; height: auto;">
                @endforeach
            </div>
        </div>
    </div>
</div>



<!-- Bagian Keterangan -->
<div class="row align-items-stretch mb-3">
    <div class="col-md-8 d-flex flex-column justify-content-start">
        <div class="row text-start bg-secondary py-1 mb-2">
            <h6 class="col text-white mb-0">Keterangan</h6>
            <h6 class="col text-white mb-0 offset-1">Keterangan Kebersihan</h6>
        </div>

        <div class="row mb-2">
            <div class="col"><strong>O = </strong> OK </div>
            <div class="col offset-1"><strong>O = </strong>Bersih/Level Ok</div>
        </div>
        <div class="row mb-2">
            <div class="col"><strong>Δ = </strong>Ada masalah belum Lapor Maintenance ( Mesin bisa Operasi)</div>
            <div class="col offset-1"><strong>Δ = </strong>Cukup bersih/kurang dari level sudah diisi</div>
        </div>
        <div class="row mb-2">
            <div class="col"><strong>▲ = </strong>Ada masalah sudah Lapor Maintenance ( Mesin bisa Operasi)</div>
            <div class="col offset-1"><strong>X = </strong>Kurang bersih/kurang dari level belum diisi</div>
        </div>
        <div class="row">
            <div class="col"><strong>X = </strong>Ada masalah mesin tidak bisa beroperasi</div>
        </div>
    </div>
    <div class="col-md-4 d-flex flex-column justify-content-start">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item</th>
                        <th>Reason</th>
                        <th>Date</th>
                        <th>Done By</th>
                    </tr>
                </thead>
                <tbd>
                    @for ($i = 1; $i <= 8 ; $i++) <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        </tr>
                        @endfor
                </tbd>
            </table>
        </div>
    </div>
</div>

<script>
    function disableButton(button) {
        button.disabled = true;
        button.innerHTML = 'Memproses...';
        button.form.submit();
    }
</script>