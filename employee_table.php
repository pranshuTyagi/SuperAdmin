<?php
  session_start();
// Assume you have already fetched employee data from the database and stored it in $employeeData array
include 'includes/db_connection.php';
include 'model/usermanagement.php';
  
    storeUserDetailsInSession($conn);
// Example $employeeData array structure
$employeeData = $_SESSION['user_data'];
$employeesPerPage = 1;
$totalEmployees = count($employeeData);
$totalPages = ceil($totalEmployees / $employeesPerPage);

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($page - 1) * $employeesPerPage;
$end = $start + $employeesPerPage;
$employeeDataPage = array_slice($employeeData, $start, $employeesPerPage);


?>

<body>
    <h2>Employee Data</h2>
    <table>
        <thead>
            <tr>
                
                <th>Name</th>
                <th>Role</th>
                <th>Mobile</th>
                <th>Email</th>
                <th>Address</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Profile Picture</th>
                <th>Signature</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($employeeDataPage as $employee) : ?>
                <tr>
                   
                    <td><?php echo $employee['name']; ?></td>
                    <td><?php echo $employee['role']; ?></td>
                    <td><?php echo $employee['mobile']; ?></td>
                    <td><?php echo $employee['email']; ?></td>
                    <td><?php echo $employee['address']; ?></td>
                    <td><?php echo $employee['gender']; ?></td>
                    <td><?php echo $employee['date_of_birth']; ?></td>
                    <td><img src="<?php echo $employee['profile_picture']; ?>" alt="Profile Picture" width="50"></td>
                    <td><img src="./<?php echo $employee['signature']; ?>" alt="Signature" width="50"></td>
                    <td>
                        <!-- Add action buttons here -->
                        <button id="edit-user-from-table" data-userid="<?php echo $employee['user_id']; ?>">Edit</button>
                        <button id="delete-user-from-table" data-userid="<?php echo $employee['user_id']; ?>">Delete</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    
     <!-- Pagination Links -->
     <?php if ($totalPages > 1) : ?>
    <div class = "pagination-link">
        <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
            <a href="?page=<?php echo $i; ?>" id="page<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div>
<?php endif; ?>

</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/script.js"></script>
    <script src="js/dashboard_script.js"></script>
</html>
