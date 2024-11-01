<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <title>Date Picker and Log Preview</title>
    <style>
        /* Layout styles for body */
        body {
            display: grid;
            grid-template-columns: 60px 1fr;
            margin: 0;
            height: 100vh;
        }

        /* Container for the content next to the menu */
        .container_menu {
            grid-area: 1 / 2 / -1 / -1;
            display: grid;
            grid-template-columns: 1fr 1fr; /* Two columns: left and right */
            grid-template-rows: auto 1fr; /* Title on top */
            gap: 20px;
            background-color: azure;
            padding: 20px;
        }

        /* General styles */
        h2 {
            font-family: Verdana, sans-serif;
            text-align: center;
            margin: 0;
            padding: 10px 0;
        }

        /* Date picker styles */
        .date-picker {
            width: 85%;
            height: 90%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            margin: 0 auto 20px; /* Center and add margin-bottom */
            margin-left: 23%;
            grid-column: 1 / 2;
            grid-row: 2 / 3;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input[type="date"] {
            width: calc(100% - 22px);
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            width: 100%;
            padding: 10px;
            margin-top: 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }

        /* Log container styles */
        .log-container {
            width: 78%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            margin: 0 auto;
            margin-left: 15%;
            grid-column: 2 / 3;
            grid-row: 2 / 4; /* Span two rows to align with both left elements */
        }

        .log {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            max-height: 400px;
            overflow-y: auto;
        }

        .log p {
            margin: 0;
        }

        /* Log list container styles */
        .log-list-container {
            width: 85%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            margin-left: 23%;

            grid-column: 1 / 2;
            grid-row: 3 / 4;
        }

        .log-list {
            text-align: center;
        }

        .log-item {
            margin-bottom: 10px;
        }

        /* Page title styles */
        #pageTitle {
            grid-column: 1 / 3;
            grid-row: 1 / 2;
            text-align: center;
            padding-bottom: 20px;
        }

        @media (max-width: 1010px) {
            *, body {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            .container_menu {
                display: block;
                padding: 10px;
            }

            .date-picker, .log-container, .log-list-container {
                width: 100%;
                height: auto;   
                margin-left: 0;
                margin-right: 0;
            }

            .log-container {
                margin-top: 20px;
            }

            #pageTitle {
                padding: 10px 0;
            }

            h2 {
                font-size: 1.5rem;
            }

            
        }
    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">DATE PICKER AND LOG PREVIEW</h2>

        <!-- Left side: Date picker and Log list -->
        <div class="date-picker">
            <h2>Select Date</h2>
            <label for="date">Pick a date:</label>
            <input type="date" id="date">
            <button onclick="logDate()">Log Date</button>
        </div>

        <div class="log-list-container">
            <h2>Select Log to Print</h2>
            <div class="log-list" id="logList"></div>
            <button onclick="showLog('/templates/feedlog_template.php')">Feed Log</button>
            <button onclick="showLog('/templates/waterlog_template.php')">Water Log</button>
            <!-- <button onclick="downloadLog()">Water Test</button> -->
        </div>
        

        <!-- Right side: Log preview -->
        <div class="log-container">
            <h2>Log Preview</h2>
            <div class="log" id="log"></div>
            <button onclick="printLog()">Print Log</button>
        </div>
    </div>

    <script>
        var logs = [];
        var selectedLogType = ''; // To store the selected log type

        function logDate() {
            var selectedDate = document.getElementById('date').value;
            logs.push(selectedDate);
            var logElement = document.createElement('p');
            logElement.textContent = 'Selected date: ' + selectedDate;
            document.getElementById('log').appendChild(logElement);

            updateLogList();
        }

        function showLog(logFile) {
            // Set the selected log type
            selectedLogType = logFile;

            // Use AJAX to load the PHP file content dynamically into the log container
            var xhr = new XMLHttpRequest();
            xhr.open('GET', logFile, true);
            xhr.onload = function () {
                if (xhr.status === 200) {
                    document.getElementById('log').innerHTML = xhr.responseText;
                } else {
                    document.getElementById('log').innerHTML = 'Error loading log content';
                }
            };
            xhr.send();
        }

        function printLog() {
            // Trigger the print dialog
            window.print();
        }

        function updateLogList() {
            var logListElement = document.getElementById('logList');
            logListElement.innerHTML = '';
            logs.forEach(function (log, index) {
                var logItem = document.createElement('div');
                logItem.textContent = 'Log ' + (index + 1) + ': ' + log;
                logItem.classList.add('log-item');
                logListElement.appendChild(logItem);
            });
        }

        function downloadLog() {
            // Navigate to the 'download-log.html' page
            window.location.href = 'water_test.php';
        }
    </script>
</body>

</html>
<?php ob_end_flush(); ?>
