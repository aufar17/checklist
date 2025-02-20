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
            <x-kpi></x-kpi>
            <div class="img-container">
                <img src="{{ asset('img/bg-dashboard.gif') }}" alt="Dashboard Image">
            </div>
            <div class="row">
                <div class="col-12 text-center d-flex justify-content-center align-items-center">
                    <button class="btn btn-danger mt-0 shadow-lg" id="startScanner"> <i
                            class="fa-solid fa-qrcode"></i></button>
                </div>
                <div class="col-12 text-center d-flex justify-content-center align-items-center mb-5">
                    <span class="fw-bold">SCAN HERE!</span>
                </div>
            </div>


            <form id="scan-form" method="POST" action="{{ route('qr-code') }}">
                @csrf
                <input type="hidden" name="qrcode_data" id="qrcode_data">
            </form>

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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
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
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        document.getElementById("startScanner").addEventListener("click", function () {
            localStorage.setItem("startScanner", "true"); 
            window.location.href = "{{ route('scan') }}"; 
        });
    </script>

</body>

</html>