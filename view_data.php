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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>

<body>
    <div class="mt-1">
        <h1 class="text-center text-info">User View</h1>
        <form id="userFilterForm">
            <center>
                <label for="user_type">User Type</label>
                <select name="user_type" id="user_type">
                    <?php
// Populate user type options from the database
$sql = "SELECT * FROM user_type";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];
        $type_name = $row["user_type"];
        echo '<option value="' . $id . '">' . $type_name . '</option>';
    }
}
?>
                </select>
                <input type="submit" value="Filter Users">
            </center>
        </form>
    </div>
    <div id="userResults"></div>

    <script>
    // JavaScript for filtering user data
    $(document).ready(function() {
        $("#userFilterForm").submit(function(e) {
            e.preventDefault();
            var selectedUserType = $("#user_type").val();

            $.ajax({
                type: "POST",
                url: "view_function.php",
                data: {
                    user_type: selectedUserType
                },
                success: function(data) {
                    var users = JSON.parse(data);
                    displayUsers(users);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching user data: " + error);
                }
            });
        });

        // Display the filtered user data
        function displayUsers(users) {
            var userResults = $("#userResults");
            userResults.empty();

            if (users.length > 0) {
                var table =
                    '<div class="container"><table class="table bg-dark text-light"><thead><th>No</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Status</th><th>Action</th></thead><tbody>';

                for (var i = 0; i < users.length; i++) {
                    table += '<tr>';
                    table += '<td>' + (i + 1) + '</td>';
                    table += '<td>' + users[i].first_name + '</td>';
                    table += '<td>' + users[i].last_name + '</td>';
                    table += '<td>' + users[i].email + '</td>';
                    table += '<td>' + users[i].contact_information + '</td>';
                    table += '<td>' + users[i].address + '</td>';
                    table += '<td><span class="status" data-user-id="' + users[i].id + '">' + users[i]
                        .activation_status + '</span></td>';
                    table += '<td><button class="update-button" data-user-id="' + users[i].id +
                        '">Update</button></td>';
                    table += '</tr>';
                }

                table += '</tbody></table></div>';
                userResults.append(table);

                // Add a click event handler for update buttons
                $(".update-button").click(function() {
                    var userId = $(this).data("user-id");
                    updateStatus(userId, $(this));
                });
            } else {
                userResults.text("No users found for the selected user type.");
            }
        }

        // Function to update user status in the table
        function updateStatus(userId, buttonElement) {
            var statusSpan = buttonElement.closest('tr').find('.status');
            var currentStatus = statusSpan.text();
            var newStatus = currentStatus === "Active" ? "Inactive" : "Active";
            statusSpan.text(newStatus);

            // Send an AJAX request to update the status in the database using the exact case
            $.ajax({
                type: "POST",
                url: "update_status.php", // Replace with the correct path to the PHP file that updates the status
                data: {
                    user_id: userId,
                    status: newStatus
                },
                success: function(response) {
                    // Handle the response (e.g., update the UI)
                    alert("Status updated to " + newStatus + " successfully.");
                    // You can refresh the user list or make other UI updates here
                },
                error: function(xhr, status, error) {
                    console.error("Error updating user status: " + error);
                }
            });
        }
    });
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>