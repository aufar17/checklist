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
    #radiocheck {
        border: 2px solid black
    }
</style>

<body class="g-sidenav-show  bg-gray-100">
    <x-sidebar></x-sidebar>
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>
            @slot('title')
            Checksheet Hydrant
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
            {{-- <div class="alert alert-success text-dark fw-bold">Hydrant H1134 Berhasil di scan!</div> --}}
            <x-hydrant-details>
                @slot('location')
                {{ $checksheet->location }}
                @endslot
                @slot('type')
                {{ $checksheet->type }}
                @endslot
                @slot('latitude')
                {{ $checksheet->latitude }}
                @endslot
                @slot('longitude')
                {{ $checksheet->longitude }}
                @endslot
            </x-hydrant-details>
            <x-checksheet-form>
                @slot('name')
                {{ $user->name }}
                @endslot
            </x-checksheet-form>
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
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>


</body>

</html>