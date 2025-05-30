<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Otp Verification</title>
    <style>
        .expired-message {
            display: none;
        }
    </style>
</head>

<body>
    <div class="container shadow-lg p-5 mt-5 w-50 mx-auto">
        <h1 class="text-center">Otp Verification</h1>

        <form id="otp-form" action="{{ route('verify-otp') }}" method="POST">
            @csrf
            <div class="form-floating mt-4">
                <input type="number" class="form-control" id="otp" name="otp" placeholder="Enter OTP" required maxlength="6">
                <label for="otp">Enter OTP</label>
                @error('otp')
                <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>

            <div id="countdown" class="mt-3 text-danger text-center"></div>
            <div id="expired-message" class="alert alert-danger text-center expired-message">
                OTP has expired. Please request a new OTP.
            </div>
            <div class="mt-3 text-center">
                <button type="submit" id="verify-button" class="btn btn-primary">Verify OTP</button>
            </div>
        </form>
    </div>

    <script>
        // Set countdown duration
        let countdownDuration = 60; // seconds
        const countdownElement = document.getElementById("countdown");
        const expiredMessageElement = document.getElementById("expired-message");
        const verifyButton = document.getElementById("verify-button");
        const otpForm = document.getElementById("otp-form");

        // Update countdown every second
        const timer = setInterval(() => {
            if (countdownDuration > 0) {
                countdownDuration--;
                countdownElement.textContent = `Time remaining: ${countdownDuration} seconds`;
            } else {
                clearInterval(timer); // Stop the timer
                countdownElement.textContent = "";
                expiredMessageElement.style.display = "block"; // Show expiration message
                verifyButton.disabled = true; // Disable the button
                otpForm.addEventListener("submit", (e) => e.preventDefault()); // Prevent form submission
            }
        }, 1000);
    </script>
</body>

</html>