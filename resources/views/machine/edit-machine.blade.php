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

    .loading-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        color: white;
        font-size: 18px;
        font-weight: bold;
        z-index: 9999;
    }

    /* Animasi Gambar Jarum Location */
    .loading-icon {
        width: 60px;
        height: 60px;
        animation: bounce 1s infinite alternate;
    }

    @keyframes bounce {
        0% {
            transform: translateY(0);
        }

        100% {
            transform: translateY(-15px);
        }
    }

    .btn-location {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        border: none;
        color: white;
        font-size: 24px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
    }

    .btn-location:hover {
        transform: scale(1.1);
    }
</style>

@php
$notifBadge = 0;


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
            <div class="row mt-4">
                <div class="col-12">
                    <x-card>
                        @slot('title')
                        Machine Forms
                        @endslot
                        @slot('body')
                        <form class="px-4 py-3" action="{{ route('machine-update') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">NO MACHINE</label>
                                    <input type="text" class="form-control" name="no_machine"
                                        value="{{ $machine->no_machine }}">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">NAMA MESIN</label>
                                    <input type="text" class="form-control" name="name" value="{{ $machine->name }}">
                                </div>
                                <div class="col-md-4 mt-2">
                                    <label class="form-label">LINE</label>
                                    <select name="line" class="form-select">
                                        <option value="">-- Pilih Maker --</option>
                                        @foreach ($lines as $line)
                                        <option value="{{ $line->id }}" {{ $machine->line == $line->id ?
                                            'selected' : '' }}>
                                            {{ $line->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">MAKER</label>
                                    <select name="maker" class="form-select">
                                        <option value="">-- Pilih Maker --</option>
                                        @foreach ($makers as $maker)
                                        <option value="{{ $maker->id }}" {{ $machine->maker_id == $maker->id ?
                                            'selected' : '' }}>
                                            {{ $maker->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mt-2">
                                    <label class="form-label">NO FIXED ASSET</label>
                                    <input type="number" class="form-control" name="no_fixed_asset"
                                        value="{{ $machine->no_fixed_asset }}">
                                </div>

                            </div>

                            <div class="row" id="locationFields" style="visibility: hidden;">
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">LONGITUDE</label>
                                    <input type="text" class="form-control" id="longitude" name="longitude" readonly
                                        value="{{ $machine->longitude }}">
                                </div>
                                <div class="col-md-6 mt-2">
                                    <label class="form-label">LATITUDE</label>
                                    <input type="text" class="form-control" id="latitude" name="latitude" readonly
                                        value="{{ $machine->latitude }}">
                                </div>
                            </div>

                            <div class="row d-flex justify-content-center align-items-center">
                                <div class="col-md-2 mt-4 d-flex justify-content-center">
                                    <button type="button" class="btn-location btn btn-danger" onclick="getLocation()">
                                        📍
                                    </button>
                                </div>
                            </div>

                            <input type="text" class="form-control" name="status" hidden value=0>
                            <button class="btn btn-danger mt-5" type="submit">Submit</button>
                            <a href="{{ route('machine') }}" class="btn btn-secondary mt-5">Cancel</a>
                        </form>
                        @endslot

                        <div id="loadingOverlay" class="loading-overlay">
                            <img src="https://cdn-icons-png.flaticon.com/512/684/684908.png" alt="Loading"
                                class="loading-icon">
                            <p>Mengambil lokasi...</p>
                        </div>


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
    <script>
        function getLocation() {
            if (navigator.geolocation) {
                document.getElementById("loadingOverlay").style.display = "flex";
    
                let timeoutHandler = setTimeout(() => {
                    document.getElementById("loadingOverlay").style.display = "none";
                    alert("Gagal mendapatkan lokasi: Timeout, coba lagi.");
                }, 10000); 
    
                navigator.geolocation.getCurrentPosition(
                function (position) {
                    clearTimeout(timeoutHandler); 
                    document.getElementById("longitude").value = position.coords.longitude;
                    document.getElementById("latitude").value = position.coords.latitude;

                    document.getElementById("locationFields").style.visibility = "visible";

                    setTimeout(() => {
                        document.getElementById("loadingOverlay").style.display = "none";
                    }, 2000); 
                },
                    function (error) {
                        clearTimeout(timeoutHandler); 
                        document.getElementById("loadingOverlay").style.display = "none";
                        alert("Gagal mendapatkan lokasi: " + error.message);
                    },
                    {
                        enableHighAccuracy: true,
                        timeout: 10000, 
                        maximumAge: 0
                    }
                );
            } else {
                alert("Geolocation tidak didukung di browser ini.");
            }
        }
    </script>




</body>

</html>