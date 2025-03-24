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
        width: 65px;
        height: 65px;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
</style>

@php
$notifBadge = 0;

@endphp


<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar :notifBadge="$notifBadge" :user="auth()->user()" />
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
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row mt-4">
                <div class="col-md-12">
                    <x-card>
                        @slot('title')
                        Machine Table
                        @endslot
                        @slot('body')
                        <div class="row align-items-center">
                            <div class="col-md-1 col-sm-6 mb-2">
                                <a href="{{ route('new-machine') }}" class="btn btn-success btn-sm w-100">
                                    <i class="fa-solid fa-plus me-2"></i>New
                                </a>
                            </div>
                            <div class="col-md-1 col-sm-6 mb-2">
                                <div class="dropdown w-100">
                                    <button class="btn btn-primary btn-sm dropdown-toggle w-100" type="button"
                                        data-bs-toggle="dropdown">
                                        Export
                                    </button>
                                    <ul class="dropdown-menu w-100">
                                        <li>
                                            <button class="dropdown-item" id="btn-pdf">
                                                <i class="fa-solid fa-file-pdf text-danger"></i> PDF
                                            </button>
                                        </li>
                                        <li>
                                            <button class="dropdown-item" id="btn-excel">
                                                <i class="fa-solid fa-file-excel text-success"></i> Excel
                                            </button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="table-responsive">

                                <table id="example" class="table table-striped table-bordered text-center table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">No</th>
                                            <th class="text-center">No Mesin</th>
                                            <th class="text-center">Nama</th>
                                            <th class="text-center">Line</th>
                                            <th class="text-center">Maker</th>
                                            <th class="text-center">No Fixed Asset</th>
                                            <th class="text-center">Check</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-center">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($machines as $machine)
                                        <!-- Modal Validasi Inspeksi -->
                                        <div class="modal fade" id="trackingModal-{{ $machine->id }}" tabindex="-1"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-danger">
                                                        <h5 class="modal-title fw-bold text-white">Validasi Inspeksi
                                                        </h5>
                                                        <button type="button" class="btn-close btn-close-light"
                                                            data-bs-dismiss="modal"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        @php
                                                        $inspection = $machine->inspectionMachines->first();
                                                        $statuses = [
                                                        [
                                                        'label' => 'DIBUAT',
                                                        'user' => $inspection->created_by ?? 'Belum dibuat',
                                                        'date' => $inspection->created_date ?? '',
                                                        'badge' => 'danger',
                                                        'icon' => 'file-alt',
                                                        ],
                                                        [
                                                        'label' => 'DIKETAHUI',
                                                        'user' => $inspection->known_by ?? 'Belum diketahui',
                                                        'date' => $inspection->known_date ?? '',
                                                        'badge' => 'warning',
                                                        'icon' => 'eye',
                                                        ],
                                                        [
                                                        'label' => 'DIPERIKSA',
                                                        'user' => $inspection->checked_by ?? 'Belum diperiksa',
                                                        'date' => $inspection->checked_date ?? '',
                                                        'badge' => 'success',
                                                        'icon' => 'check-circle',
                                                        ],
                                                        ];

                                                        $isRejected = in_array($machine->latest_status, [-1, -2, -3]);
                                                        @endphp

                                                        <ul class="list-group">
                                                            @foreach ($statuses as $status)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-{{ $status['badge'] }} me-3">
                                                                        <i class="fas fa-{{ $status['icon'] }}"></i>
                                                                    </span>
                                                                    <div>
                                                                        <h6 class="mb-0">{{ $status['label'] }}</h6>
                                                                        <small class="text-muted">{{ $status['user']
                                                                            }}</small>
                                                                    </div>
                                                                </div>
                                                                <small class="text-muted">{{ $status['date'] }}</small>
                                                            </li>
                                                            @endforeach

                                                            @if ($isRejected)
                                                            <li
                                                                class="list-group-item d-flex justify-content-between align-items-center bg-danger text-white">
                                                                <div class="d-flex align-items-center">
                                                                    <span class="badge bg-dark me-3">
                                                                        <i class="fas fa-times-circle"></i>
                                                                    </span>
                                                                    <div>
                                                                        <h6 class="mb-0">DITOLAK</h6>
                                                                        <small>
                                                                            @switch($machine->latest_status)
                                                                            @case(-1) Ditolak oleh PIC @break
                                                                            @case(-2) Ditolak oleh SPV @break
                                                                            @case(-3) Ditolak oleh Foreman @break
                                                                            @default Ditolak
                                                                            @endswitch
                                                                        </small>
                                                                    </div>
                                                                </div>
                                                                @if ($inspection && $inspection->rejection_note)
                                                                <small class="fw-bold">Alasan: {{
                                                                    $inspection->rejection_note }}</small>
                                                                @endif
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Modal Konfirmasi Hapus -->
                                        <div class="modal fade" id="deleteModal{{ $machine->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $machine->id }}" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $machine->id }}">
                                                            Konfirmasi Hapus</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        Apakah yakin ingin menghapus mesin <strong
                                                            class="text-danger">{{ $machine->no_machine }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('delete-machine') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="id" value="{{ $machine->id }}">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Cancel</button>
                                                            <button type="submit" class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Table Row -->
                                        <tr>
                                            <td class="text-center">{{ $loop->iteration }}</td>
                                            <td class="text-center">{{ $machine->no_machine }}</td>
                                            <td class="text-center">{{ $machine->name }}</td>
                                            <td class="text-center">{{ $machine->line }}</td>
                                            <td class="text-center">{{ $machine->maker }}</td>
                                            <td class="text-center">{{ $machine->no_fixed_asset }}</td>
                                            <td class="text-center">
                                                @php
                                                $status = $statusList[$machine->id] ?? 0;
                                                @endphp

                                                @switch($status)
                                                @case(0)
                                                <span class="badge bg-secondary">Belum Inspeksi</span>
                                                @break
                                                @case(1)
                                                <span class="badge bg-info">Operator sudah inspeksi</span>
                                                @break
                                                @case(2)
                                                <span class="badge bg-primary">Checked PIC</span>
                                                @break
                                                @case(3)
                                                <span class="badge bg-warning">Checked Line Guide</span>
                                                @break
                                                @case(4)
                                                <span class="badge bg-success">Checked Foreman</span>
                                                @break
                                                @endswitch
                                            </td>
                                            <td class="text-center">
                                                {!! $machine->statusBadge() !!}
                                            </td>
                                            <td class="text-center">
                                                <a href="{{ route('detail-machine', ['id' => $machine->id]) }}"
                                                    class="btn btn-info btn-sm p-2 border-0 rounded">
                                                    <i class="fa-solid fa-circle-info fs-6"></i>
                                                </a>
                                                <a href="{{ route('edit-machine', ['id' => $machine->id]) }}"
                                                    class="btn btn-warning btn-sm p-2 border-0 rounded">
                                                    <i class="fa-solid fa-pen-to-square fs-6"></i>
                                                </a>
                                                <button type="button" class="btn btn-danger btn-sm p-2 border-0 rounded"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#deleteModal{{ $machine->id }}">
                                                    <i class="fa-solid fa-trash fs-6"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">Tidak ada mesin ditemukan.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>


                                </table>
                            </div>

                        </div>
                        @endslot
                    </x-card>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </main>
    <!--   Core JS Files   -->
    @livewireScripts
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/curve-chart.js') }}"></script>
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
    <script src="js/data-table.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>
    <script>
        $(document).ready(function() {
        $('.tracking-btn').click(function() {
            $('#trackingModal').modal('show');
        });
    });
    </script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
</body>

</html>