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
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="row mt-4">
                <div class="col-md-12">
                    <x-card>
                        @slot('title')
                        Hydrant Table
                        @endslot
                        @slot('body')
                        <a href="{{ route('new-hydrant') }}" class="btn btn-success"><i
                                class="fa-solid fa-plus me-2"></i>New</a>
                        <div class="row mb-3 align-items-end">
                            <div class="col-sm-2">
                                <label for="filterYear" class="form-label">Year</label>
                                <select id="filterYear" class="form-select form-control-sm" style="height: 38px;">
                                    <option value="">All</option>
                                    @for ($y = date('Y'); $y >= date('Y') - 5; $y--)
                                    <option value="{{ $y }}">{{ $y }}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label for="filterMonth" class="form-label">Month</label>
                                <select id="filterMonth" class="form-select form-control-sm" style="height: 38px;">
                                    <option value="">All</option>
                                    @for ($m = 1; $m <= 12; $m++) <option value="{{ $m }}">{{ date('F', mktime(0, 0, 0,
                                        $m, 1)) }}</option>
                                        @endfor
                                </select>
                            </div>

                            <div class="col-sm-2">
                                <label class="form-label d-block my-2">Export</label>
                                <div class="dropdown mt-2">
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

                            <div class="col-md-4">
                                <div id="tableHeader" class="w-100"></div>
                            </div>
                        </div>




                        <div class="table-responsive">
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
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah yakin ingin menghapus hydrant
                                                    <strong class="text-danger">{{$hydrant->no_hydrant}}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deleteForm" action="{{ route('hydrant-delete') }}"
                                                        method="POST">
                                                        @csrf
                                                        <input hidden type="text" name="id" id="productId"
                                                            value="{{ $hydrant->id }}">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal Validasi Inspeksi -->
                                    <div class="modal fade" id="trackingModal-{{ $hydrant->id }}" tabindex="-1"
                                        aria-hidden="true">
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

                                    <!-- Data Table Row -->
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $hydrant->no_hydrant }}</td>
                                        <td class="text-center">{{ $hydrant->location }}</td>
                                        <td class="text-center">{{ $hydrant->type }}</td>
                                        <td class="text-center">
                                            @php
                                            $statusList = [
                                            0 => ['text' => 'Belum Inspeksi', 'class' => 'text-bg-warning'],
                                            1 => ['text' => 'Dibuat', 'class' => 'text-bg-success'],
                                            2 => ['text' => 'Approved by SPV', 'class' => 'text-bg-success'],
                                            3 => ['text' => 'Approved by Manager', 'class' => 'text-bg-success'],
                                            4 => ['text' => 'Rejected by SPV', 'class' => 'text-bg-danger'],
                                            5 => ['text' => 'Rejected by Manager', 'class' => 'text-bg-danger'],
                                            ];

                                            $status = $statusList[$hydrant->latest_status] ?? ['text' => 'Tidak
                                            Diketahui', 'class' => 'text-bg-secondary'];
                                            @endphp

                                            <button
                                                class="badge {{ $status['class'] }} p-1 px-2 border-0 fw-bold fs-7 tracking-btn"
                                                data-bs-toggle="modal"
                                                data-bs-target="#trackingModal-{{ $hydrant->id }}">
                                                <span class="text-white fw-bold">{{ $status['text'] }}</span>
                                            </button>
                                        </td>

                                        <td>
                                            <a href="{{ route('detail-hydrant', ['id' => $hydrant->id]) }}"
                                                class="btn btn-info btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-circle-info fs-6"></i>
                                            </a>
                                            <a href="{{ route('edit-hydrant', ['id' => $hydrant->id]) }}"
                                                class="btn btn-warning btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm p-2 border-0 rounded"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $hydrant->id }}">
                                                <i class="fa-solid fa-trash fs-6"></i>
                                            </button>

                                        </td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        @endslot
                    </x-card>
                </div>
            </div>
            <x-footer></x-footer>
        </div>
    </main>






    <!--   Core JS Files   -->
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