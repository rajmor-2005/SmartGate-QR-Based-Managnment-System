<?php

session_start();


include '../connection.php';

$name = $_POST['name'];
$wing = $_POST['wing'];
$flat_no = $_POST['flat_no'];
$purpose = $_POST['purpose'];
$mobile = $_POST['mobile'];

// check if visitor is exit or not

$result=$conn->query("SELECT visitor_id FROM visitor WHERE mobile='$mobile'");

if($result->num_rows > 0){
    $row = $result->fetch_assoc();
    $visitor_id = $row['visitor_id'];
}

else{

    // insert new visitor into visitor table
    $conn->query("INSERT INTO visitor (name, mobile) VALUES ('$name', '$mobile')");
    $visitor_id = $conn->insert_id;
}

// find owner id based on wing and flat no from owner table

$owner_result = $conn->query("SELECT owner_id FROM owner WHERE wing='$wing' AND flat_no='$flat_no'");
if($owner_result->num_rows > 0){
    $owner_row = $owner_result->fetch_assoc();
    $owner_id = $owner_row['owner_id'];
} else {
    echo "Invalid wing or flat number";
    exit;
}

// insert request into visit_request table

$conn->query("INSERT INTO visit_request (visitor_id, owner_id, wing, flat_no, purpose, status) 
            VALUES ($visitor_id, $owner_id, '$wing', '$flat_no', '$purpose', 'pending')");


// store request id in session

$_SESSION['request_id']= $conn->insert_id;

echo "Success";
exit;

?>