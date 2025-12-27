<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


        <title>SmartGate</title>
</head>
<body style="text-align: center; margin-top: 50px; ">
    
<h1>Visitor Form</h1>
<br><br>
<form id="visitorform">
    Name : <input type="text" name ="name" placeholder="Name">
    <br><br>
    Wing : <select name="wing">
        <option value="A">A</option>
        <option value="B">B</option>
        <option value="C">C</option>
        <option value="D">D</option>
    </select>
    <br><br>
    Flat No : <select name="flat_no">
        <option value="101">101</option>
        <option value="201">201</option>
        <option value="301">301</option>
        <option value="401">401</option>
    </select>
    <br><br>
    Purpose of Visit : <textarea name="purpose" placeholder="Enter Your Reason" style="resize:none"></textarea>
    <br><br>
    Mobile No : <input type="text" name ="mobile" placeholder="Mobile No">
    <br><br>
    <input type="submit" value="Submit">
</form>

<script>
    $(document).ready(function(){
        $('#visitorform').on('submit',function(e)
    {
            e.preventDefault();

        $.ajax({
            url:"submit_request.php",
            method:"POST",
            data:$(this).serialize(),
            success:function(response){
                if(response.trim() == "Success"){
                Swal.fire
                ({
                    title: 'Request Submitted',
                    text: 'Please wait for owner approval',
                    icon: 'success',
                    confirmButtonText: 'OK'

                }).then(()=>{
                    window.location.href = 'request_status.php';
                });
            } else {
                Swal.fire('Error','There was an error submitting the form','error');
            }

            },
            error:function(){
                Swal.fire('Error','There was an error submitting the form','error');
            }
        })
    })
    })
</script>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
</body>
</html>