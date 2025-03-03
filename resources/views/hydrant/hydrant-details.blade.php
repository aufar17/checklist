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
            Hydrant Details
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
            <x-hydrant-details-card>
                @slot('code')
                {{ $hydrant->no_hydrant }}
                @endslot
                @slot('location')
                {{ $hydrant->location }}
                @endslot
                @slot('type')
                {{ $hydrant->type }}
                @endslot
                @slot('latitude')
                {{ $hydrant->latitude }}
                @endslot
                @slot('longitude')
                {{ $hydrant->longitude }}
                @endslot
            </x-hydrant-details-card>
            <x-card>
                @slot('title')
                Inspection History
                @endslot
                @slot('body')
                <x-checksheet-table>
                    @slot('code')
                    {{ $hydrant->no_hydrant }}
                    @endslot
                    @slot('location')
                    {{ $hydrant->location }}
                    @endslot
                    @slot('year')
                    {{ now()->format('Y') }}
                    @endslot
                    @slot('type')
                    <span>Indoor</span>
                    <input disabled type="radio" class="custom-radio" @checked($hydrant->type == 'Indoor')>

                    <span>Outdoor</span>
                    <input disabled type="radio" class="custom-radio" @checked($hydrant->type == 'Outdoor')>

                    @endslot
                </x-checksheet-table>
                @endslot
            </x-card>
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
    <script src="js/data-table.js"></script>
    <script src="js/jquery.dataTables.js"></script>
    <script src="js/dataTables.bootstrap4.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script> --}}
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
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