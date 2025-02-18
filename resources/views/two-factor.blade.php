@if(session('show_otp_modal'))
<script>
    {{ asset('js/modal-otp.js') }}
</script>
@endif

<!-- Modal OTP -->
<div class="modal fade" id="otpModal" tabindex="-1" aria-labelledby="otpModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">OTP Verification</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="POST">
                    @csrf
                    <div class="mb-3 text-center">
                        <label for="otp" class=" fs-xl form-label">6 Digit OTP</label>
                        <div class="d-flex justify-content-center">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                            <input type="text" class="otp-input" name="otp[]" maxlength="1">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Verify</button>
                </form>
            </div>
        </div>
    </div>
</div>