<?php
include 'config.php';

if (isset($_POST['user_id']) && isset($_POST['status'])) {
$user_id = $_POST['user_id'];
$newStatus = $_POST['status'];

// Update the user status in the database
$sql = "UPDATE users SET activation_status = '$newStatus' WHERE id = $user_id";
if ($con->query($sql) === TRUE) {
echo "Status updated successfully.";
} else {
echo "Error updating status: " . $con->error;
}
} else {
echo "Invalid data sent to the server.";
}
?>