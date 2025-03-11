<!--
=========================================================
* Soft UI Dashboard - v1.0.3
=========================================================

* Product Page: https://www.creative-tim.com/product/soft-ui-dashboard
* Copyright 2021 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)

* Coded by Creative Tim

=========================================================
    
* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<x-head></x-head>
<style>
    .img-container {
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 20px 0;
    }

    .img-container img {
        width: 900px;
        max-width: 100%;
        height: auto;
    }

    #startScanner {
        border-radius: 50%;
        padding: 20px;
        width: 75px;
        height: 75px;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@php
$notifBadge = 0;

if ($user->golongan == 4) {
if ($user->acting == 1) {
$notifBadge = $hydrants->where('latest_status', 2)->count();
} elseif ($user->acting == 2) {
$notifBadge = $hydrants->where('latest_status', 1)->count();
}
}
@endphp


<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar :notifBadge="$notifBadge"></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>
            @slot('title')
            Dashboard
            @endslot
            @slot('role')
            {{ $user->name }}
            @endslot

        </x-navbar>
        <div class="container-fluid py-4">
            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-1" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show mt-1" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
            <x-kpi>
                @slot('amount')
                {{ $hydrants->count() }}
                @endslot
            </x-kpi>


            @if ($user->golongan == 3 && $user->acting == 1)
            <div class="img-container">
                <img src="{{ asset('img/bg-dashboard.gif') }}" alt="Dashboard Image">
            </div>
            <div class="row">
                <div class="col-12 text-center d-flex justify-content-center align-items-center">
                    <button class="btn btn-danger mt-0 shadow-lg" id="startScanner">
                        <i class="fa-solid fa-qrcode"></i>
                    </button>
                </div>
                <div class="col-12 text-center d-flex justify-content-center align-items-center mb-5">
                    <span class="fw-bold">SCAN HERE!</span>
                </div>
            </div>
            <form id="scan-form" method="POST" action="{{ route('scan-process') }}">
                @csrf
                <input type="hidden" name="qrcode_data" id="qrcode_data">
            </form>
            @endif

            @if ($user->golongan == 4 && $user->acting == 1)
            <x-card class="mt-5">
                @slot('title')
                Validasi Inspeksi
                @endslot
                @slot('body')
                <table id="example" class="table table-striped table-bordered text-center table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Hydrant</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hydrants as $hydrant)
                        @php
                        $statusList = [
                        0 => ['text' => 'Belum Inspeksi', 'class' => 'text-bg-warning'],
                        1 => ['text' => 'Dibuat', 'class' => 'text-bg-success'],
                        2 => ['text' => 'Approved by SPV', 'class' => 'text-bg-success'],
                        3 => ['text' => 'Approved by Manager', 'class' => 'text-bg-success'],
                        4 => ['text' => 'Rejected by SPV', 'class' => 'text-bg-danger'],
                        5 => ['text' => 'Rejected by Manager', 'class' => 'text-bg-danger'],
                        ];
                        $status = $statusList[$hydrant->latest_status] ?? ['text' => 'Tidak Diketahui', 'class' =>
                        'text-bg-secondary'];
                        @endphp

                        @if ($hydrant->latest_status == 2)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $hydrant->no_hydrant }}</td>
                            <td class="text-center">{{ $hydrant->location }}</td>
                            <td class="text-center">{{ $hydrant->type }}</td>
                            <td class="text-center">
                                <button class="badge {{ $status['class'] }} p-1 px-2 border-0 fw-bold fs-7 tracking-btn"
                                    data-bs-toggle="modal" data-bs-target="#trackingModal-{{ $hydrant->id }}">
                                    <span class="text-white fw-bold">{{ $status['text'] }}</span>
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('detail-hydrant', ['id' => $hydrant->id]) }}"
                                    class="btn btn-info btn-sm p-2 border-0 rounded">
                                    <i class="fa-solid fa-circle-info fs-6"></i>
                                </a>
                            </td>
                        </tr>
                        @endif

                        <!-- Modal Tracking Status -->
                        <div class="modal fade" id="trackingModal-{{ $hydrant->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title fw-bold text-white">Validasi Inspeksi</h5>
                                        <button type="button" class="btn-close btn-close-light"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @php
                                            $inspection = $hydrant->inspectionHydrants->first();
                                            $createdBy = $inspection->created_by ?? 'Belum dibuat';
                                            $createdDate = $inspection->created_date ?? '';
                                            $knownBy = $inspection->known_by ?? 'Belum diketahui';
                                            $knownDate = $inspection->known_date ?? '';
                                            $checkedBy = $inspection->checked_by ?? 'Belum diperiksa';
                                            $checkedDate = $inspection->checked_date ?? '';
                                            $rejectionNote = $inspection->rejection_note ?? null;
                                            $isRejected = in_array($hydrant->latest_status, [4, 5]);
                                            @endphp

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-danger me-3"><i
                                                            class="fas fa-file-alt"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIBUAT</h6>
                                                        <small class="text-muted">{{ $createdBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $createdDate }}</small>
                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-warning me-3"><i
                                                            class="fas fa-eye"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIKETAHUI</h6>
                                                        <small class="text-muted">{{ $knownBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $knownDate }}</small>
                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-success me-3"><i
                                                            class="fas fa-check-circle"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIPERIKSA</h6>
                                                        <small class="text-muted">{{ $checkedBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $checkedDate }}</small>
                                            </li>

                                            @if ($hydrant->status == 4 || $hydrant->status == 5)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-dark me-3"><i
                                                            class="fas fa-times-circle"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DITOLAK</h6>
                                                        <small class="text-white">
                                                            @if ($hydrant->status == 4)
                                                            Ditolak oleh SPV
                                                            @else
                                                            Ditolak oleh Manager
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                                @if ($rejectionNote)
                                                <small class="fw-bold">Alasan: {{ $rejectionNote }}</small>
                                                @endif
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">Tidak ada data hydrant tersedia</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>


                @endslot
            </x-card>
            @endif

            @if ($user->golongan == 4 && $user->acting == 2)
            <x-card class="mt-5">
                @slot('title')
                Validasi Inspeksi
                @endslot
                @slot('body')
                <table id="example" class="table table-striped table-bordered text-center table-hover">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Kode Hydrant</th>
                            <th class="text-center">Lokasi</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($hydrants as $hydrant)
                        @php
                        $statusList = [
                        0 => ['text' => 'Belum Inspeksi', 'class' => 'text-bg-warning'],
                        1 => ['text' => 'Dibuat', 'class' => 'text-bg-success'],
                        2 => ['text' => 'Approved by SPV', 'class' => 'text-bg-success'],
                        3 => ['text' => 'Approved by Manager', 'class' => 'text-bg-success'],
                        4 => ['text' => 'Rejected by SPV', 'class' => 'text-bg-danger'],
                        5 => ['text' => 'Rejected by Manager', 'class' => 'text-bg-danger'],
                        ];

                        $status = $statusList[$hydrant->latest_status] ?? ['text' => 'Tidak Diketahui', 'class' =>
                        'text-bg-secondary'];
                        @endphp
                        @if ($hydrant->latest_status == 1)

                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $hydrant->no_hydrant }}</td>
                            <td class="text-center">{{ $hydrant->location }}</td>
                            <td class="text-center">{{ $hydrant->type }}</td>
                            <td class="text-center">
                                <button class="badge {{ $status['class'] }} p-1 px-2 border-0 fw-bold fs-7 tracking-btn"
                                    data-bs-toggle="modal" data-bs-target="#trackingModal-{{ $hydrant->id }}">
                                    <span class="text-white fw-bold">{{ $status['text'] }}</span>
                                </button>
                            </td>
                            <td>
                                <a href="{{ route('detail-hydrant',['id'=>$hydrant->id]) }}"
                                    class="btn btn-info btn-sm p-2 border-0 rounded">
                                    <i class="fa-solid fa-circle-info fs-6"></i>
                                </a>
                            </td>
                        </tr>
                        @endif

                        <!-- Modal untuk tracking status -->
                        <div class="modal fade" id="trackingModal-{{ $hydrant->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger">
                                        <h5 class="modal-title fw-bold text-white">Validasi Inspeksi</h5>
                                        <button type="button" class="btn-close btn-close-light"
                                            data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @php
                                            $inspection = $hydrant->inspectionHydrants->first();
                                            $createdBy = $inspection->created_by ?? 'Belum dibuat';
                                            $createdDate = $inspection->created_date ?? '';
                                            $knownBy = $inspection->known_by ?? 'Belum diketahui';
                                            $knownDate = $inspection->known_date ?? '';
                                            $checkedBy = $inspection->checked_by ?? 'Belum diperiksa';
                                            $checkedDate = $inspection->checked_date ?? '';
                                            $rejectionNote = $inspection->rejection_note ?? null;
                                            $isRejected = in_array($hydrant->latest_status, [4, 5]);
                                            @endphp

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-danger me-3"><i
                                                            class="fas fa-file-alt"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIBUAT</h6>
                                                        <small class="text-muted">{{ $createdBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $createdDate }}</small>
                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-warning me-3"><i
                                                            class="fas fa-eye"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIKETAHUI</h6>
                                                        <small class="text-muted">{{ $knownBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $knownDate }}</small>
                                            </li>

                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-success me-3"><i
                                                            class="fas fa-check-circle"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DIPERIKSA</h6>
                                                        <small class="text-muted">{{ $checkedBy }}</small>
                                                    </div>
                                                </div>
                                                <small class="text-muted">{{ $checkedDate }}</small>
                                            </li>

                                            @if ($hydrant->status == 4 || $hydrant->status == 5)
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                                                <div class="d-flex align-items-center">
                                                    <span class="badge bg-dark me-3"><i
                                                            class="fas fa-times-circle"></i></span>
                                                    <div>
                                                        <h6 class="mb-0">DITOLAK</h6>
                                                        <small class="text-white">
                                                            @if ($hydrant->status == 4)
                                                            Ditolak oleh SPV
                                                            @else
                                                            Ditolak oleh Manager
                                                            @endif
                                                        </small>
                                                    </div>
                                                </div>
                                                @if ($rejectionNote)
                                                <small class="fw-bold">Alasan: {{ $rejectionNote }}</small>
                                                @endif
                                            </li>
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </tbody>
                </table>
                @endslot
            </x-card>
            @endif

            <x-footer></x-footer>
        </div>
    </main>

    <div class="modal fade" id="scanModal" tabindex="-1" aria-labelledby="scanModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Akses Kamera dan Lokasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Pastikan kamera dan GPS Anda diaktifkan sebelum memulai pemindaian.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-info" id="confirmScan">Aktifkan</button>
                </div>
            </div>
        </div>
    </div>




    <!--   Core JS Files   -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/curve-chart.js') }}"></script>
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="js/data-table.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script>
        document.getElementById("startScanner").addEventListener("click", function () {
            var scanModal = new bootstrap.Modal(document.getElementById("scanModal"));
            scanModal.show();
        });

        document.getElementById("confirmScan").addEventListener("click", function () {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    function (position) {
                        let lat = position.coords.latitude;
                        let lon = position.coords.longitude;
                        window.location.href = "{{ route('scan') }}?lat=" + lat + "&lon=" + lon;
                    },
                    function () {
                        alert("Harap aktifkan GPS untuk melanjutkan pemindaian.");
                    }
                );
            } else {
                alert("Perangkat ini tidak mendukung geolokasi.");
            }
        });
    </script>


</body>

</html>