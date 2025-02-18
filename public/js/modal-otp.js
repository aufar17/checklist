document.addEventListener("DOMContentLoaded", function () {
    if (document.body.dataset.showOtpModal === "true") {
        var otpModal = new bootstrap.Modal(document.getElementById("otpModal"));
        otpModal.show();
    }

    // OTP Input Navigation
    let inputs = document.querySelectorAll(".otp-input");

    inputs.forEach((input, index) => {
        input.addEventListener("input", (e) => {
            if (e.target.value.length === 1 && index < inputs.length - 1) {
                inputs[index + 1].focus();
            }
        });

        input.addEventListener("keydown", (e) => {
            if (e.key === "Backspace" && index > 0 && e.target.value === "") {
                inputs[index - 1].focus();
            }
        });
    });
});
