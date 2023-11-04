<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_type'])) {
    // Get the selected user type from the form
    $selectedUserType = $_POST['user_type'];

    // Perform a query to fetch users based on the selected user type
    $sql = "SELECT * FROM users WHERE user_type_id = $selectedUserType";
    $result = $con->query($sql);

    if ($result) {
        $users = array();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
        }

        // Return the filtered data as JSON
        echo json_encode($users);
    } else {
        // Handle query error
        echo 'Error fetching user data';
    }
}



?>