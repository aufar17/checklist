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

    #map {
        height: 80vh;
        width: 100%;
        border: 2px solid #ccc;
        border-radius: 10px;
    }

    .map-title {
        text-align: center;
        font-size: 20px;
        font-weight: bold;
        margin: 10px 0;
    }
</style>

@php
$notifBadge = 0;
@endphp


<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar :notifBadge="$notifBadge" />
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
            <livewire:kpi />

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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
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
    @livewireScripts
</body>

</html>