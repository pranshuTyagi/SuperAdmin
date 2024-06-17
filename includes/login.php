<?php
session_start();
require_once 'db_connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['password']) && isset($_POST['role'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
   
          
    // Prepare the SQL query
    $sql = "SELECT * FROM users WHERE username = '$username'";
    
    // Execute the query
    $result = mysqli_query($conn, $sql);
    // Check if there are any rows returned
    if (mysqli_num_rows($result) > 0) {
        // echo $username."  " .$role ;
        $row = mysqli_fetch_assoc($result);
        $user_name = $row['username'];
        $user_role = $row['Roles'];
        $user_id = $row['id'];
        $user_pass = $row['password'];
    
        if(password_verify($password, $user_pass) && $user_role == $role){
            $_SESSION['id'] = $user_id;
            $_SESSION['role'] = $user_role;
            $_SESSION['user_name'] = $user_name;
            
            echo json_encode(array("success" => True, "message" => "Successful Login"));
        }else{
            echo json_encode(array("Failed" => True, "message" => "UnSuccessful Login: Check Your Credentials"));
        }
    

    } else {
     echo json_encode(array("Failed" => True, "message" => "UnSuccessful Login: Check Your Credentials"));;
    }

    
} else {
    // If the request method is not POST or username/password parameters are not set, return an error message
    echo json_encode(array("success" => false, "message" => "Invalid request"));
}



?>
