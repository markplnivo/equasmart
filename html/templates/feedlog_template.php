<?php 
include "../logindbase.php";  // Ensure the path is correct
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Log</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            width: 85%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 3px solid mediumaquamarine;
            padding-bottom: 15px;
            margin-bottom: 20px;
        }
        .log-title {
            font-size: 26px;
            color: black;
            margin: 0;
            padding: 0;
        }
        .logo img {
            max-width: 200px;
            height: auto;
            border-radius: 4px;
        }
        .info {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .info .date,
        .info .temperature {
            flex: 1;
            padding: 0 10px;
        }

        .info .date span,
        .info .temperature span {
            font-weight: bold;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        thead th {
            background-color: mediumaquamarine;
            color: white;
            padding: 12px;
            text-align: center;
            font-size: 16px;
        }
        tbody td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }
        tbody td:first-child {
            text-align: left;
            font-weight: bold;
            background-color: #f9f9f9;
        }
        tbody tr:nth-child(odd) {
            background-color: #f2f2f2;
        }
        tbody td span {
            font-weight: bold;
            color: mediumaquamarine;
        }

        tbody td:nth-child(2),
        tbody td:nth-child(3),
        tbody td:nth-child(4) {
            text-align: center;
        }
        td p {
            margin: 0;
        }
        .notes {
            padding-top: 10px;
            font-size: 14px;
            color: #555;
            border-top: 2px solid mediumaquamarine;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <div class="log-title">
                <h1 id="logTitle">Daily Feed Log</h1>
            </div>
            <div class="logo">
                <img src="images/equasmartlogo_croppedlogo.png" alt="Description of the image" title="Image Tooltip">
            </div>
        </div>

        <div class="info">
        <?php
            $current_date = date('Y-m-d');
            $average_amount = "N/A";
            $average_ph = "N/A";

            // Get date and interval from POST request
            $date = $_POST['date'] ?? $current_date;
            $interval = $_POST['interval'] ?? 'daily';

            if (isset($conn)) {
                // Set conditions and parameters based on interval
                switch ($interval) {
                    case 'daily':
                        $condition = "DATE(feed_time) = ?";
                        $ph_condition = "DATE(Date_and_Time) = ?";
                        $param_type = "s";
                        $params = [$date];
                        break;

                    case 'weekly':
                        $condition = "feed_time BETWEEN DATE_SUB(?, INTERVAL 6 DAY) AND ?";
                        $ph_condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 6 DAY) AND ?";
                        $param_type = "ss";
                        $params = [$date, $date];
                        break;

                    case 'monthly':
                        $condition = "feed_time BETWEEN DATE_SUB(?, INTERVAL 1 MONTH) AND ?";
                        $ph_condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 1 MONTH) AND ?";
                        $param_type = "ss";
                        $params = [$date, $date];
                        break;

                    case 'yearly':
                        $condition = "feed_time BETWEEN DATE_SUB(?, INTERVAL 1 YEAR) AND ?";
                        $ph_condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 1 YEAR) AND ?";
                        $param_type = "ss";
                        $params = [$date, $date];
                        break;
                }

                // Query for average feed amount
                $amount_query = "SELECT AVG(amount) AS average_amount FROM feed_history WHERE $condition";
                $stmt1 = $conn->prepare($amount_query);
                $stmt1->bind_param($param_type, ...$params);
                $stmt1->execute();
                $result1 = $stmt1->get_result();
                $average_amount = $result1->fetch_assoc()['average_amount'] ?? "N/A";
                $stmt1->close();

                // Query for average pH value
                $ph_query = "SELECT ROUND(AVG(Value), 2) AS average_ph FROM water_test_input WHERE Name = 'pH' AND $ph_condition";
                $stmt2 = $conn->prepare($ph_query);
                $stmt2->bind_param($param_type, ...$params);
                $stmt2->execute();
                $result2 = $stmt2->get_result();
                $average_ph = $result2->fetch_assoc()['average_ph'] ?? "N/A";
                $stmt2->close();
            }
            ?>
            <div class="date">
                <p>Date: <span><?php echo htmlspecialchars($date); ?></span></p>
            </div>
        </div>

        <table>
            <thead>
                <!-- Add table headers here -->
            </thead>
            <tbody>
                <tr>
                    <td>Inspect Feed Machine</td>
                    <td><input type="checkbox" checkebox></td>
                </tr>
                <tr>
                    <td>Plant observation</td>
                    <td><input type="checkbox" checkebox></td>
                </tr>
                <tr>
                    <td>Fish observation</td>
                    <td><input type="checkbox" checkebox></td>
                </tr>
                <tr>
                    <!-- <td>Amount of Feed (grams):</td>
                    <td><span>
                        <?php # echo htmlspecialchars(number_format($average_amount, 2)); 
                        ?></span></td> -->
                    <td>Amount of Feed (grams):</td>
                    <td><span><?php echo is_numeric($average_amount) ? htmlspecialchars(number_format($average_amount, 2)) : 'N/A'; ?></span></td>

                </tr>
            </tbody>
        </table>
    </div>
    <script>
        function updateDateDisplay() {
            // Get the selected date from the date input
            var selectedDate = document.getElementById("date").value;

            // Update the displayed date span with the selected date
            document.getElementById("displayDate").textContent = selectedDate;

            // Optionally, you can also send the selected date to the server using AJAX if needed
        }
    </script>
</body>
</html>
