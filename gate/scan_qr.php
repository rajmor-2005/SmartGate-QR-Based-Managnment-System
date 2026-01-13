<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scan Qr Code</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
</head>
<body style="text-align: center; margin-top: 50px;">
    <h2>SmartGate - Watchman Scan</h2>

    <div id="reader" style="width:300px; margin:auto;"></div>
    
    <script>
function onScanSuccess(decodedText, decodedResult) {
    console.log("QR Code:", decodedText);
    window.location.href = decodedText; // redirect to verify_qr.php
}

function onScanFailure(error) {
    // ignore scan errors
}

let html5QrcodeScanner = new Html5QrcodeScanner(
    "reader",
    {
        fps: 10,
        qrbox: 250
    },
    false
);

html5QrcodeScanner.render(onScanSuccess, onScanFailure);
</script>
</body>
</html>