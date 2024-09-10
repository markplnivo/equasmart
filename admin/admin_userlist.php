<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<title>User List</title>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
<style>
    /* Global styles */
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
        padding: 0;
        background-color: #f4f4f4;
        color: #333;
        display: grid;
        grid-template-rows: 10vh 1fr 10vh;
        grid-template-columns: 1fr 3fr 1fr;
        height: 100%;
        grid-gap: 20px;
        overflow: hidden;
    }

    header {
        background-color: mediumaquamarine;
        color: white;
        padding: 15px;
        text-align: center;
        grid-row: 1 / 2;
        grid-column: 1 / -1;
        width: 100%;
        height: 100%;
    }

    #maintable {
        grid-area: 2 / 2 / 3 / 3;
        width: 95%;
        place-self: start center;
        overflow-x: auto;
        max-width: 1200px;
        background-color: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.9);
        border-radius: 8px;
        padding: 20px;
        margin-top: 30px; /* Adjust this value to move the table down */
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

    h1 {
        margin: 0;
        color: black;
    }
</style>

<body>
    <header>
        <h1>User List</h1>
    </header>
    <?php
    include "admin_menu.php";

    $limit = 10; // Number of entries to show in a page.
    if (isset($_GET["page"])) {
        $pn  = $_GET["page"];
    } else {
        $pn = 1;
    };

    $start_from = ($pn - 1) * $limit;

    $sql = "SELECT UserID, Username, EmailAddress, ContactNumber, position, firstname, lastname FROM users ORDER BY UserID ASC LIMIT $start_from, $limit";
    $rs_result = mysqli_query($conn, $sql);
    ?>
    <form method="post" action="admin_home.php">
        <div id="maintable">
            <input type="text" id="searchInput" placeholder="Search for names...">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Change Role</th>
                    <th>User ID</th>
                    <th>Username</th>
                    <th>Job Position</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($rs_result)) {
                ?>
                    <tr>
                        <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["EmailAddress"]; ?>"></td>
                        <td>
                            <select name="role_<?php echo str_replace('.', '_', $row["EmailAddress"]); ?>">
                                <option value="Agent">Agent</option>
                                <option value="Artist">Artist</option>
                                <option value="Manager">Manager</option>
                            </select>
                        </td>
                        <td><?php echo $row["UserID"]; ?></td>
                        <td><?php echo $row["Username"]; ?></td>
                        <td><?php echo $row["position"]; ?></td>
                        <td><?php echo $row["EmailAddress"]; ?></td>
                        <td><?php echo $row["ContactNumber"]; ?></td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                    </tr>
                <?php
                };
                ?>
            </table>
            <input id="addSelect" type="submit" name="add_selected" value="Add Selected">
            <input id="removeSelect" type="submit" name="remove_selected" value="Archive">
    </form>

    <div id="pageNumbers">
        <?php
        $sql = "SELECT COUNT(*) FROM users";
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
</body>

<?php
if (isset($_POST['remove_selected'])) {
    // Check if any rows were selected for removal
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Create a string of placeholders based on the number of selected rows
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));

        // Prepare the SQL statement to insert the records into the recyclebin table
        $insertSql = "INSERT INTO recyclebin_account_request (firstname, lastname, email, contact_number, request_time, username, user_password) 
                      SELECT firstname, lastname, email, contact_number, request_time, username, user_password
                      FROM account_request 
                      WHERE email IN ($placeholders)";

        // Create a prepared statement
        if ($stmt = $conn->prepare($insertSql)) {
            // Bind each email to its own placeholder
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);

            // Execute the statement to insert the selected rows into the recyclebin table
            $stmt->execute();
        }

        // Prepare the SQL statement to delete the records from the original table
        $deleteSql = "DELETE FROM account_request WHERE email IN ($placeholders)";

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
        header("Location: admin_home.php");
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
