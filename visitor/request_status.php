<?php
session_start();
include '../connection.php';

if(!isset($_SESSION['request_id'])){
    die("Invalid Request ID");

}
$request_id = $_SESSION['request_id'];

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
<body>
    <h2>Visitor Request Status</h2>

    <br><br>

    <div id="statusbox">
        <p>Checking Status...</p>
    </div>

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

        // check status every 2 seconds
        setInterval(checkstatus, 2000);
        checkStatus();
    </script>
</body>
</html>