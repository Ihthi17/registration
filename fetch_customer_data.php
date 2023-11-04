<?php
include 'config.php';

$sql = "SELECT * FROM user_type
        JOIN users ON user_type.id = users.user_type_id
        WHERE user_type.user_type = 'customer'";
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
    echo 'Error fetching user data: ' . $con->error;
}
?>