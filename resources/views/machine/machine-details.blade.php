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
    <x-sidebar :user="auth()->user()" />
    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
        <x-navbar>
            @slot('title')
            Hydrant Details
            @endslot

            @slot('role')
            {{ $user->name }}
            @endslot

        </x-navbar>
        <div class="container-fluid py-4">
            <x-machine-detail-card>
                @slot('code')
                {{ $machines['no_machine'] }}
                @endslot
                @slot('name')
                {{ $machines['name'] }}
                @endslot
                @slot('line')
                {{ $machines['line'] }}
                @endslot
                @slot('maker')
                {{ $machines['maker'] }}
                @endslot
                @slot('no_fixed_asset')
                {{ $machines['no_fixed_asset'] }}
                @endslot
            </x-machine-detail-card>
            <x-card>
                @slot('title')
                Inspection History
                @endslot
                @slot('body')
                <x-machine-checksheet-table :machines="$machines" :machine_items="$machine_items"
                    :inspections="$inspections" :daysInMonth="$daysInMonth" :imagePaths="$imagePaths" />


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
    <script src="{{asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>

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
        document.addEventListener("DOMContentLoaded", function () {
            const statusSelect = document.getElementById("status");
            const notesField = document.getElementById("notesField");
    
            statusSelect.addEventListener("change", function () {
                if (this.value === "4") {
                    notesField.style.display = "block";
                    document.getElementById("notes").setAttribute("required", "true");
                } else {
                    notesField.style.display = "none";
                    document.getElementById("notes").removeAttribute("required");
                }
            });
        });
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
    </script>





</body>

</html>