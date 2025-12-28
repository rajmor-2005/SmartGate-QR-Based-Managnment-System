<?php
session_start();
include '../connection.php';

$request_id = $_SESSION['request_id'];

$status_result = $conn->query("SELECT status FROM visit_request WHERE request_id=$request_id");
$status_row = $status_result->fetch_assoc();
$status = $status_row['status'];

// Fetch QR token if exists
$qr_file = "";
$qr_result = $conn->query("SELECT qr_token FROM entry_log WHERE request_id=$request_id");
if($qr_result->num_rows > 0){
    $qr_row = $qr_result->fetch_assoc();
    $qr_file = "../qr_codes/" . $qr_row['qr_token'] . ".png";
}



if($status == 'Pending'){
        echo "<h3 style='color:orange;'>⏳ Waiting for owner approval...</h3>";
} elseif($status == 'Accepted'){
    echo "<h3 style='color:green;'>✅ Request Approved</h3>";
    if($qr_file && file_exists($qr_file))
    {
    echo "<p>Please show QR code at the gate</p>";
    echo "<img src='$qr_file' width='200'>";
    } 
    else{
        echo "<p>QR code not generated yet.</p>";
    }
} 

elseif($status == 'Rejected'){
    echo "<h3 style='color:red;'>❌ Request Rejected</h3>";
} 
?>