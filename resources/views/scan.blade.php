<!DOCTYPE html>
<html lang="en">

<x-head></x-head>

<style>
    /* Frame Scanner QR Code */
    .qr-frame {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 60%;
        height: 60%;
        transform: translate(-50%, -50%);
        border: 2px solid transparent;
        pointer-events: none;
    }

    /* Garis sudut */
    .qr-frame::before,
    .qr-frame::after,
    .qr-corner-top-left,
    .qr-corner-top-right,
    .qr-corner-bottom-left,
    .qr-corner-bottom-right {
        content: "";
        position: absolute;
        width: 25px;
        height: 25px;
        border: 3px solid #FFFFFF;
    }

    .qr-corner-top-left {
        top: 0;
        left: 0;
        border-right: none;
        border-bottom: none;
    }

    .qr-corner-top-right {
        top: 0;
        right: 0;
        border-left: none;
        border-bottom: none;
    }

    .qr-corner-bottom-left {
        bottom: 0;
        left: 0;
        border-right: none;
        border-top: none;
    }

    .qr-corner-bottom-right {
        bottom: 0;
        right: 0;
        border-left: none;
        border-top: none;
    }

    /* Efek garis scan bergerak */
    .scan-line {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: #FFFFFF;
        animation: scan-animation 2s infinite linear;
    }

    @keyframes scan-animation {
        0% {
            top: 0%;
        }

        50% {
            top: 100%;
        }

        100% {
            top: 0%;
        }
    }

    #camera-container {
        position: relative;
        width: 90%;
        max-width: 400px;
        aspect-ratio: 1 / 1;
        margin: auto;
    }

    #preview {
        width: 100%;
        height: 100%;
        object-fit: cover;
        /* Pastikan tampilan penuh */
        border-radius: 10px;
    }


    #switch-camera {
        position: absolute;
        bottom: 15px;
        right: 15px;
        width: 50px;
        height: 50px;
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border: none;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 20px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    #switch-camera:hover {
        background-color: rgba(0, 0, 0, 0.9);
        transform: scale(1.1);
    }
</style>

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
            @if (session('error'))
            <div class="row">
                <div id="alert-message" class="col-md-12 alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}
                </div>
            </div>
            @endif
            <h3 class="mb-3">Scan QR Code</h3>
            <div class="video-container">
                <div id="camera-container" class="position-relative">
                    <video id="preview" class="w-100 rounded shadow" autoplay></video>
                    <div class="qr-frame">
                        <div class="scan-line"></div>
                        <div class="qr-corner-top-left"></div>
                        <div class="qr-corner-top-right"></div>
                        <div class="qr-corner-bottom-left"></div>
                        <div class="qr-corner-bottom-right"></div>
                    </div>
                    <button id="switch-camera"><i class="fa-solid fa-camera-rotate"></i></button>
                </div>
            </div>

            <form id="scan-form" method="POST" action="{{ route('scan-process') }}">
                @csrf
                <input type="hidden" name="qrcode_data" id="qrcode_data">
                <input type="hidden" name="latitude" id="latitude" value="{{ $latitude }}">
                <input type="hidden" name="longitude" id="longitude" value="{{ $longitude }}">
            </form>

            <p>Latitude: <span id="lat-text">{{ $latitude }}</span></p>
            <p>Longitude: <span id="lon-text">{{ $longitude }}</span></p>

            <a href="{{ route('admin') }}" class="btn btn-primary mt-3">Kembali</a>
        </div>

        <x-footer></x-footer>
    </main>

    <!-- JS Files -->
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({ video: document.getElementById("preview") });
        let cameras = [];
        let currentCameraIndex = 0;
        let video = document.getElementById("preview");

        function startScanner(cameraIndex) {
            if (cameras.length > 0) {
            video.style.transition = "transform 0.6s ease-in-out";
            video.style.transform = "rotateY(90deg)"; 

            setTimeout(() => {
                scanner.stop().then(() => {
                    scanner.start(cameras[cameraIndex]);

                    let isFrontCamera = cameras[cameraIndex].name.toLowerCase().includes("front");
                    
                    video.style.transform = isFrontCamera ? "rotateY(180deg)" : "rotateY(0deg)";

                }).catch(e => console.error("Gagal memulai scanner:", e));
            }, 300); 
        }
        }

            Instascan.Camera.getCameras().then(function (availableCameras) {
                if (availableCameras.length > 0) {
                    cameras = availableCameras;
                    startScanner(currentCameraIndex);
                    document.getElementById("switch-camera").style.display = "block";
                } else {
                    alert("Tidak ada kamera yang tersedia.");
                }
            }).catch(function (e) {
                console.error("Kesalahan Kamera:", e);
                alert("Gagal mengakses kamera.");
            });

            document.getElementById("switch-camera").addEventListener("click", function () {
                if (cameras.length > 1) {
                    currentCameraIndex = (currentCameraIndex + 1) % cameras.length;
                    startScanner(currentCameraIndex);
                } else {
                    alert("Hanya satu kamera yang tersedia.");
                }
            });

        scanner.addListener("scan", function (content) {
            document.getElementById("qrcode_data").value = content;

            let lat = document.getElementById("latitude").value;
            let lon = document.getElementById("longitude").value;

            if (!lat || !lon) {
                alert("Koordinat tidak ditemukan. Pastikan GPS aktif dan ulangi dari dashboard.");
                return;
            }

            document.getElementById("scan-form").submit();
        });

        function updateLocation(position) {
            let lat = position.coords.latitude;
            let lon = position.coords.longitude;

            document.getElementById("latitude").value = lat;
            document.getElementById("longitude").value = lon;

            document.getElementById("lat-text").textContent = lat;
            document.getElementById("lon-text").textContent = lon;

            console.log("Koordinat diperbarui:", lat, lon);
        }

        function handleLocationError(error) {
            console.error("Error mendapatkan lokasi:", error);
            alert("Gagal mendapatkan lokasi. Pastikan GPS aktif dan izinkan akses lokasi.");
        }

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(updateLocation, handleLocationError, {
                enableHighAccuracy: true,
                timeout: 30000,
                maximumAge: 0
            });

            navigator.geolocation.watchPosition(updateLocation, handleLocationError, {
                enableHighAccuracy: true,
                timeout: 30000,
                maximumAge: 0,
            });
        } else {
            alert("Geolocation tidak didukung oleh browser ini.");
        }
    </script>
</body>




</html>