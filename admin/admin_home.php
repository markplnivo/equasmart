<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* Global styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #919191;
            color: #FFFFFF;
            display: grid;
            grid-template-rows: 10vh 1fr 10vh;
            grid-template-columns: 300px auto 0.5fr;
            height: 100%;
            grid-gap: 50px;
        }

        header {
            /* background-image: url("images/artist_home_header.jpg"); */
            background-repeat: no-repeat;
            background-color: #292929;
            color: #fff;
            font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
            padding: 10px;
            text-align: center;
            grid-row: 1 / 2;
            grid-column: 1 / -1;
            width: 100vw;
            height: 100%;
        }

        #maintable {
            display: grid;
            grid-template-columns: auto;
            grid-template-rows: auto auto auto;
            grid-area: 2 / 2 / 3 / 3;
            height: 25vh;
            width: 100%;
            place-self: start center;
            row-gap: 20px;
            min-width: 1000px;
        }

        table {
            grid-area: 2 / 1 / 3 / -1;
            color: white;
            font-family: monospace;
            font-size: 0.9rem;
            text-align: center;
            border: 0px solid #FFFFFF;
            background-color: lightgray;
            border-collapse: collapse;
            width: 100%;
        }

        table,
        th,
        td {
            color: black;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #ffc400;
            color: #000;
        }

        tr {
            border: 1px solid black;
        }

        .trHover:hover {
            background-color: white;
        }

        #pageNumbers {
            margin-left: auto;
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            width: 100px;
            font-size: 1.2rem;

        }

        #addSelect {
            background-color: #ffc400;
            border-radius: 8px;
            border: 0 solid;
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            height: 50px;
            width: 100px;
            place-self: start start;
            transition-duration: .3s;
        }

        #removeSelect {
            background-color: #ffc400;
            border-radius: 8px;
            border: 0 solid;
            grid-column: 1 / -1;
            grid-row: 3 / 4;
            height: 50px;
            width: 120px;
            margin-left: 200px;
            transition-duration: .15s;
        }

        #searchInput {
            grid-area: 1 / 1 / 1 / 1;
            width: 300px;
            height: 25px;
            place-self: end;
            border: 0 solid;
            border-radius: 4px;
            background-color: lightyellow;
        }

        #addSelect:hover {
            cursor: pointer;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
        }

        #removeSelect:hover {
            cursor: pointer;
            box-shadow: 3px 3px 6px rgba(0, 0, 0, 0.4);
        }

        #addSelect:active {
            margin-top: 2px;
            margin-left: 2px;
            box-shadow: none;
        }

        #removeSelect:active {
            margin-top: 2px;
            margin-left: 202px;
            box-shadow: none;
        }

        input[type="checkbox"] {
            cursor: pointer;
            height: 20px;
            width: 20px;
            accent-color: #ffc400;
            border: 1px solid black;
            border-radius: 5px;
        }

        select {
            background-color: lightyellow;
            height: 25px;
            border: 2px solid #ffc400;
            border-radius: 8px;
            cursor: pointer;
        }
    </style>


