src = "https://rawgit.com/schmich/instascan-builds/master/instascan.min.js";
let scanner;
document.getElementById("startScanner").addEventListener("click", function () {
    document.getElementById("preview").style.display = "block"; // Tampilkan video
    startScanner();
});

function startScanner() {
    scanner = new Instascan.Scanner({
        video: document.getElementById("preview"),
    });

    scanner.addListener("scan", function (content) {
        document.getElementById("qrcode_data").value = content;
        document.getElementById("scan-form").submit();
    });

    Instascan.Camera.getCameras()
        .then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]); // Gunakan kamera pertama
            } else {
                alert("Kamera tidak ditemukan!");
            }
        })
        .catch(function (e) {
            console.error(e);
        });
}
