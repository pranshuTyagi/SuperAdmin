<?php
require_once 'includes/db_connection.php';
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}
// store idividual user data in session
$profile_data = array();


//end here
// Check if user is logged in or get user ID from session
$user_id = 1; // Example user ID, you can replace it with the actual user ID or retrieve it from session

// Prepare query
$query = "SELECT * FROM user_detail WHERE user_id = ?";
$stmt = $conn->prepare($query);

// Bind parameters
$stmt->bind_param("i", $_SESSION['id']);

// Execute query
$stmt->execute();

// Get result
$result = $stmt->get_result();




try {
  if ($result->num_rows > 0) {
      // Fetch data
      $user = $result->fetch_assoc();
      // Display user data
      $profile_data[] = $user;
      $_SESSION['profile_data'] = $profile_data;
    
      echo '
      
      <div class="container">   
         <div class="main-body">
             <div class="row gutters-sm">
              <div class="col-md-4 mb-3">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-column align-items-center text-center">
                    <div class="image-container">
                      <img src="'.($user['profile_picture'] != '' ? $user['profile_picture'] : 'Project/img/admin.jpg') .'" alt="Admin" class="rounded-circle" width="150">
                      <div class="image-text"> <p>Profile Picture</p></div>
                     </div> <div class="image-container">
                      <img src="'.$user['signature'].'" alt="Admin" class="rounded-circle" width="150">
                      <div class="image-text"> <p>signature</p></div></div>
                      <div class="mt-3">
                        <h4>' . $user['name'] . '</h4>
                        <p class="text-secondary mb-1">'.($user['role'] == 'user' ? 'Employee' : $_SESSION['role']).'</p>
                        <p class="text-muted font-size-sm">' . $user['address'] . '</p>
                        <button class="btn btn-primary">Follow</button>
                        <button class="btn btn-outline-primary" id="edit-info-btn">Edit Profile</button>
                      </div>
                    </div>
                  </div>
                </div>
                
              </div>
              <div class="col-md-8">
                <div class="card mb-3">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Full Name</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        '. $user['name'] .'
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Email</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        '. $user['email'] .'
                      </div>
                    </div>
                    <hr>
                      <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Mobile</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                       '. $user['mobile'] .'
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Address</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        '. $user['address'] . '
                      </div>
                    </div>
                    <hr>
                    <div class="row">
                      <div class="col-sm-3">
                        <h6 class="mb-0">Date of Birth</h6>
                      </div>
                      <div class="col-sm-9 text-secondary">
                        '. $user['date_of_birth'] . '
                      </div>
                    </div>
                    <hr>
                  </div>
                </div>
                ';
          // Display other user data similarly
  } else {
      // Throw a custom exception if user details are not found
      throw new Exception("User details not found.");
  }
} catch (Exception $e) {
  http_response_code(500); // Set HTTP status code to indicate server error
    echo "An error occurred: " . $e->getMessage();
  
}

?>
<script src="js/dashboard_script.js"></script>
