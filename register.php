<?php
include 'config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>

<body>
    <h1 class="text-center text-primary"> User Registration</h1>
    <form id="form_data">
        <label for="">First Name</label>
        <input type="text" id="fname" name="fname" placeholder="Enter the First Name" required><br><br>
        <label for="">Last Name</label>
        <input type="text" id="lname" name="lname" placeholder="Enter the last Name" required><br><br>
        <label for="">Mail</label>
        <input type="email" id="email" name="email" placeholder="Enter the Mail" required><br><br>
        <label for="">Contact No</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter the Phone No" required><br><br>
        <label for="">Address</label>
        <input type="text" id="address" name="address" placeholder="Enter the Address" required><br><br>
        <label for="">User Name </label>
        <input type="text" id="username" name="username" placeholder="Enter the Username" required><br><br>
        <label for="">Password</label>
        <input type="password" id="pass" name="pass" placeholder="Enter the Password" required><br><br>
        <label for="user_type">User Type</label>
        <?php
$sql = "SELECT * FROM user_type";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    ?>
        <select name="user_type" id="user_type">
            <?php
while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $type_name = $row["user_type"];
        echo '<option value="' . $id . '">' . $type_name . '</option>';
    }
}
?>
        </select> <br><br>

        <button class="btn btn-primary">Register </button>
    </form>
    <br><br><br>

    <div class="padding-right">
        <a class="btn btn-primary" href="view_data.php">View</a>
    </div>
    <script>
    //user registration
    $(document).ready(function() {
        $("#form_data").submit(function(e) {
            e.preventDefault();

            // Get data from the form
            var fname = $("#fname").val();
            var lname = $("#lname").val();
            var mail = $("#email").val();
            var phone = $("#phone").val();
            var address = $("#address").val();
            var username = $("#username").val();
            var pass = $("#pass").val();
            var user_type = $("#user_type").val();

            $.ajax({
                type: "POST",
                url: "add_function.php",
                data: {
                    fname: fname,
                    lname: lname,
                    mail: mail,
                    phone: phone,
                    address: address,
                    username: username,
                    pass: pass,
                    user_type: user_type
                },
                success: function(response) {
                    // Display a SweetAlert message
                    Swal.fire({
                        title: 'Registration Successful!',
                        text: 'You have been registered.',
                        icon: 'success',
                        showCancelButton: false,
                        showConfirmButton: false,
                        timer: 1500 // Auto-close after 1.5 seconds
                    });

                    // Optionally, reset the form after successful registration
                    document.getElementById("form_data").reset();
                }
            });
        });
    });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>

</body>

</html>