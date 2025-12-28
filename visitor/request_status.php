<?php
session_start();
include '../connection.php';


if(!isset($_SESSION['request_id'])){
    die("Invalid Request ID");

}
$request_id = $_SESSION['request_id'];


// fetch QR code 

$result=$conn->query("SELECT el.qr_token, el.valid_till FROM entry_log el WHERE el.request_id=$request_id");

$qr_file="";
$valid_till="";

if($result->num_rows>0){
    $row=$result->fetch_assoc(); 
    $qr_file="../qr_codes/".$row['qr_token'].".png";
    $valid_till=$row['valid_till'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Status</title>
            <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body style="text-align: center; margin-top: 50px; ">
    <h2>Visitor Request Status</h2>

    <br><br>

    <div id="statusbox">
        
            Checking status...
    
    </div>

    <?php if($qr_file && file_exists($qr_file)) { ?>
    <h3>Show this QR at the gate:</h3>
    <img src="<?= $qr_file ?>" alt="QR Code" width="200" height="200">
    <p>Valid Till: <?= $valid_till ?></p>
<?php } ?>

    <script>
        function checkstatus(){
            $.ajax({
                url:'check_status.php',
                method:'POST',
                success:function(response){
                    $('#statusbox').html(response);
                }
            })
        }

        // check status every 1 seconds
        setInterval(checkstatus, 1000);
        checkstatus();
    </script>
</body>
</html>