<?php 
session_start();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Information</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h2>Add <?php echo $_SESSION['role']; ?> Information</h2>
    <form id="addForm" enctype="multipart/form-data">
        <input type="text" name="name" placeholder="Name" required><br>
        <input type="text" name="mobile" placeholder="Mobile"><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <textarea name="address" placeholder="Address"></textarea><br>
        Gender:
        <input type="radio" name="gender" value="male" required> Male
        <input type="radio" name="gender" value="female"> Female
        <input type="radio" name="gender" value="other"> Other<br>
        <input type="date" name="dob" placeholder="Date of Birth" required><br>
        <input type="file" name="profile_picture" accept="image/*"><br>
        <input type="file" name="signature" accept="image/*"><br>
        <?php if(!empty($_SESSION['profile_data'])){
            echo '<button type="submit" id= "update-info-btn" >Update</button>';
        }else{

            echo '<button type="submit" id= "submit-info-btn" >Submit</button>';
        }?>
        
        
    </form>

    <script>
        $(document).ready(function() {
            $('#addForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                
                $.ajax({
                    url: 'process_add_information.php',
                    type: 'POST',
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        // alert(response);
                        $('#addForm')[0].reset();
                    },
                    error: function(xhr, status, error) {
                        console.error(xhr.responseText);
                    }
                });
                return false;
            });
        });
    </script>
</body>
</html>
