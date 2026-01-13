<?php


include '../connection.php';
include '../phpqrcode/qrlib.php';

$qr_dir = __DIR__ . "/../qr_codes/"; // path to qr_codes folder


$request_id = $_POST['request_id'];
$status = $_POST['status'];


$conn->query("UPDATE visit_request SET status='$status' WHERE request_id=$request_id");

// if status is approved, generate QR code

if($status=="Accepted"){
    $token=uniqid("QR_");

    $valid_till=date('Y-m-d H:i:s', strtotime('+10 Minutes'));

    $conn->query("INSERT INTO entry_log(request_id,qr_token,valid_till,is_used)VALUES($request_id,'$token','$valid_till',0)");



// create folder if not exists
if(!is_dir($qr_dir)){
    mkdir($qr_dir, 0777, true);
}

    $qr_file = $qr_dir . $token . ".png"; // save in folder qr_codes
    $qr_data = "https://alesha-exhilarative-trena.ngrok-free.dev/SmartGate/gate/verify_qr.php?token=$token";
    QRcode::png($qr_data, $qr_file, QR_ECLEVEL_L, 6);



    if(file_exists($qr_file)){
        echo "QR generated successfully";
    } else {
        echo "QR generation failed";
    }

}

?>

