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
            New Hydrant
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
            <div class="row mt-4">
                <div class="col-12">
                    <x-card>
                        @slot('title')
                        Hydrant Forms
                        @endslot
                        @slot('body')
                        <form class="px-4 py-3" action="{{ route('hydrant-post') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">NO HYDRANT</label>
                                    <input type="text" class="form-control" name="no_hydrant">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">LOCATION</label>
                                    <input type="text" class="form-control" name="location">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">TYPE</label>
                                    <select name="type" class="form-select">
                                        <option disabled selected>Pilih</option>
                                        <option value="Indoor">Indoor</option>
                                        <option value="Outdoor">Outdoor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">LONGITUDE</label>
                                    <input type="text" class="form-control" name="longitude">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">LATITUDE</label>
                                    <input type="text" class="form-control" name="latitude">
                                </div>
                            </div>

                            <input type="text" class="form-control" name="status" hidden value=0>
                            <button class="btn btn-danger mt-5" type="submit">Submit</button>
                            <a href="{{ route('hydrant') }}" class="btn btn-secondary mt-5">Cancel</a>
                        </form>
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