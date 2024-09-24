<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Date Picker and Log Preview</title>
    <style>
        /* Every separate page must contain this as user_menu does not have a body */
        body {
            display: grid;
            grid-template-columns: 60px 1fr;
            margin: 0;
            height: 100vh;
        }

        body:has(.custom-menu:hover) {
            grid-template-columns: 200px 1fr;
        }

        /*  Important */
        /* Every element must be inside of this container menu */
        .container_menu {
            /* Places the container beside the menu */
            grid-area: 1 / 2 / -1 / -1;
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: 12% 1fr 1fr;
            background-color: azure;
            margin-top: 10px;
        }

        h2 {
            font-family: verdana;
            text-align: center;
        }

        .date-picker {
            width: 400px;
            padding: 20px;
            background-color: lemonchiffon;
            /* Updated color */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            justify-self: center;
            grid-area: 2/1/2/2;
        }

        h2 {
            margin-bottom: 20px;
            text-align: center;
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
            display: block;
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

        .log-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            grid-area: 2/2/2/3;
            justify-self: center;
        }

        .log {
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            max-height: 200px;
            overflow-y: auto;
        }

        .log p {
            margin: 0;
        }

        .log-list-container {
            width: 400px;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            justify-self: center;
            grid-area: 3/1/3/2;
        }

        .log-list {
            text-align: center;
        }

        .log-item {
            margin-bottom: 10px;
        }

        #pageTitle {
            grid-area: 1 / 1 / 1 / span 3;
            height: 10px;
            margin: 0px;
        }
    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">DATE PICKER AND LOG PREVIEW</h2>
        <div class="date-picker">
            <h2>Select Date</h2>
            <label for="date">Pick a date:</label>
            <input type="date" id="date">
            <button onclick="logDate()">Log Date</button>
        </div>

        <div class="log-container">
            <h2>Log Preview</h2>
            <div class="log" id="log"></div>
            <button onclick="printLog()">Print Log</button>
        </div>

        <div class="log-list-container">
            <h2>Select Log to Print</h2>
            <div class="log-list" id="logList"></div>
        </div>
    </div>

    <script>
        var logs = [];

        function logDate() {
            var selectedDate = document.getElementById('date').value;
            logs.push(selectedDate);
            var logElement = document.createElement('p');
            logElement.textContent = 'Selected date: ' + selectedDate;
            document.getElementById('log').appendChild(logElement);

            updateLogList();
        }

        function printLog() {
            var logContent = document.getElementById('log').innerHTML;
            var printWindow = window.open('', '_blank');
            printWindow.document.open();
            printWindow.document.write('<html><head><title>Log Preview</title></head><body>' + logContent + '</body></html>');
            printWindow.document.close();
            printWindow.print();
        }

        function updateLogList() {
            var logListElement = document.getElementById('logList');
            logListElement.innerHTML = '';
            logs.forEach(function(log, index) {
                var logItem = document.createElement('div');
                logItem.textContent = 'Log ' + (index + 1) + ': ' + log;
                logItem.classList.add('log-item');
                logListElement.appendChild(logItem);
            });
        }
    </script>
</body>

</html>