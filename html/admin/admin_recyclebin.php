<?php 
ob_start();
include "../logindbase.php"; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recycle Bin</title>
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
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
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

        #addSelect, #removeSelect {
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
            background-color: #dc3545;
        }

        #removeSelect:hover {
            background-color: #c82333;
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

        h1 {
            margin: 0;
            color: black;
        }
    </style>
</head>
<body>
    <header>
        <h1>Recycle Bin</h1>
    </header>
    <?php include "admin_menu.php"; ?>

    <form method="post" action="admin_recyclebin.php">
        <div id="maintable">
            <input type="text" id="searchInput" placeholder="Search for names...">
            <table>
                <tr>
                    <th>Select</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Contact Number</th>
                </tr>
                <?php
                $limit = 30;
                $pn = isset($_GET["page"]) ? $_GET["page"] : 1;
                $start_from = ($pn - 1) * $limit;

                $sql = "SELECT firstname, lastname, email, contact_number, request_datetime, username 
                        FROM recyclebin_account_request 
                        ORDER BY request_datetime DESC LIMIT $start_from, $limit";
                $rs_result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($rs_result)) { ?>
                    <tr>
                        <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                        <td><?php echo $row["firstname"]; ?></td>
                        <td><?php echo $row["lastname"]; ?></td>
                        <td><?php echo $row["username"]; ?></td>
                        <td><?php echo $row["email"]; ?></td>
                        <td><?php echo $row["contact_number"]; ?></td>
                    </tr>
                <?php } ?>
            </table>
            <input id="addSelect" type="submit" name="add_selected" value="Undo">
            <input id="removeSelect" type="submit" name="remove_selected" value="Remove Permanent">
        </div>
    </form>

    <div id="pageNumbers">
        <?php
        $sql = "SELECT COUNT(*) FROM account_request";
        $rs_result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_row($rs_result);
        $total_records = $row[0];
        $total_pages = ceil($total_records / $limit);
        for ($i = 1; $i <= $total_pages; $i++) {
            echo "<a href='admin_home.php?page=" . $i . "'>" . $i . "</a>";
        }
        ?>
    </div>

    <?php
    if (isset($_POST['add_selected']) && !empty($_POST['selected_rows'])) {
        $conn->begin_transaction(); 

        try {
            foreach ($_POST['selected_rows'] as $email) {
                $insertSql = "
                    INSERT INTO users (Username, PasswordHash, EmailAddress, ContactNumber, firstname, lastname, account_creation) 
                    SELECT username, user_password, email, contact_number, firstname, lastname, NOW()
                    FROM recyclebin_account_request 
                    WHERE email = ?";

                $stmt = $conn->prepare($insertSql);
                if (!$stmt) throw new Exception("Prepare failed: " . $conn->error);

                $stmt->bind_param('s', $email);
                $stmt->execute();

                if ($stmt->affected_rows === 0) {
                    throw new Exception("Failed to restore user with email: $email");
                }

                $stmt->close();
            }

            $placeholders = implode(',', array_fill(0, count($_POST['selected_rows']), '?'));
            $deleteSql = "DELETE FROM recyclebin_account_request WHERE email IN ($placeholders)";
            $stmt = $conn->prepare($deleteSql);
            $stmt->bind_param(str_repeat('s', count($_POST['selected_rows'])), ...$_POST['selected_rows']);
            $stmt->execute();
            $stmt->close();

            $conn->commit();
            header("Location: admin_recyclebin.php");
            exit();
        } catch (Exception $e) {
            $conn->rollback(); 
            error_log("Transaction failed: " . $e->getMessage());
            header("Location: admin_recyclebin.php?error=1");
            exit();
        }
    }

    if (isset($_POST['remove_selected']) && !empty($_POST['selected_rows'])) {
        $emails = implode("','", $_POST['selected_rows']);
        $deleteSql = "DELETE FROM recyclebin_account_request WHERE email IN ('$emails')";
        if (mysqli_query($conn, $deleteSql)) {
            header("Location: admin_recyclebin.php");
            exit();
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
    ?>

    <script>
        var input = document.getElementById("searchInput");
        input.addEventListener("keyup", function () {
            var filter = input.value.toUpperCase();
            var rows = document.querySelectorAll("table tr");
            rows.forEach((row, index) => {
                if (index === 0) return;
                const match = Array.from(row.cells).some(cell => cell.textContent.toUpperCase().includes(filter));
                row.style.display = match ? "" : "none";
            });
        });
    </script>
</body>
</html>
<?php ob_end_flush(); ?>