<body>
    <header>
        <h1>equaSmart Account Requests</h1>
        <h1 style="font-size: 20px; color: red;">Administrator Use Only</h1>
    </header>
    <?php
    include "admin_menu.php";

    $limit = 30; // Number of entries to show in a page.
    // Look for a GET variable page if not found default is 1.  
    if (isset($_GET["page"])) {
        $pn  = $_GET["page"];
    } else {
        $pn = 1;
    };

    $start_from = ($pn - 1) * $limit;

    $sql = "SELECT firstname, lastname, email, contact_number, request_time, username FROM account_request ORDER BY request_time DESC LIMIT $start_from, $limit";
    $rs_result = mysqli_query($conn, $sql);
    ?>
    <form method="post" action="admin_home.php">
        <div id="maintable">
            <input type="text" id="searchInput" placeholder="Search for names...">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Assign Role</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                    <th>Request Time</th>
                </tr>
                <?php
                while ($row = mysqli_fetch_assoc($rs_result)) {
                ?>
                    <tr class="trHover">
                        <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                        <td>
                            <select name="role[]">
                                <option value="admin">Admin</option>
                                <option value="LeadTech">Lead Technician</option>
                                <option value="ViewOnly">View Only</option>
                                <option value="Plants">Superadmin</option>
                                <option value="Fish">Superadmin</option>
                                <option value="Water Testing">Superadmin</option>
                            </select>
                        </td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["contact_number"]; ?></td>
                        <td><?php echo date("h:i A, M j", strtotime($row["request_time"])); ?></td>
                    </tr>
                <?php
                };
                ?>
            </table>
            <input id="addSelect" type="submit" name="add_selected" value="Add Selected">
            <input id="removeSelect" type="submit" name="remove_selected" value="Remove Selected">
    </form>

    <div id="pageNumbers">
        <?php
        $sql = "SELECT COUNT(*) FROM account_request";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        $pagLink = "<div class='pagination'>";
        for ($i = 1; $i <= $total_pages; $i++) {
            $pagLink .= "<a href='admin_home.php?page=" . $i . "'>" . $i . "</a>";
        };
        echo $pagLink . "</div>";
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

if (isset($_POST['add_selected'])) {
    // Check if any rows were selected for addition
    if (isset($_POST['selected_rows']) && is_array($_POST['selected_rows'])) {
        // Loop over the selected rows and assign roles
        for ($i = 0; $i < count($_POST['selected_rows']); $i++) {
            // Get the email and role for the current row
            $email = $_POST['selected_rows'][$i];
            $role = $_POST['role'][$i];

            // Prepare the SQL statement to insert the record into the tbl_userlist table
            $insertSql = "INSERT INTO users (Username, PasswordHash, EmailAddress, ContactNumber, position, firstname, lastname) 
                SELECT username, user_password, email, contact_number, ?, firstname, lastname 
                FROM account_request 
                WHERE email = ?";

            // Create a prepared statement
            if ($stmt = $conn->prepare($insertSql)) {
                // Bind the role and email as parameters
                $stmt->bind_param('ss', $role, $email);

                // Execute the statement to insert the selected row into the tbl_userlist table
                $stmt->execute();

                // Close the prepared statement
                $stmt->close();
            } else {
                // Handle any errors with the prepared statement
                echo "Error: " . $conn->error;
            }
        }

        /*** This code is from artist_home.php and was moved to superadmin_home.php ***/
        // Check tbl_userlist for new usernames with job_position 'Artist'
        // $sqlCheckNewArtists = "SELECT username FROM tbl_userlist WHERE job_position = 'Artist' AND username NOT IN (SELECT artist_name FROM tbl_artist_status)";
        // $resultCheckNewArtists = $conn->query($sqlCheckNewArtists);

        // // Insert new artists into tbl_artist_status
        // if ($resultCheckNewArtists->num_rows > 0) {
        //     $insertSql = "INSERT INTO tbl_artist_status (artist_name, artist_status) VALUES (?, 'open')";
        //     $stmtInsert = $conn->prepare($insertSql);

        //     while ($row = $resultCheckNewArtists->fetch_assoc()) {
        //         $newArtistName = $row['username'];
        //         $stmtInsert->bind_param("s", $newArtistName);
        //         $stmtInsert->execute();
        //     }

        //     $stmtInsert->close();
        // }

        // Prepare the SQL statement to delete the records from the original table
        $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));
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

        $_POST['selected_rows'] = array();
        header("Location: admin_home.php");
        exit(); // Terminate script execution after redirection
    }
}
?>
<script>
    // Get the input element and table
    var input = document.getElementById("searchInput");
    var table = document.querySelector("table");

    // Add an event listener to the input field
    input.addEventListener("keyup", function() {
        var filter = input.value.toUpperCase();
        var rows = table.querySelectorAll("tr.trHover");

        // Loop through all table rows
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].querySelectorAll("td");
            var found = false;

            // Loop through all table cells in a row
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

            // Toggle row visibility based on search result
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