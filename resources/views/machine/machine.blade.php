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
                                <a href="{{ route('new-hydrant') }}" class="btn btn-success btn-sm w-100">
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
                            <table id="example" class="table table-striped table-bordered text-center table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">No</th>
                                        <th class="text-center">No Mesin</th>
                                        <th class="text-center">Nama</th>
                                        <th class="text-center">Line</th>
                                        <th class="text-center">Maker</th>
                                        <th class="text-center">No Fixed Asset</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($machines as $machine)
                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteModal" tabindex="-1"
                                        aria-labelledby="deleteModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                                </div>
                                                <div class="modal-body">
                                                    Apakah yakin ingin menghapus mesin
                                                    <strong class="text-danger">{{$machine['no_machine']}}</strong>?
                                                </div>
                                                <div class="modal-footer">
                                                    <form id="deleteForm" action="" method="POST">
                                                        @csrf
                                                        <input hidden type="text" name="id" id="productId"
                                                            value="{{ $machine['id'] }}">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $machine['no_machine'] }}</td>
                                        <td class="text-center">{{ $machine['name'] }}</td>
                                        <td class="text-center">{{ $machine['line'] }}</td>
                                        <td class="text-center">{{ $machine['maker'] }}</td>
                                        <td class="text-center">{{ $machine['no_fixed_asset'] }}</td>
                                        <td>
                                            <a href="{{ route('detail-machine', ['id' => $machine['id']]) }}"
                                                class="btn btn-info btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-circle-info fs-6"></i>
                                            </a>
                                            <a href="{{ route('detail-machine', ['id' => $machine['id']]) }}"
                                                class="btn btn-warning btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                                            </a>
                                            <button type="button" class="btn btn-danger btn-sm p-2 border-0 rounded"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal"
                                                data-id="{{ $machine['id'] }}">
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