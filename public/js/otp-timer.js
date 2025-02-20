document.addEventListener("DOMContentLoaded", function () {
    let countdownElement = document.getElementById("countdown");
    let expiryTime = countdownElement.getAttribute("data-expiry"); // Ambil waktu kedaluwarsa dari atribut data
    let expiryDate = new Date(expiryTime).getTime();

    function updateCountdown() {
        let now = new Date().getTime();
        let timeLeft = expiryDate - now;

        if (timeLeft <= 0) {
            countdownElement.innerText = "OTP Expired";
            document.getElementById("otp-form").style.display = "none"; // Sembunyikan form OTP saat expired
            return;
        }

        let minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
        let seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

        countdownElement.innerText = `Expired: ${minutes}:${
            seconds < 10 ? "0" : ""
        }${seconds}`;
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);
});
