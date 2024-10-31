<?php ob_start();
include "../logindbase.php";
?>
<!DOCTYPE html>
<title>Admin Home</title>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="shortcut icon" href="../images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
<style>
    :root {
    /* FLUID RESPONSIVE PADDING/MARGIN SPACE BASE VALUE = 12px, MIN WIDTH = 320px, AND MAX VALUE = 21px, MAX WIDTH = 1240px (added by mark romualdo)*/
        --space-3xs: clamp(3px, 2.3043px + 0.2174cqi, 5px);/*Multiplier = 0.25*/
        --space-2xs: clamp(6px, 4.2609px + 0.5435cqi, 11px);/*Multiplier = 0.5*/
        --space-xs: clamp(9px, 6.5652px + 0.7609cqi, 16px);/*Multiplier = 0.75*/
        --space-s: clamp(12px, 8.8696px + 0.9783cqi, 21px);/*Multiplier = 1*/
        --space-m: clamp(13px, 9.5217px + 1.087cqi, 23px);/*Multiplier = 1.1*/
        --space-l: clamp(14px, 10.1739px + 1.1957cqi, 25px);/*Multiplier = 1.2*/
        --space-xl: clamp(16px, 12.1739px + 1.1957cqi, 27px);/*Multiplier = 1.3*/
        --space-2xl: clamp(17px, 12.8261px + 1.3043cqi, 29px);/*Multiplier = 1.4*/
        --space-3xl: clamp(18px, 13.1304px + 1.5217cqi, 32px);/*Multiplier = 1.5*/
        --space-4xl: clamp(19px, 13.7826px + 1.6304cqi, 34px);/*Multiplier = 1.6*/
        --space-5xl: clamp(24px, 17.7391px + 1.9565cqi, 42px);/*Multiplier = 2*/
        --space-6xl: clamp(30px, 22px + 2.5cqi, 53px);/*Multiplier = 2.5*/
        --space-7xl: clamp(36px, 26.6087px + 2.9348cqi, 63px);/*Multiplier = 3*/
        --space-8xl: clamp(42px, 30.8696px + 3.4783cqi, 74px);/*Multiplier = 3.5*/
        --space-9xl: clamp(48px, 35.4783px + 3.913cqi, 84px);/*Multiplier = 4*/
        --space-10xl: clamp(54px, 39.7391px + 4.4565cqi, 95px);/*Multiplier = 4.5*/
        --space-11xl: clamp(60px, 44.3478px + 4.8913cqi, 105px);/*Multiplier = 5*/
        --space-12xl: clamp(66px, 48.6087px + 5.4348cqi, 116px);/*Multiplier = 5.5*/
        --space-13xl: clamp(72px, 53.2174px + 5.8696cqi, 126px);/*Multiplier = 6*/
        /* One-up pairs */
        --space-3xs-2xs: clamp(3px, 0.2174px + 0.8696cqi, 11px);
        --space-2xs-xs: clamp(6px, 2.5217px + 1.087cqi, 16px);
        --space-xs-s: clamp(9px, 4.8261px + 1.3043cqi, 21px);
        --space-s-m: clamp(12px, 8.1739px + 1.1957cqi, 23px);
        --space-m-l: clamp(13px, 8.8261px + 1.3043cqi, 25px);
        --space-l-xl: clamp(14px, 9.4783px + 1.413cqi, 27px);
        --space-xl-2xl: clamp(16px, 11.4783px + 1.413cqi, 29px);
        --space-2xl-3xl: clamp(17px, 11.7826px + 1.6304cqi, 32px);
        --space-3xl-4xl: clamp(18px, 12.4348px + 1.7391cqi, 34px);
        --space-4xl-5xl: clamp(19px, 11px + 2.5cqi, 42px);
        --space-5xl-6xl: clamp(24px, 13.913px + 3.1522cqi, 53px);
        --space-6xl-7xl: clamp(30px, 18.5217px + 3.587cqi, 63px);
        --space-7xl-8xl: clamp(36px, 22.7826px + 4.1304cqi, 74px);
        --space-8xl-9xl: clamp(42px, 27.3913px + 4.5652cqi, 84px);
        --space-9xl-10xl: clamp(48px, 31.6522px + 5.1087cqi, 95px);
        --space-10xl-11xl: clamp(54px, 36.2609px + 5.5435cqi, 105px);
        --space-11xl-12xl: clamp(60px, 40.5217px + 6.087cqi, 116px);
        --space-12xl-13xl: clamp(66px, 45.1304px + 6.5217cqi, 126px);
        /* Custom pairs */
        --space-s-l: clamp(12px, 7.4783px + 1.413cqi, 25px);
        /* FLUID RESPONSIVE FONT SIZE BASE VALUE = 9px MIN WIDTH = 425px AND MAX VALUE = 14px MAX WIDTH = 1480px*/
        --step--6: clamp(0.1884rem, 0.1741rem + 0.0713vw, 0.2294rem);
        --step--5: clamp(0.2261rem, 0.205rem + 0.1055vw, 0.2867rem);
        --step--4: clamp(0.2713rem, 0.241rem + 0.1515vw, 0.3584rem);
        --step--3: clamp(0.3255rem, 0.2829rem + 0.213vw, 0.448rem);
        --step--2: clamp(0.3906rem, 0.3317rem + 0.2946vw, 0.56rem);
        --step--1: clamp(0.4688rem, 0.3883rem + 0.4022vw, 0.7rem);
        --step-0: clamp(0.5625rem, 0.4538rem + 0.5435vw, 0.875rem);
        --step-1: clamp(0.675rem, 0.5293rem + 0.7283vw, 1.0938rem);
        --step-2: clamp(0.81rem, 0.6162rem + 0.969vw, 1.3672rem);
        --step-3: clamp(0.972rem, 0.7157rem + 1.2817vw, 1.709rem);
        --step-4: clamp(1.1664rem, 0.8291rem + 1.6867vw, 2.1362rem);
        --step-5: clamp(1.3997rem, 0.9577rem + 2.2098vw, 2.6703rem);
        --step-6: clamp(1.6796rem, 1.1028rem + 2.8839vw, 3.3379rem);
}
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
        h2 {
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
            text-align: center;
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
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
            float: right;
        }
        input[type="checkbox"] {
            cursor: pointer;
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
        width: 80%;
        margin:auto;
        border-radius: 10px;
        display: flex;
        flex-direction: column; /* Stacks elements vertically */
    }
    #searchInput {
        width: 25%;
        align-self: end;
        margin-bottom: 1%;
    }
    th,
    td {
        padding: 8px 4px;
        font-size: var(--step-0);
    }
    
    #pageNumbers {
        margin-top: 20px;
        text-align: center;
    }
    #addSelect,
    #removeSelect{
        padding-block: 2%;
        margin-bottom: 2%;
        margin-inline: 0;
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
    $sql = "SELECT firstname, lastname, email, contact_number, request_time, username FROM account_request ORDER BY request_time DESC LIMIT $start_from, $limit";
    $rs_result = mysqli_query($conn, $sql);
    ?>
    <div class="container_menu">
        <h2>eQuaSmart Account Requests</h2>
        <div class="container">
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
                            <tr>
                                <td><input type="checkbox" name="selected_rows[]" value="<?php echo $row["email"]; ?>"></td>
                                <td>
                                    <select name="role[]">
                                        <option value="admin">Admin</option>
                                        <option value="LeadTech">Lead Technician</option>
                                        <option value="ViewOnly">View Only</option>
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
                </div>
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
</body>

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
