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
            <div class="video-container">
                <video id="preview"
                    style="width: 100%; max-width: 500px; border: 2px solid #ccc; border-radius: 10px;"></video>
            </div>

            <form id="scan-form" method="POST" action="{{ route('qr-code') }}">
                @csrf
                <input type="hidden" name="qrcode_data" id="qrcode_data">
            </form>

            <p>Latitude: {{ $latitude }}</p>
            <p>Longitude: {{ $longitude }}</p>

            <a href="{{ route('admin') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>

        <x-footer></x-footer>
    </main>

    <!-- JS Files -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById("preview") });

        scanner.addListener("scan", function (content) {
            document.getElementById("qrcode_data").value = content;
            document.getElementById("scan-form").submit();
        });

        Instascan.Camera.getCameras()
            .then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]);
                } else {
                    alert("Kamera tidak ditemukan!");
                }
            })
            .catch(function (e) {
                console.error("Kesalahan Kamera:", e);
            });
    </script>

</body>

</html>