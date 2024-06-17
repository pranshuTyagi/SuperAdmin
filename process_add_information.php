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
    $dob = $_POST['dob'];
    $role = $_POST['role'];
    
    // Handle file uploads
    $profile_picture = $_FILES['profile_picture']['name'];
    $profile_temp = $_FILES['profile_picture']['tmp_name'];
    $profile_directory = "user_files/" . $name . "/";
    if (!file_exists($profile_directory)) {
        mkdir($profile_directory, 0777, true);
    }
    $profile_path = $profile_directory . $profile_picture;
    move_uploaded_file($profile_temp, $profile_path);
    
    // print_r($profile_path);
    // die;
    $signature = $_FILES['signature']['name'];
    $signature_temp = $_FILES['signature']['tmp_name'];
    $signature_directory = "user_files/" . $name . "/";
    if (!file_exists($signature_directory)) {
        mkdir($signature_directory, 0777, true);
    }
    $signature_path = $signature_directory . $signature;
    move_uploaded_file($signature_temp, $signature_path);

    
    if($_SESSION['profile_data'][0]['user_id'] == $_SESSION['id']){
        // Construct the UPDATE query
$query = "UPDATE user_detail SET 
name = '$name',
role = '{$_SESSION['profile_data'][0]['role']}',
mobile = '$mobile',
email = '$email',
address = '$address',
gender = '$gender',
date_of_birth = '$dob',
profile_picture = '$profile_path',
signature = '$signature_path'
WHERE user_id = '{$_SESSION['id']}'";

    }else{
        // Insert data into the database
    $query = "INSERT INTO user_detail (user_id, name, role, mobile, email, address, gender, date_of_birth, profile_picture, signature)
    VALUES ('{$_SESSION['id']}', '$name', '{$_SESSION['role']}', '$mobile', '$email', '$address', '$gender', '$dob', '$profile_path', '$signature_path')";

    }
    
    if ($conn->query($query) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $conn->error;
    }
    
    
}
?>
