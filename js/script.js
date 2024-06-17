$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var username = $('#username').val();
        var password = $('#password').val();
        var role = $('#role').val();
        $.ajax({
            type: 'POST',
            url: 'includes/login.php',
            data: {username: username, password: password, role:role },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'dashboard.php';
                } else {
                    $('#login-error').text(response.message);
                }
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    $('#logout-btn').click(function() {
        $.ajax({
            type: 'GET',
            url: 'logout.php',
            success: function() {
                window.location.href = 'index.php';
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });

    
});


//Register button js.
   
document.getElementById('role').addEventListener('change', function() {
    var role = this.value;
    var loginForm = document.getElementById('login-form');
    var registerButton = document.getElementById('register-button');
    
    // If the selected role is "User", create a span with a button after the login button
    if (role === 'User') {
        if (!registerButton) {
            var registerButton = document.createElement('button');
            registerButton.id = 'register-button';
            registerButton.className = 'btn btn-secondary';
            registerButton.textContent = 'Register';
            
             // Set data-toggle and data-target attributes
            registerButton.setAttribute('data-toggle', 'modal');
            registerButton.setAttribute('data-target', '#registrationModal');

            // Insert the register button after the login button
            loginForm.parentNode.insertBefore(registerButton, loginForm.nextSibling);
        }
    } else {
        // Remove the register button if it exists
        if (registerButton) {
            registerButton.parentNode.removeChild(registerButton);
        }
    }
});

//End Here

//register script
$(document).ready(function() {
    $('#registrationForm').submit(function(e) {
        e.preventDefault();
        var username = $('#reg-username').val();
        var password = $('#reg-password').val();
        var confirmPassword = $('#confirmPassword').val();
        var role = $('#reg-role').val();
        
        
        // Check if passwords match
        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return;
        }
        
        // Send data to PHP script using Ajax
        $.ajax({
            type: "POST",
            url: "register.php",
            data: {
                username: username,
                password: password,
                role: role
            },
            success: function(response) {
                alert(response); // Alert success or error message
                $('#registrationModal').modal('hide'); // Close modal
            }
        });
    });
});

