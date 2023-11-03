<?php
include 'config.php';

$fname = $_POST['fname'];
$lname = $_POST['lname'];
$mail = $_POST['mail'];
$phone = $_POST['phone'];
$address = $_POST['address'];
$username = $_POST['username'];
$pass = $_POST['pass'];
$user_type = $_POST['user_type'];
$registration_date = date("Y-m-d H:i:s");

$sql = "INSERT INTO `users`(`first_name`, `last_name`, `email`, `contact_information`, `address`, `username`, `password`, `user_type_id`, `registration_date`) VALUES ('$fname','$lname','$mail','$phone','$address','$username','$pass','$user_type','$registration_date')";

if ($con->query($sql) === true) {
    $last_inserted_id = $con->insert_id; // Get the last inserted ID
    echo "Data inserted successfully with ID: " . $last_inserted_id;
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
