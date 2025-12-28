<?php

session_start();
include '../connection.php';


// assume owner is logged in 
$owner_id=1; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Dashboard</title>

    <style>
        table {
            margin: auto;
            border-collapse: collapse;
        }

        th,td{
            padding: 10px;
            border: 1px solid black;

        }
    </style>

</head>
<body>
    <h2 style="text-align:center;">Owner Dashboard</h2>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>Visitor</th>
                <th>Mobile</th>
                <th>Wing</th>
                <th>Flat No</th>
                <th>Purpose</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="requestData"></tbody>
    </table>

    <script>
        function loadrequest() {
            $.get("get_request.php",function(data) {
                $("#requestData").html(data);
                
            });
        }

        // refresh every 3 seconds for new requests
        setInterval(loadrequest,3000);
        loadrequest();
    </script>
</body>
</html>