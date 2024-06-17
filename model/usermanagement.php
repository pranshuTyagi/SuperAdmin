<?php
    // Include database connection
    include 'includes/db_connection.php';
    


    function storeUserDetailsInSession($conn) {
        // Initialize an empty array to store all rows
        $user_data = array();
    
        // Query to select all user details
        $query = "SELECT * FROM user_detail";
        $resultdata = mysqli_query($conn, $query);
    
        if(mysqli_num_rows($resultdata) > 0) {
            while($rows = mysqli_fetch_assoc($resultdata)){
                // Append each row to the $user_data array
                $user_data[] = $rows;
            }
        }
    
        // Store the user data array in the session
        $_SESSION['user_data'] = $user_data;
    }
    
    
?>