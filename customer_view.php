<?php
include 'config.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer View</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="mt-1">
        <h1 class="text-center text-info">Customer View</h1>
        <div id="customerResults" class="container"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $.ajax({
            type: "GET",
            url: "fetch_customer_data.php", // Replace with the correct path to your PHP script
            success: function(data) {
                var users = JSON.parse(data);
                displayUsers(users);
            },
            error: function(xhr, status, error) {
                console.error("Error fetching user data: " + error);
            }
        });

        function displayUsers(users) {
            var customerResults = $("#customerResults");
            customerResults.empty();

            if (users.length > 0) {
                var table =
                    '<table class="table bg-dark text-light"><thead><th>No</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Phone</th><th>Address</th><th>Status</th></thead><tbody>';

                for (var i = 0; i < users.length; i++) {
                    table += '<tr>';
                    table += '<td>' + (i + 1) + '</td>';
                    table += '<td>' + users[i].first_name + '</td>';
                    table += '<td>' + users[i].last_name + '</td>';
                    table += '<td>' + users[i].email + '</td>';
                    table += '<td>' + users[i].contact_information + '</td>';
                    table += '<td>' + users[i].address + '</td>';
                    table += '<td>' + users[i].activation_status + '</td>';
                    table += '</tr>';
                }

                table += '</tbody></table>';
                customerResults.append(table);
            } else {
                customerResults.text("No customers found.");
            }
        }
    });
    </script>
</body>

</html>