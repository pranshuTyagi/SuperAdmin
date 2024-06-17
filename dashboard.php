<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: index.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Super Admin Dashboard</title>
    <link rel="stylesheet" href="css/style.css">
    </head>
<body>
   
    <div class="dashboard-container">
           <h2>Welcome, <?php echo $_SESSION['role'] == 'User' ? $_SESSION['user_name'] : $_SESSION['role']; ?>!</h2>
         <!-- Super Admin Access button -->
         <div class="icon-with-text">
         <?php echo $_SESSION['role'] == 'SuperAdmin'|| $_SESSION['role'] == 'Admin' ? '<img width="50" height="50" src="https://img.icons8.com/ios/50/add-administrator.png" alt="add-administrator" id="add-user-btn"/>' : ''; ?>
         <span>ADD USER</span>
         </div>
         <div class="icon-with-text">
         <?php echo $_SESSION['role'] == 'SuperAdmin'|| $_SESSION['role'] == 'Admin' ? '<img width="50" height="50" src="https://img.icons8.com/ios/50/insert-table--v1.png" alt="insert-table--v1" id="all-user-btn"/>' : ''; ?>
         <Span>Show Employee</Span>
        </div>
          <!-- End Here -->
         
         
         <button id="fill-info-btn" style = "display:none;">Fill Information</button>
         
         <button id="profile-view-btn">Profile View</button>
         <button id="logout-btn">Logout</button>
        <div id="dashboard-data">
            
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/dashboard_script.js"></script>
</body>
</html>
