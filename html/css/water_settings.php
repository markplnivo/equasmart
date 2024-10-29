<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Water Settings</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        /* Every separate page must contain this as user_menu does not have a body */
        body {
            display: grid;
            grid-template-columns: 60px 1fr;
            margin: 0;
            height: 100vh;
            background-color: azure;
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
            grid-template-columns: 50% 50%;
            grid-template-rows: auto 50% 50%;
            background-color: azure;
            margin-top: 10px;
        }

        h2 {
            font-family: verdana;
            text-align: center;
        }

        .container {
            grid-area: 2/ 1 / 2 / span 2;
            width: 80%;
            margin: 50px auto;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: flex;
            /* Added */
            flex-wrap: wrap;
            /* Added */
            justify-content: space-around;
            /* Added */
        }

        .chart-container {
            width: 45%;
            /* Adjusted width */
            margin-bottom: 20px;
            /* Added margin for spacing */
        }

        h4 {
            text-align: center;
        }

        /* Added CSS */
        .boxx div {
            display: flex;
            align-items: center;
        }

        /* Style for the canvas element */
        canvas {
            display: block;
            margin: 0 auto;
            margin-top: 20px;
            width: 100%;
            /* Changed width to 100% */
            height: auto;
        }

        .calendar {
            grid-area: 3 / 1 / 3 / 1;
            display: inline-block;
            background-color: lemonchiffon;
            /* Match the background color */
            /* Match the text color */
            border-radius: 20px;
            /* Increased border radius for a smoother look */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            /* Increased padding for better spacing */
            width: 90%;
            /* Adjusted width */
            max-width: 400px;
            /* Added max-width to prevent excessive stretching */
            margin: 0 auto;
            /* Center the calendar */
        }

        /* Added CSS for testing history */
        .testing-history {
            grid-area: 3 / 2 / 3 / 2;
            width: 30%;
            margin: 20px auto;
            background-color: lemonchiffon;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .boxx {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: gray;
        }

        #pageTitle {
            grid-area: 1 / 1 / 1 / span 3;
            height: 10px;
            margin: 0px;
        }

        #activateButton {
            margin-top: 100px;
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

        <!-- Added calendar container -->

        <div class="calendar">
            <h4>Calendar</h4>
            <!-- Calendar content can be added here -->
            <input type="date" id="calendar">

        </div>


        <!-- Added container for testing history -->

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
        <!-- Form to trigger the Python script -->


    </div>


    <script>
        $(document).ready(function() {
            $('#activateButton').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: {
                        activateWater: true
                    },
                    success: function(response) {
                        alert('Water Pump activated');
                    },
                    error: function(error) {
                        alert('Error activating Water Pump');
                    }
                });
            });

            $('#activateButton1').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: {
                        phWater: true
                    },
                    success: function(response) {
                        alert('pH Pump activated');
                    },
                    error: function(error) {
                        alert('Error activating pH Pump');
                    }
                });
            });

            $('#activateButton2').on('click', function() {
                $.ajax({
                    url: 'control_water.php',
                    type: 'POST',
                    data: {
                        ammoniaWater: true
                    },
                    success: function(response) {
                        alert('Ammonia Pump activated');
                    },
                    error: function(error) {
                        alert('Error activating Ammonia Pump');
                    }
                });
            });
        });


        // JavaScript to render the line graph using Chart.js
        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'],
                    datasets: [{
                        label: 'Amonia',
                        data: [0, 10, 20, 30, 40], // Sample data, replace with your actual data
                        backgroundColor: 'rgba(255, 99, 132, 0.2)', // Adjust colors as needed
                        borderColor: 'rgba(255, 99, 132, 1)', // Adjust colors as needed
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });

            var ctx2 = document.getElementById('lineChart2').getContext('2d');
            var lineChart2 = new Chart(ctx2, {
                type: 'line',
                data: {
                    labels: ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'],
                    datasets: [{
                        label: 'pH',
                        data: [0, 10, 20, 30, 40], // Sample data, replace with your actual data
                        backgroundColor: 'rgba(54, 162, 235, 0.2)', // Adjust colors as needed
                        borderColor: 'rgba(54, 162, 235, 1)', // Adjust colors as needed
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero: true
                            }
                        }]
                    }
                }
            });
        });
    </script>
</body>

</html>