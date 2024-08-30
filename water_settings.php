<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <title>Water Settings</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            display: grid;
            grid-template-columns: 60px 1fr;
            margin: 0;
            height: 100vh;
            background-color: azure;
        }

        .container_menu {
            grid-area: 1 / 2 / -1 / -1;
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: auto 50% 50%;
            background-color: azure;
            margin-top: 10px;
        }

        h2 {
            font-family: Verdana, sans-serif;
            text-align: center;
        }

        .container {
            grid-area: 2 / 1 / 2 / span 2;
            width: 84%;
            margin: 20px auto;
            margin-top: 3%;
            margin-left: 12%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            display: flex;
            flex-wrap: wrap;
            justify-content: space-around;
        }

        .chart-container {
            width: 45%;
            margin-bottom: 20px;
        }

        h4 {
            text-align: center;
        }

        .boxx div {
            display: flex;
            align-items: center;
        }

        canvas {
            display: block;
            margin: 0 auto;
            margin-top: 20px;
            width: 100%;
            height: auto;
        }

        .calendar {
            grid-area: 3 / 1 / 3 / 1;
            display: flex;
            flex-direction: column;
            background-color: lemonchiffon;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            padding: 40px;
            width: 60%;
            height: 75% ;
            margin-left: 24%;
        }

        .calendar h4 {
            margin-bottom: 10px;
        }

        .calendar input[type="date"] {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .testing-history {
            grid-area: 3 / 2 / 3 / 2;
            width: 92%;
            height: 85%;
            margin: 3px auto;
            margin-right: 70%;
            background-color: lemonchiffon;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
        }

        .boxx {
            width: 40%;
            height: 60%;
            margin: 1px auto;
            padding: 20px;
            background-color: gray;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            color: white;
        }

        #pageTitle {
            grid-area: 1 / 1 / 1 / span 3;
            height: 10px;
            margin: 0;
        }

        #activateButton, #activateButton1, #activateButton2 {
            display: block;
            width: calc(100% - 10px);
            margin: 5px auto;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        #activateButton:hover, #activateButton1:hover, #activateButton2:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">WATER SETTINGS</h2>

        <div class="container">
            <div class="chart-container">
                <canvas id="lineChart"></canvas>
            </div>
            <div class="chart-container">
                <canvas id="lineChart2"></canvas>
            </div>
        </div>

        <div class="calendar">
            <h4>Calendar</h4>
            <input type="date" id="calendar">
        </div>

        <div class="testing-history">
            <h4>Testing History</h4>
            <div class="boxx">
                
                <div>
                    <label class="label1">5/5/24</label>
                </div>
                <div>
                    <label class="label1">5/5/24</label>
                </div>
                <div>
                    <label class="label1">5/5/24</label>
                </div>

                <button id="activateButton" type="button">Activate Water Pump</button>
                <button id="activateButton1" type="button">Activate pH Pump</button>
                <button id="activateButton2" type="button">Activate Ammonia Pump</button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#activateButton').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: { activateWater: true },
                    success: function(response) { alert('Water Pump activated'); },
                    error: function(error) { alert('Error activating Water Pump'); }
                });
            });

            $('#activateButton1').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: { phWater: true },
                    success: function(response) { alert('pH Pump activated'); },
                    error: function(error) { alert('Error activating pH Pump'); }
                });
            });

            $('#activateButton2').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: { ammoniaWater: true },
                    success: function(response) { alert('Ammonia Pump activated'); },
                    error: function(error) { alert('Error activating Ammonia Pump'); }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Amonia 1', 'Amonia 2', 'Amonia 3', 'Amonia 4', 'Amonia 5'],
                    datasets: [{
                        label: 'Amonia',
                        data: [0, 10, 20, 30, 40],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });

            var ctx2 = document.getElementById('lineChart2').getContext('2d');
            var lineChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['pH 1', 'pH 2', 'pH 3', 'pH 4', 'pH 5'],
                    datasets: [{
                        label: 'pH',
                        data: [0, 10, 20, 30, 40],
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: { beginAtZero: true }
                    }
                }
            });
        });
    </script>
</body>

</html>
