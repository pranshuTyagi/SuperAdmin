$(document).ready(function() {
    
    function loadContent(url) {
               
        $.ajax({
            url: url,
            type: 'POST', // Or 'GET' depending on your server configuration
            success: function(response) {
                $('#dashboard-data').html(response);
                
            },
            error: function(xhr, status, error) {
                var errorMessage = xhr.responseText;
                console.error(errorMessage);
                
                // Check if the error message indicates that the profile is not found
                if (errorMessage.includes("User details not found.")) {
                    
                    $('#fill-info-btn').removeAttr('style');
                    location.reload();
                } else {
                    // If it's not a profile not found error, handle accordingly
                    console.error("An error occurred: " + errorMessage);
                }

                 
            }
        });
    }

    $(document).on('click', '.pagination-link a', function(e) {
        e.preventDefault(); // Prevent the default action of the link
    
        var page = $(this).attr('href').match(/page=(\d+)/)[1]; // Extract the page number from the href
         // Now you can use the 'page' variable to load content or perform other actions
        // Uncomment the following line if you want to use it to load content
        loadContent('employee_table.php?page=' + page);
    });


        // Fill Information button click handler
        $('#fill-info-btn').click(function() {
            loadContent('add_information.php');
        });
    


    // Profile View button click handler
    $('#profile-view-btn').click(function() {
        
        loadContent('profile_view.php');
    });

    // Profile View button click handler
    $('#all-user-btn').click(function() {
        loadContent('employee_table.php?page=1');
    });

    

    //Edit Information button click handler
    $('#edit-info-btn').click(function() {
        
        // Implement edit information functionality
        loadContent('add_information.php');

        

    });


    // Employee table script Edit &  Add delete-user-from-table
    $('#add-user-btn').click(function() {
        
        // Implement edit information functionality
        loadContent('add_user.php');

        

    });

    $('#edit-user-from-table').click(function(e) {
        e.preventDefault();
    
        var userId = $(this).data('userid');
           
        fetchUserData(userId, function(data) {
            
            if (data && !data.error) {
                // Do something with the fetched data if successful
                console.log('Fetched user data:', data);
                // Populate form fields with fetched data
                $('#name').val(data.name);
                $('#email').val(data.email);
                $('#address').val(data.address);
                $('#gender').val(data.gender);
                $('#birthdate').val(data.date_of_birth);
                $('#role').val(data.role);
                $('#signPic').attr('src', data.signature);
                $('#profilePic').attr('src', data.profile_picture);
                $('#password').val('************');
                $('#username').val('username********');
            } else {
                // Handle error condition
                console.error('Failed to fetch user data:', data.error);
                // Optionally show an error message to the user
            }
        });
    
        // Call loadContent function with the user ID parameter
        loadContent('edit_user.php?user=' + userId);
    });
    
    // Function to fetch existing user data and populate the form
    function fetchUserData(userId, callback) {
        // Make an AJAX request to fetch user data
        
        $.ajax({
            url: 'fetch_user_data.php',
            type: 'GET',
            data: { userId: userId },
            dataType: 'json',
            success: function(data) {
                // Pass data to the callback function
                
                callback(data);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching user data:', error);
                // Pass null or an error object to the callback function
                callback({ error: 'Failed to fetch user data' });
            }
        });
    }
    


    
    

    // Delete User Data 
    $('#delete-user-from-table').click(function(e) {
        e.preventDefault();
        var userId = $(this).data('userid');

    $.ajax({
        type: 'POST',
        url: 'add_delete.php',
        data: { action: 'deleteUser', userId: userId },
        success: function(response) {
            if (response === 'success') {
                // Optionally, reload content after deletion
                loadContent('employee_table.php'); // Reloads the page after deletion
            } else {
                alert('Failed to delete user.');
            }
        },
        error: function(xhr, status, error) {
            console.error("An error occurred while deleting: " + error);
            alert('Failed to delete user due to a server error. Please try again later.');
        }
    });
        

    });

    
});
