<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<title>Recyle Bin</title>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <style>
        /* Global styles */
        body {
            display: grid;
        grid-template-columns: auto 1fr;
        grid-template-rows: auto;
        margin: 0;
        height: 100vh;
    }
    .container_menu {
        grid-area: 1 / 2 / -1 / -1;
        grid-template-columns: 1fr;
        background-color: azure;
    }
    h1 {
        font-family: verdana;
            text-align: center;
        height: 5%;
        }

        #maintable {
        width: 92%;
        height: auto;
        background-color: lemonchiffon;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);
        border-radius: 15px;
            padding: 20px;
        margin-left: 2%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th,
        td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: mediumaquamarine;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        #pageNumbers {
            margin-top: 20px;
            text-align: center;
            grid-column: 2 / 3;
            grid-row: 3 / 4;
        }

        #pageNumbers a {
            color: #0073e6;
            padding: 8px 16px;
            text-decoration: none;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin: 0 4px;
            transition: background-color 0.3s ease;
        }

        #pageNumbers a:hover {
            background-color: #0073e6;
            color: white;
        }

        #addSelect,
        #removeSelect {
            background-color: #0073e6;
            color: white;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            margin-right: 10px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        #addSelect:hover {
            background-color: #005bb5;
        }

        #removeSelect {
            background-color: #dc3545; /* Warning color (Bootstrap's danger color) */
        }

        #removeSelect:hover {
            background-color: #c82333; /* Darker shade for hover effect */
        }

        #searchInput {
            padding: 10px;
            width: 50%;
            margin-left: 480px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        input[type="checkbox"] {
            cursor: pointer;
            height: 20px;
            width: 20px;
            accent-color: #0073e6;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        select {
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            background-color: #f9f9f9;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        select:hover {
            border-color: #0073e6;
        }

    /* Mobile responsiveness */
    @media (max-width: 1010px) {
        .container_menu {
            grid-template-columns: auto;
            grid-template-rows: auto;
            padding: 0px;
        }

        #maintable {
            width: 98%;
            margin: 0px;
            border-radius: 10px;
            display: flex;
            flex-direction: column; /* Stacks elements vertically */
        }

        #searchInput {
            width: 90%;
            margin: 10px auto;
        }

        table, th, td {
            display: block;
            width: 100%;
        }

        tr {
            display: flex;
            flex-direction: column;
            margin-bottom: 10px;
        }

        th, td {
            text-align: left;
            padding: 8px;
            border-bottom: none; /* Removes borders between each cell */
        }

        #pageNumbers {
            margin-top: 20px;
            text-align: center;
        }
        }
    </style>


<body>
        
    <?php
    include "admin_menu.php";

    $limit = 30;
    if (isset($_GET["page"])) {
        $pn  = $_GET["page"];
    } else {
        $pn = 1;
    };

    $start_from = ($pn - 1) * $limit;

    $sql = "SELECT firstname, lastname, email, contact_number, request_datetime, username FROM recyclebin_account_request ORDER BY request_datetime DESC LIMIT $start_from, $limit";
    $rs_result = mysqli_query($conn, $sql);
    ?>
    <div class="container_menu">
    <h1>Recyle Bin</h1>
    <div class="container">    <form method="post" action="admin_recyclebin.php">
        <div id="maintable">
            <input type="text" id="searchInput" placeholder="Search for names...">
            <table>
                <tr>
                    <th>Select</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($rs_result)) {
                ?>
                    <tr>
                        <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["contact_number"]; ?></td>
                        <td><?php echo date("h:i A, M j", strtotime($row["request_datetime"])); ?></td>
                    </tr>
                <?php
                };
                ?>
            </table>
            <input id="addSelect" type="submit" name="add_selected" value="Undo">
            <input id="removeSelect" type="submit" name="remove_selected" value="Remove Permanent">
    </form>

    <div id="pageNumbers">
        <?php
        $sql = "SELECT COUNT(*) FROM account_request";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        $pagLink = "";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<a href='admin_home.php?page=" . $i . "'>" . $i . "</a>";
        };
        echo $pagLink;
        ?>
    </div>
    </div>
    </div>
    </div>
</body>

<?php
if (isset($_POST['remove_selected'])) {
    // Check if any rows were selected for removal
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Create a string of placeholders based on the number of selected rows
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));

        // Prepare the SQL statement to delete the records from the original table
        $deleteSql = "DELETE FROM recyclebin_account_request WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($deleteSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to delete the selected rows from the original table
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();
        }

        $_POST['selected_rows'] = array(); // Clear the selected rows array
        header("Location: admin_recyclebin.php");
        exit(); // Terminate script execution after redirection
    }
}


if (isset($_POST['add_selected'])) {
    // Check if any rows were selected for addition
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Loop over the selected rows and assign roles
        for ($i = 0; $i < count($_POST['selected_rows']); $i++) {
            // Get the email and role for the current row
            $email = $_POST['selected_rows'][$i];
            // $role = $_POST['role'][$i];

            // Prepare the SQL statement to insert the record into the tbl_userlist table
            $insertSql = "INSERT INTO users (Username, PasswordHash, EmailAddress, ContactNumber, firstname, lastname, account_creation) 
                SELECT username, user_password, email, contact_number, firstname, lastname, NOW()
                FROM account_request 
                WHERE email = ?";

            // Create a prepared statement
            if ($stmt = $conn->prepare($insertSql)) {
                // Bind the role and email as parameters
                // $stmt->bind_param('ss', $role, $email);
                $stmt->bind_param('s', $email);

                // Execute the statement to insert the selected row into the tbl_userlist table
                $stmt->execute();

                // Get the newly inserted user's ID
                $new_user_id = $conn->insert_id;

                // Close the prepared statement
                $stmt->close();

                // Assign the "view_only" privilege to the new user by default
                $viewOnlySql = "INSERT INTO user_permissions (user_id, permission_id) 
                  SELECT ?, permission_id FROM permissions WHERE permission_name = 'view_only'";

                // Create a prepared statement
                if ($stmt = $conn->prepare($viewOnlySql)) {
                    // Bind the user ID as a parameter
                    $stmt->bind_param('i', $new_user_id);

                    // Execute the statement to insert the default permission
                    $stmt->execute();

                    // Close the prepared statement
                    $stmt->close();
                } else {
                    echo "Error assigning default permission: " . $conn->error;
                }
            } else {
                // Handle any errors with the prepared statement
                echo "Error: " . $conn->error;
            }
        }

        // Prepare the SQL statement to delete the records from the original table
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));
        $deleteSql = "DELETE FROM recyclebin_account_request WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($deleteSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to delete the selected rows from the original table
            $stmt->execute();

            // Close the prepared statement
            $stmt->close();
        }

        $_POST['selected_rows'] = array();
        header("Location: admin_recyclebin.php");
        exit(); // Terminate script execution after redirection
    }
}
?>
<script>
    var input = document.getElementById("searchInput");
    var table = document.querySelector("table");

    input.addEventListener("keyup", function() {
        var filter = input.value.toUpperCase();
        var rows = table.querySelectorAll("tr");

        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].querySelectorAll("td");
            var found = false;

            for (var j = 0; j < cells.length; j++) {
                var cell = cells[j];
                if (cell) {
                    var textValue = cell.textContent || cell.innerText;
                    if (textValue.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
            }

            if (found) {
                rows[i].style.display = "";
            } else {
                rows[i].style.display = "none";
            }
        }
    });
</script>


</html>
<?php ob_end_flush(); ?>
