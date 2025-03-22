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
            @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <x-machine-detail-card>
                @slot('code')
                {{ $machineData['code'] }}
                @endslot
                @slot('name')
                {{ $machineData['name'] }}
                @endslot
                @slot('line')
                {{ $machineData['line'] }}
                @endslot
                @slot('maker')
                {{ $machineData['maker'] }}
                @endslot
                @slot('no_fixed_asset')
                {{ $machineData['no_fixed_asset'] }}
                @endslot
            </x-machine-detail-card>


            <x-machine-checksheet-form :groups="$groups" :user="$user" :machineData="$machineData"
                :groupedItems="$groupedItems" />



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