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

<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>
            @slot('title')
            Dashboard
            @endslot

            @slot('role')
            @if ($user->golongan == 4 && $user->acting == 1)
            Manager
            @endif
            @endslot

            @slot('name')
            {{ $user->name }}
            @endslot

            @slot('dept')
            {{ $user->dept }}
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
                                    <tr>
                                        <td class="text-center">{{$no++ }}</td>
                                        <td class="text-center">{{$hydrant->no_hydrant }}</td>
                                        <td class="text-center">{{$hydrant->location }}</td>
                                        <td class="text-center">{{$hydrant->type }}</td>
                                        <td class="text-center">
                                            <button
                                                class="badge text-bg-warning rounded-pill p-1 px-2 border-0 fw-bold fs-7">
                                                <span class="text-white">Uncheck</span>
                                            </button>
                                        </td>
                                        <td>
                                            <a href="{{ route('detail-hydrant',['id'=>$hydrant->id]) }}"
                                                class="btn btn-info btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-circle-info fs-6"></i>
                                            </a>
                                            <a class="btn btn-warning btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-pen-to-square fs-6"></i>
                                            </a>
                                            <a class="btn btn-danger btn-sm p-2 border-0 rounded">
                                                <i class="fa-solid fa-trash fs-6"></i>
                                            </a>
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
            "paging": false, 
            "info": false,   
            "searching": true,
            });
        });
        $("#example_filter").appendTo("#tableHeader").addClass("ms-auto");
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