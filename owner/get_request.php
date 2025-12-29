<?php
    include '../connection.php';

    // assuming owner is logged in with id 1

    $owner_id = 1; 

    $query="SELECT vr.request_id, v.name, v.mobile, vr.wing, vr.flat_no, vr.purpose 
        FROM visit_request vr JOIN visitor v ON vr.visitor_id =v.visitor_id WHERE 
        vr.owner_id=1 AND vr.status='Pending'";

    $result = $conn->query($query);

    while($row=$result->fetch_assoc()){
    echo '
<tr>
    <td>'.$row['name'].'</td>
    <td>'.$row['mobile'].'</td>
    <td>'.$row['wing'].'</td>
    <td>'.$row['flat_no'].'</td>
    <td>'.$row['purpose'].'</td>
    <td>
        <button onclick="updateStatus('.$row['request_id'].',\'Accepted\')">Approve</button>
        <button onclick="updateStatus('.$row['request_id'].',\'Rejected\')">Reject</button>
    </td>
</tr>';
    }



?>

<script>
function updateStatus(id, status){
    $.ajax({
        url: "update_request.php",
        type: "POST",
        data: { request_id: id, status: status },
        success: function(response){
            console.log(response); 
            location.reload();
        },
        error: function(xhr){
            console.log(xhr.responseText);
        }
    });
}
</script>


