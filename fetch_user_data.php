<?php
include 'includes/db_connection.php';


// Check if userId is provided in the URL parameters
if (isset($_GET['userId'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['userId']);
    
    // Query to fetch user data based on userId
    $sql = "SELECT * FROM user_detail WHERE user_id = '$userId'";
    $result = mysqli_query($conn, $sql);
   
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Return user data as JSON response
        echo json_encode($row);
        
    } else {
        echo json_encode(['error' => 'User not found']);
    }
} else {
    // If userId is not provided in the URL parameters
    echo json_encode(['error' => 'Invalid request']);
}
?>