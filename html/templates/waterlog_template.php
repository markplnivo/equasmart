<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Testing Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
            padding: 40px;
            background: #fff;
            border: 1px solid #ddd;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
            margin-bottom: 40px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            text-transform: uppercase;
            color: mediumaquamarine;
        }
        .header .logo {
            margin-top: 15px;
            max-height: 100px;
        }
        .date-section {
            text-align: right;
            font-size: 14px;
            color: #777;
            margin-bottom: 30px;
        }
        .content-section {
            margin-bottom: 30px;
        }
        .content-section h2 {
            font-size: 20px;
            color: #333;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
            margin-bottom: 15px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .data-table th, .data-table td {
            padding: 12px;
            border: 1px solid #ddd;
            text-align: left;
            font-size: 16px;
        }
        .data-table th {
            background-color: mediumaquamarine;
            color: #333;
        }
        .checkbox-group {
            display: flex;
            align-items: center;
            margin-top: 10px;
            font-size: 16px;
        }
        .checkbox-group label {
            margin-right: 10px;
        }
    </style>
</head>
<body>


<?php
    $selectedDate = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d');
    $interval = isset($_POST['interval']) ? $_POST['interval'] : 'daily';

    // Database connection
    $servername = "localhost";
    $username = "admin";
    $password = "123";
    $dbname = "db_equasmart";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Set conditions and parameters based on interval
    switch ($interval) {
        case 'daily':
            $condition = "DATE(Date_and_Time) = ?";
            $params = [$selectedDate];
            break;

        case 'weekly':
            $condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 6 DAY) AND ?";
            $params = [$selectedDate, $selectedDate];
            break;

        case 'monthly':
            $condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 1 MONTH) AND ?";
            $params = [$selectedDate, $selectedDate];
            break;

        case 'yearly':
            $condition = "Date_and_Time BETWEEN DATE_SUB(?, INTERVAL 1 YEAR) AND ?";
            $params = [$selectedDate, $selectedDate];
            break;

        default:
            $condition = "DATE(Date_and_Time) = ?";
            $params = [$selectedDate];
            break;
    }

    $param_type = str_repeat("s", count($params)); // Determine parameter types

    // Initialize variables
    $ph = "No data";
    $ammonia = "No data";
    $nitrate = "No data";

    // Query for average values
    $query = "SELECT Name, ROUND(AVG(Value), 2) AS AvgValue 
              FROM water_test_input 
              WHERE Name IN ('pH', 'Ammonia', 'Nitrate') AND $condition 
              GROUP BY Name";

    $stmt = $conn->prepare($query);
    $stmt->bind_param($param_type, ...$params);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            if ($row['Name'] == 'pH') {
                $ph = $row['AvgValue'];
            } elseif ($row['Name'] == 'Ammonia') {
                $ammonia = $row['AvgValue'];
            } elseif ($row['Name'] == 'Nitrate') {
                $nitrate = $row['AvgValue'];
            }
        }
    }
    $stmt->close();
    $conn->close();
?>

    <div class="container">
        <div class="header">
        <h1>Water Testing Report</h1>
        <img src="images/equasmartlogo_croppedlogo.png" alt="Logo" class="logo">
        </div>

    <div class="date-section">
    Date: <?php echo htmlspecialchars($selectedDate); ?>
        </div>

    <div class="content-section">
        <h2>Water Quality Data</h2>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Parameter</th>
                    <th>Average Value</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>pH</td>
                    <td><?php echo $ph; ?></td>
                </tr>
                <tr>
                    <td>Ammonia</td>
                    <td><?php echo $ammonia; ?></td>
                </tr>
                <tr>
                    <td>Nitrate</td>
                    <td><?php echo $nitrate; ?></td>
                </tr>
            </tbody>
        </table>
        </div>

    <div class="content-section">
        <h2>Inspection and Management</h2>
        <div class="checkbox-group">
            <label for="waste-management-completed">Waste Management Completed</label>
                    <input type="checkbox" id="waste-management-completed">
                </div>
        <div class="checkbox-group">
            <label for="algae-inspection-completed">Algae Inspection Completed</label>
            <input type="checkbox" id="algae-inspection-completed">
        </div>
    </div>
</div>

<script>
    function showLog(logFile) {
    var selectedDate = document.getElementById('date').value || currentDate;
    var selectedInterval = document.getElementById('interval').value;

    var xhr = new XMLHttpRequest();
    xhr.open('POST', logFile, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            document.getElementById('log').innerHTML = xhr.responseText;
        }
    };

    xhr.send("date=" + encodeURIComponent(selectedDate) + "&interval=" + encodeURIComponent(selectedInterval));
}

</script>

</body>
</html>
