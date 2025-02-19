<!DOCTYPE html>
<html lang="en">
<x-head></x-head>

<body class="g-sidenav-show bg-gray-100">
    <x-sidebar></x-sidebar>

    <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg">
        <x-navbar>
            @slot('title') Scanner @endslot
            @slot('role') @if ($user->golongan == 4 && $user->acting == 1) Manager @endif @endslot
            @slot('name') {{ $user->name }} @endslot
            @slot('dept') {{ $user->dept }} @endslot
        </x-navbar>

        <div class="container py-4 text-center">
            <h3 class="mb-3">Scan QR Code</h3>

            <div class="video-container" style="display: flex; justify-content: center;">
                <video id="preview"
                    style="width: 100%; max-width: 500px; border: 2px solid #ccc; border-radius: 10px;"></video>
            </div>

            <form id="scan-form" method="POST" action="{{ route('qr-code') }}">
                @csrf
                <input type="hidden" name="qrcode_data" id="qrcode_data">
            </form>

            <button onclick="window.history.back()" class="btn btn-primary mt-3">Kembali</button>
        </div>

        <x-footer></x-footer>
    </main>

    <!-- JS Files -->
    <script src="{{ asset('js/core/popper.min.js') }}"></script>
    <script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/plugins/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/smooth-scrollbar.min.js') }}"></script>
    <script src="{{ asset('js/plugins/chartjs.min.js') }}"></script>
    <script src="{{ asset('js/curve-chart.js') }}"></script>
    <script src="{{ asset('js/soft-ui-dashboard.min.js?v=1.0.3') }}"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <script src="{{ asset('js/scanqr.js') }}"></script>
</body>

</html>