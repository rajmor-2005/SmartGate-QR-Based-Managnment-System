<?php

include '../connection.php';
$token = $_GET['token'];

if(!$token){
    die("<h2>Invalid QR</h2>");
}

$result=$conn->query("SELECT el.*, vr.visitor_id FROM entry_log el JOIN visit_request vr ON vr.request_id=el.request_id 
WHERE el.qr_token='$token'");

if($result->num_rows===0)
{
    die("<h2>QR Not Found</h2>");

}

$row = $result->fetch_assoc();

if($row['is_used']==1){
    die("<h2>QR Already Used</h2>");

}

if(strtotime($row['valid_till'])<time()){
    die("<h2>QR Expired</h2>");
}

// mark QR as used
$conn->query("UPDATE entry_log SET is_used=1 WHERE qr_token='$token'");

echo "<h1 style='color:green;'>QR Verified, Entry Allowed.</h1>
<p>WELCOME VISITOR</p>
";


?>