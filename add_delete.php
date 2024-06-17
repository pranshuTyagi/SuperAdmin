<?php
include 'includes/db_connection.php';
// Calling the function after including the page

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'deleteUser') {
    // Ensure userId is set and numeric
   
    if (isset($_POST['userId']) && is_numeric($_POST['userId'])) {
        $userId = intval($_POST['userId']);
        
        // Assuming $conn is your database connection
        if (deleteUser($conn, $userId)) {
            echo 'success';
            
        } else {
            echo 'error';
        }
    } else {
        echo 'error';
    }
}

function deleteUser($conn, $id) {

    if (!deleteUserDetails($conn, $id)) {
        return false; // Return false if deletion of user details fails
    }
    $sql = "DELETE FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Error in deletion
    }
}

function deleteUserdetails($conn, $id) {
    $sql = "DELETE FROM user_detail WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        return true; // Deletion successful
    } else {
        return false; // Error in deletion
    }
}



//Add User


// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'addUser') {

    
    // Escape user inputs for security
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $birthdate = mysqli_real_escape_string($conn, $_POST['birthdate']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // Insert into 'users' table
    $sql_users = "INSERT INTO users (Roles, username, password) 
                  VALUES ('User', '$username', '$hashed_password')";
    
    if (mysqli_query($conn, $sql_users)) {
        // Get the ID of the inserted user
        $user_id = mysqli_insert_id($conn);
        
        // Insert into 'user_detail' table
        $sql_user_detail = "INSERT INTO user_detail (user_id, name, role, email, address, gender, date_of_birth) 
                            VALUES ('$user_id', '$name', 'user', '$email', '$address', '$gender', '$birthdate')";
        
        if (mysqli_query($conn, $sql_user_detail)) {
            echo "User added successfully.";
        } else {
            echo "Error: " . $sql_user_detail . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $sql_users . "<br>" . mysqli_error($conn);
    }
    
    // Close database connection
    mysqli_close($conn);
} else {
    // If the form is not submitted, redirect back to the form
    header("Location: add_user.php"); // Replace with your form page URL
    exit();
}


?>