<?php
// Assuming you've established a database connection
require_once 'includes/db_connection.php';
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $gender = $_POST['gender'];
    $dob = $_POST['birthdate'];
    $userId = $_POST['userId'];
    $role = $_POST['role'];
    
    $signImg = $_POST['signImg']; // This will contain the src attribute of #signPic
    $profileImg = $_POST['profileImg']; 

    // Handle file uploads
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_temp = $_FILES['profile_picture']['tmp_name'];
    $profile_directory = "user_files/" . $name . "/";
    if (!file_exists($profile_directory)) {
        mkdir($profile_directory, 0777, true);
    }
    $profile_path = $profile_directory . $profile_picture;
    move_uploaded_file($profile_temp, $profile_path);
    
    if(empty($profile_path)){
        $profile_path = $profileImg;
    }
    
    $signature = $_FILES['signature']['name'];
    $signature_temp = $_FILES['signature']['tmp_name'];
    $signature_directory = "user_files/" . $name . "/";
    if (!file_exists($signature_directory)) {
        mkdir($signature_directory, 0777, true);
    }
    $signature_path = $signature_directory . $signature;
    move_uploaded_file($signature_temp, $signature_path);

    if(empty($signature_path)){
        $signature_path = $signImg;
    }
    
        // Construct the UPDATE query
        $query = "UPDATE user_detail SET 
        name = '$name',
        role = '$role',
        mobile = '$mobile',
        email = '$email',
        address = '$address',
        gender = '$gender',
        date_of_birth = '$dob',
        profile_picture = '$profile_path',
        signature = '$signature_path'
        WHERE user_id = '$userId'";

    
    
    if ($conn->query($query) === TRUE) {
        echo "New record update successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    
    
}
?>
