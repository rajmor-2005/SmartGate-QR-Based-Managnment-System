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
        const scanner =new Html5Qrcode("reader");

        scanner.start({
            facingMode:"environment"},
        {fps:10, qrbox:250},
    qrCodeMessage=>{
        window.location.href=qrCodeMessage;
    },
errorMessage=>{
    console.log(errorMessage);
}


);
    </script>
</body>
</html>