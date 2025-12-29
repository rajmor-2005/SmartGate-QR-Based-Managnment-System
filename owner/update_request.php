<!-- <?php


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
    QRcode::png($token, $qr_file, QR_ECLEVEL_L, 6);


    if(file_exists($qr_file)){
        echo "QR generated successfully";
    } else {
        echo "QR generation failed";
    }

}

?> -->

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include '../connection.php';
include '../phpqrcode/qrlib.php';

if(!isset($_POST['request_id'], $_POST['status'])){
    die("POST missing");
}

$request_id = (int)$_POST['request_id'];
$status = $_POST['status'];

$qr_dir = __DIR__ . '/../qr_codes/';

// update request status
$conn->query("UPDATE visit_request SET status='$status' WHERE request_id=$request_id");

if($status === "Accepted"){

    // prevent duplicate QR
    $check = $conn->query("SELECT * FROM entry_log WHERE request_id=$request_id");
    if($check->num_rows > 0){
        echo "QR already exists";
        exit;
    }

    $token = uniqid("QR_");
    $valid_till = date('Y-m-d H:i:s', strtotime('+10 minutes'));

    $conn->query("
        INSERT INTO entry_log (request_id, qr_token, valid_till, is_used)
        VALUES ($request_id, '$token', '$valid_till', 0)
    ");

    if(!is_dir($qr_dir)){
        mkdir($qr_dir, 0777, true);
    }

    $qr_file = $qr_dir . $token . ".png";

    QRcode::png($token, $qr_file, QR_ECLEVEL_L, 6);

    if(file_exists($qr_file)){
        echo "QR generated: $qr_file";
    } else {
        echo "QR failed";
    }
}
?>