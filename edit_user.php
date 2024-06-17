
<?php
if (isset($_GET['user'])) {
    $userId = $_GET['user'];
   
}
?>
<link rel="stylesheet" href="font_awesome/css/font-awesome.min.css">
<h2>Edit User Form</h2>
<form id="userForm" enctype="multipart/form-data">
    <input type="hidden" id="userId" name="userId" value="<?php echo $userId; ?>"> <!-- Example: Replace with actual user ID -->
    <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="address">Address</label>
        <textarea class="form-control" id="address" name="address" rows="3"></textarea>
    </div>
    <div class="form-group">
        <label for="gender">Gender</label>
        <select class="form-control" id="gender" name="gender" required>
            <option value="male">Male</option>
            <option value="female">Female</option>
            <option value="other">Other</option>
        </select>
    </div>
    <div class="form-group">
        <label for="birthdate">Date of Birth</label>
        <input type="date" class="form-control" id="birthdate" name="birthdate">
    </div>
    <div class="form-group input-container">
        <label for="username">Username</label>
        <input type="text" class="form-control" id="username" name="username"  Readonly>
        <i class="fa fa-lock" aria-hidden="true"></i>
    </div>
    <div class="form-group input-container">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password"  Readonly>
        <i class="fa fa-lock" aria-hidden="true"></i>
    </div>
    <div class="form-group">
                                <label for="role">Role:</label>
                                <select id="role" name="role" class="form-control" required>
                                    <option value="Admin">Admin</option>
                                    <option value="User">User</option>
                                    <option value="SuperAdmin">SuperAdmin</option>
                                </select>
                            </div>
    <div class="form-group">
        <label for="mobile">Mobile</label>
        <input type="tel" class="form-control" id="mobile" name="mobile"  pattern="[0-9]{9}" require>
    </div>
    <div class="form-group">
        <label for="profile_picture">Profile Picture</label>
        <img id="profilePic"  alt="Signature Picture" width="60px" height="60px" name="profilePic">
        <input type="file" class="form-control-file" id="profile_picture" name="profile_picture">
    </div>
    <div class="form-group">
        <label for="signature">Signature</label>
        <img id="signPic"  alt="Signature Picture" width="60px" height="60px" name="signPic">
        <input type="file" class="form-control-file" id="signature" name="signature">
    </div>
    <button type="submit" class="btn btn-primary" id="submitBtn">Update User</button>
</form>


<script>
        $(document).ready(function() {
            $('#userForm').submit(function(event) {
                event.preventDefault();
                var formData = new FormData($(this)[0]);
                 // Add src attributes of images to formData
                var signimg = $('#signPic').attr('src');
                var profileImg = $('#profilePic').attr('src');

                formData.append('signImg', signimg);
                formData.append('profileImg', profileImg);

                $.ajax({
                    url: 'process_update_information.php',
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

