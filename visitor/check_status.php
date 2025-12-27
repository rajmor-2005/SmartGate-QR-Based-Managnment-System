<?php
session_start();
include '../connection.php';

$request_id = $_SESSION['request_id'];

$result = $conn->query("SELECT status FROM visit_request WHERE request_id = $request_id");

$row= $result->fetch_assoc();
$status = $row['status'];

if($status == 'Pending'){
        echo "<h3 style='color:orange;'>⏳ Waiting for owner approval...</h3>";
} elseif($status == 'Accepted'){
    echo "<h3 style='color:green;'>✅ Request Approved</h3>";
    echo "<p>Please show QR code at the gate</p>";
    echo "<img src='../qr_codes/$request_id.png' width='200'>";
} elseif($status == 'Rejected'){
    echo "<h3 style='color:red;'>❌ Request Rejected</h3>";
} 
?>