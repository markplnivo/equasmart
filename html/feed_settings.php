<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">

    <title>Feed Settings</title>
    <style>
        body {
            display: grid;
            grid-template-columns: auto 1fr;
            margin: 0;
            height: 100vh;
            background-color: azure;
        }

        .container_menu {
            grid-area: 1 / 2 / -1 / -1;
            display: grid;
            grid-template-columns: 50% 50%;
            grid-template-rows: 50% 50%;
            background-color: azure;
            margin-top: 10px;
        }

        h2 {
            font-family: verdana;
            text-align: center;

        }

        .date_container {
            /* grid-area: 2/1/2/2; */
            margin: 20px auto;
            /* margin-left: 24%; */
            margin-top: 5%;
            padding: 50px;
            background-color: lemonchiffon;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            /* vertical-align: top; */
            width: 66%;
        }

        .date_container input {
            /* width: 50%; */
            margin: 0 auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
        }

        .chart_container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-area: 1/1/2/span 2;
            /* width: 100%; */
            height: 70%;
            /* margin: 5%;
            margin-left: 9%; */
            padding: 30px;
            background-color: lemonchiffon;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
            text-align: center;
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
            display: flex;
            justify-content: flex-end;
            /* Align items to the right */
        }

        .button-container button {
            width: 20%;
            /* Adjust width if needed */
        }

        /* Added styles for new containers */
        .feedset_container {
            /* grid-area: 2 / 1 / 3 / 2; */
            width: 80%;
            height: 95%;
            margin: 0px auto;
            /* margin-left: 25%; */
            padding: 0px;
            /* background-color: lemonchiffon; */
            border-radius: 15px;
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            display: inline-block;
            vertical-align: top; */
        }

        .confmen_container {
            display: grid;
            margin: auto;
            grid-area: 2 / 1 / 3 / span 2;
            width: 80%;
            /* height: 85%;
            margin-left: 10%; */
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            /* display: inline-block;
            vertical-align: top; */
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 1fr;
        }

        h4 {
            text-align: center;
        }

        .boxSettings {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: auto 1fr;
            width: 80%;
            margin: 20px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: honeydew;
            font-style: arial;
        }

        .button {
            display: inline-block;
            padding: 5px 50px;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: mediumaquamarine;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
        }

        /* Hover effect */
        .button:hover {
            background-color: mediumseagreen;
        }

        #pageTitle {
            grid-area: 1 / 1 / 1 / span 3;
            height: 10px;
            margin: 0px;
        }

        .gear-icon {
            min-width: 10%;
            display: inline-block;
            margin-left: 10px;
            cursor: pointer;
            font-size: 16px;
        }

        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.9);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .overlay-content {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            width: 80%;
            max-width: 500px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .overlay-content h2 {
            text-align: center;
        }

        .overlay-content form {
            display: flex;
            flex-direction: column;
        }

        .overlay-content form input {
            margin-bottom: 15px;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        .overlay-content form button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: mediumaquamarine;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .overlay-content form button:hover {
            background-color: mediumseagreen;
        }

        #feedSettingsForm {
            font-size: 20px;
        }

        .boxSettings span {
            text-align: center;
        }

        .boxSettings #amountbox {
            grid-area: 2 / 1;
            font-size: 20px;
            background-color: orange;
            padding: 20px;
            border-radius: 30px;
        }

        .boxSettings #sessionbox {
            grid-area: 2 / 2;
            font-size: 20px;
            background-color: moccasin;
            padding: 20px;
            border-radius: 30px;
        }

        .boxSettings #adjustbox {
            grid-area: 2 / 3;
            font-size: 20px;
            background-color: palegreen;
            padding: 20px;
            border-radius: 30px;
        }

        #changeSettings {
            grid-area: 1 / 1 / 1 / span 3;
            margin-bottom: 2%;
        }

        .settingsdef {
            font-size: 16px;
        }

        .day-toggle {
            margin-bottom: 10px;
            display: flex;
            justify-content: center;
            column-gap: 15px;
        }

        .day-toggle button {
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .day-toggle button.active {
            background-color: mediumaquamarine;
            color: white;
        }

        #feedingTimesContainer {
            max-height: 300px;
            /* Set the desired height */
            overflow-y: auto;
            /* Enable vertical scrolling */
            overflow-x: hidden;
            /* Hide horizontal scrolling */
            padding: 10px;
            /* border: 1px solid #ddd; */
            /* background-color: #f9f9f9; */
            display: grid;
            border-radius:15px;
        }

        .boxx {
            text-align: center;
        }

        .boxx input {
            font-size: 18px;
        }

        /* Styles for the 'Activate Motor' button */
        #activateMotor {
            background-color: mediumaquamarine;
            /* Green background */
            border: none;
            /* Remove default border */
            color: white;
            /* White text */
            padding: 12px 24px;
            /* Some padding for size */
            text-align: center;
            /* Center the text */
            text-decoration: none;
            /* Remove underline from text */
            display: inline-block;
            /* Inline-block for proper layout */
            font-size: 15px;
            /* Adjust font size */
            margin: 4px 2px;
            /* Small margin around the button */
            cursor: pointer;
            /* Pointer cursor on hover */
            border-radius: 8px;
            /* Rounded corners */
            transition-duration: 0.4s;
            /* Smooth transition effects */
        }

        /* Hover effect */
        #activateMotor:hover {
            background-color: #45a049;
            /* Darker green on hover */
        }

                /* The Modal (background) */
                .modal {
            display: none;
            /* Hidden by default */
            position: fixed;
            /* Stay in place */
            z-index: 1;
            /* Sit on top */
            left: 0;
            top: 0;
            width: 100%;
            /* Full width */
            height: 100%;
            /* Full height */
            background-color: rgba(0, 0, 0, 0.4);
            /* Black background with opacity */
            overflow: auto;
            /* Enable scroll if needed */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            /* 15% from the top and centered */
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
            /* Could be more or less, depending on screen size */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        /* Close button */
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        #debugMenu {
            grid-area: 1 / 1 / 1 / span 3;
        }

        #calibrateMotorBtn {
            grid-area: 3 / 1/ 4/ span 3;
        }


        @media (max-width: 1010px) {

            body {
                display: grid;
                grid-template-columns: auto 1fr;
                margin: 0;
                height: 100vh;
                background-color: azure;
            }

            #pageTitle, #debugMenu {
                grid-area: unset;
                margin:2%;
            }

            .container_menu {
                display:grid;
                grid-template-rows: auto;
                grid-template-columns: auto;
                row-gap:2%;
                overflow-y:scroll;
            }

            .date_container {
                grid-area: auto;
            }

            .chart_container {
                grid-area: auto;
                display:grid;
                grid-template-rows: auto;
                grid-template-columns: 1fr;
                height:auto;
                width:90%;
                
            }

            .feedset_container {
                grid-area: auto;
            }

            .confmen_container {
                grid-area: auto;
                width: 90%;
                grid-template-columns: auto;
                grid-template-rows: auto;
           

            }

        }


    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">FEED SETTINGS</h2>
        <!-- Debug Menu Icon -->
        <div id="debugMenu">
            <i id="openDebug" class="fa-solid fa-gear gear-icon" onclick="openDebugMenu()">debug</i>
        </div>

        <!-- Debug Menu Popup Modal -->
        <div id="debugModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeDebugMenu()">&times;</span>
                <h3>Debug Menu</h3>
                <p style=color:red;>For presentation purposes only!</p>
                <!-- <button id="activateMotor">Activate Motor</button>
                <button onclick="controlMotor('on')">Turn Motor ON</button>
                <button onclick="controlMotor('off')">Turn Motor OFF</button> -->
                <button id="cronToggleButton" onclick="toggleCronJob()">Toggle Cron Job</button>
                <button onclick="captureImage()">Capture and Upload Image</button>
                <p id="statusMessage"></p>
            </div>
        </div>

        <!-- Calibration Modal -->
        <div id="calibrateMotorModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeCalibrateModal()">&times;</span>
                <h3>Calibrate Machine</h3>
                <label>Activate machine until feed starts to exit auger:</label>
                <br>
                <button onclick="controlMotor('on')">Turn Auger ON</button>
                <button onclick="controlMotor('off')">Turn Auger OFF</button>
                <br><br>
                <label for="gramsPerSecond">Input Grams per Second:</label>
                <input type="number" id="gramsPerSecond" placeholder="Enter grams per second">
                <button class="button" onclick="saveCalibrationData()">Save Calibration</button>
                <p id="statusMessage"></p>
            </div>
        </div>


        <!-- Left Container -->
        <div class="chart_container">


            <div class="date_container">
                <h2>Select Date</h2>
                <input id="date" type="date" value="2021-07-22">
                <!-- <button id="activateMotor">Activate Motor</button>
                <button onclick="controlLED('on')">Turn LED ON</button>
                <button onclick="controlLED('off')">Turn LED OFF</button>
                <button onclick="controlMotor('on')">Turn Motor ON</button>
                <button onclick="controlMotor('off')">Turn Motor OFF</button>
                <button id="cronToggleButton" onclick="toggleCronJob()">Toggle Cron Job</button>
                <button onclick="captureImage()">Capture and Upload Image</button>
                <p id="statusMessage"></p> -->
            </div>

            <canvas id="lineChart"></canvas>

        </div>

        <!-- Additional containers -->


        <div class="confmen_container">
            <div class="box1" id="feedingTimesContainer">
                <h4>Configuration Menu for Feeding Times</h4>
                <!-- Feeding times will be dynamically inserted here -->
                <button class="button" id="saveFeedingTimes">Save Feeding Times</button>
                <button class="button" id="resetFeedingTimes">Reset to Default</button> <!-- New Reset Button -->
            </div>

            <div class="feedset_container">
                <!-- <h4>Feed Settings</h4> -->
                <div class="boxSettings">
                    <i id="changeSettings" class="fa-solid fa-gear gear-icon"> Change settings</i>
                    <br></br>
                    <div id="amountbox">
                        <center><i class="fa-solid fa-utensils icon"></i> <span id="amountPerFeeding"></span></center>
                        <center><span class="settingsdef"> Amount per Feeding (grams)</span></center>
                    </div>
                    <br>
                    <div id="sessionbox">
                        <center><i class="fa-solid fa-sync icon"></i> <span id="feedingTimes"></span></center>
                        <center><span class="settingsdef"> Feed session per day</span></center>
                    </div>
                    <br>
                    <div id="adjustbox">
                        <center><i class="fa-solid fa-sliders-h icon"></i> <span id="adjustAmountBy"></span></center>
                        <center><span class="settingsdef"> Adjust Amount by<br> (grams)</span></center>
                    </div>
                    <button class="button" id="calibrateMotorBtn">Calibrate Motor</button>

                </div>
            </div>
        </div>

    </div>

    <div class="overlay" id="overlay">

        <div class="overlay-content">
            <h2>Edit Feed Settings</h2>
            <form id="feedSettingsForm">
                <label for="amount">Amount per Feeding</label>
                <input type="number" id="amount" name="amount">

                <label for="times">Feeding Times</label>
                <input type="number" id="times" name="times">

                <label for="adjust">Adjust Amount by</label>
                <input type="number" id="adjust" name="adjust">

                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</body>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // Fetch feed settings on page load
    $(document).ready(function() {
        fetchFeedSettings();
        fetchFeedHistory();
    });

    // Function to open the calibration modal
    function openCalibrateModal() {
        document.getElementById('calibrateMotorModal').style.display = 'block';
    }

    // Function to close the calibration modal
    function closeCalibrateModal() {
        document.getElementById('calibrateMotorModal').style.display = 'none';
    }

    // Function to save calibration data (grams per second)
    function saveCalibrationData() {
        var gramsPerSecond = document.getElementById('gramsPerSecond').value;

        if (gramsPerSecond === "") {
            alert("Please enter grams per second.");
            return;
        }

        // Make an AJAX request to save the data to the database
        $.ajax({
            url: '../feed_settings_ajax/save_calibration_data.php', // PHP file to handle saving
            type: 'POST',
            data: {
                grams_per_second: gramsPerSecond
            },
            success: function(response) {
                document.getElementById('statusMessage').innerText = "Calibration data saved successfully!";
                document.getElementById('gramsPerSecond').value = ''; // Clear the input field
            },
            error: function(error) {
                console.error('Error saving calibration data:', error);
                document.getElementById('statusMessage').innerText = "Failed to save calibration data.";
            }
        });
    }

    // Event listener to open modal on button click
    document.getElementById('calibrateMotorBtn').addEventListener('click', openCalibrateModal);

    // Close modal if the user clicks outside the modal content
    window.onclick = function(event) {
        var modal = document.getElementById('calibrateMotorModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };

    // Function to format time to 12-hour format with hours, minutes, and seconds
    function formatTimeTo12Hour(feedTime) {
        var date = new Date(feedTime); // Convert the feedTime string into a Date object
        var hours = date.getHours();
        var minutes = date.getMinutes().toString().padStart(2, '0');
        var seconds = date.getSeconds().toString().padStart(2, '0');
        var ampm = hours >= 12 ? 'PM' : 'AM';
        hours = hours % 12;
        hours = hours ? hours : 12; // If hour is 0, display as 12

        return `${hours}:${minutes}:${seconds} ${ampm}`;
    }

    // Function to set the current date in the input field
    function setCurrentDate() {
        var today = new Date();
        var year = today.getFullYear();
        var month = (today.getMonth() + 1).toString().padStart(2, '0'); // Get month and pad single digits
        var day = today.getDate().toString().padStart(2, '0'); // Get day and pad single digits

        // Set the value of the date input to the current date in 'YYYY-MM-DD' format
        var formattedDate = `${year}-${month}-${day}`;
        document.getElementById('date').value = formattedDate;
    }

    // Call the function to set the current date when the page loads
    document.addEventListener('DOMContentLoaded', setCurrentDate);

    // Function to update the chart with new feed history data
    function updateChart(feedData) {
        // Extract labels (feed_time) and data (amount) from the response
        var labels = [];
        var data = [];

        feedData.forEach(function(feedEntry) {
            // Format feed_time to 12-hour time
            labels.push(formatTimeTo12Hour(feedEntry.feed_time)); // Use formatted feed_time for chart labels
            data.push(feedEntry.amount); // Use amount for chart data
        });

        // Update the chart data
        lineChart.data.labels = labels;
        lineChart.data.datasets[0].data = data;

        // Re-render the chart
        lineChart.update();
    }


    // Event listener for date input
    document.getElementById('date').addEventListener('change', fetchFeedHistory);

    // Initialize the chart
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [], // Initially empty
            datasets: [{
                label: 'Total Daily Feed History',
                data: [], // Initially empty
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            tooltips: {
                callbacks: {
                    label: function(tooltipItem, data) {
                        var label = data.datasets[tooltipItem.datasetIndex].label || '';
                        if (label) {
                            label += ': ';
                        }
                        label += tooltipItem.yLabel;
                        return label;
                    },
                    title: function(tooltipItems, data) {
                        // Format the title (feed_time) in 12-hour format in tooltips
                        var dateLabel = data.labels[tooltipItems[0].index];
                        return `Time: ${dateLabel}`;
                    }
                }
            }
        }
    });


    // Fetch feed history for the selected date
    function fetchFeedHistory() {
        var selectedDate = document.getElementById('date').value;

        $.ajax({
            url: '../feed_settings_ajax/get_feed_history.php', // PHP file to fetch data
            type: 'POST',
            dataType: 'json',
            data: {
                selectedDate: selectedDate
            }, // Send selected date to the server
            success: function(response) {
                // Update the chart with the new data
                updateChart(response);
            },
            error: function(error) {
                console.error('Error fetching feed history:', error);
            }
        });
    }




    function captureImage() {
        console.log("Attempting to capture image..."); // Log the start of the function

        fetch('http://esp32feeder.local/capture')
            .then(response => {
                console.log("Received response:", response); // Log the response object

                // Check if the response is OK (status 200-299)
                if (!response.ok) {
                    throw new Error("HTTP error! Status: " + response.status); // Throw an error for non-OK response
                }
                return response.text(); // Return the response text
            })
            .then(data => {
                console.log("Response data:", data); // Log the response data
                alert(data); // Alert the user with the response data
            })
            .catch(error => {
                console.error("Error occurred:", error); // Log the error to the console
                alert("Error: " + error.message); // Alert the user with the error message
            });
    }


    function toggleCronJob() {
        fetch('./cronfiles/toggle_feed_cron.php', {
                method: 'POST'
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('statusMessage').innerText = data.message;
            });
    }

    function controlMotor(action) {
        const esp32Ip = "http://esp32feeder.local"; // Replace with the actual IP address of your ESP32-CAM

        fetch(`${esp32Ip}/motor/${action}`)
            .then(response => response.text())
            .then(data => console.log(data))
            .catch(error => console.error('Error:', error));
    }


    var currentSettings = {};
    var currentSchedule = {};

    // // Sample data for the line chart
    // var data = {
    //     labels: ['Feed 1', 'Feed 2', 'Feed 3', 'Feed 4', 'Feed 5'],
    //     datasets: [{
    //         label: 'Total Daily Feed History',
    //         data: [0, 10, 20, 30, 40, 40],
    //         backgroundColor: 'rgba(255, 99, 132, 0.2)',
    //         borderColor: 'rgba(255, 99, 132, 1)',
    //         borderWidth: 1
    //     }]
    // };

    // // Configuration for the line chart
    // var options = {
    //     scales: {
    //         y: {
    //             beginAtZero: true
    //         }
    //     }
    // };

    // // Create the line chart
    // var ctx = document.getElementById('lineChart').getContext('2d');
    // var lineChart = new Chart(ctx, {
    //     type: 'line',
    //     data: data,
    //     options: options
    // });

    // Function to fetch feed settings from the server
    function fetchFeedSettings() {
        $.ajax({
            url: './feed_settings_ajax/get_feed_settings.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                currentSettings = response;
                $('#amountPerFeeding').text(response.amount_per_feeding);
                $('#feedingTimes').text(response.feeding_session_frequency);
                $('#adjustAmountBy').text(response.adjust_amount_by);
                createFeedingTimeInputs(response.feeding_session_frequency);
                fetchFeedingSchedule();
            },
            error: function(error) {
                console.error('Error fetching feed settings:', error);
            }
        });
    }

    // Function to fetch feeding schedule from the server
    function fetchFeedingSchedule() {
        $.ajax({
            url: './feed_settings_ajax/get_feeding_schedule.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                currentSchedule = response;
                populateFeedingTimeInputs(response);
            },
            error: function(error) {
                console.error('Error fetching feeding schedule:', error);
            }
        });
    }

    // JavaScript to handle the overlay opening and preloading values
    $('#changeSettings').on('click', function() {
        document.getElementById('overlay').style.display = 'flex';
        // Populate the form with the current values
        $.ajax({
            url: './feed_settings_ajax/get_feed_settings.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                currentSettings = response;
                $('#amount').val(response.amount_per_feeding);
                $('#times').val(response.feeding_session_frequency);
                $('#adjust').val(response.adjust_amount_by);
            },
            error: function(error) {
                console.error('Error fetching feed settings:', error);
            }
        });
    });

    // Function to create time input fields based on feeding_session_frequency
    function createFeedingTimeInputs(frequency) {
        var container = $('#feedingTimesContainer');
        container.empty();

        var dayToggle = `<div class="boxx">
            <label>Select Days of the Week:</label>
            <div class="day-toggle">
                <button type="button" class="day" data-day="Sunday">Sun</button>
                <button type="button" class="day" data-day="Monday">Mon</button>
                <button type="button" class="day" data-day="Tuesday">Tue</button>
                <button type="button" class="day" data-day="Wednesday">Wed</button>
                <button type="button" class="day" data-day="Thursday">Thu</button>
                <button type="button" class="day" data-day="Friday">Fri</button>
                <button type="button" class="day" data-day="Saturday">Sat</button>
            </div>
        </div>`;
        container.append(dayToggle);

        for (var i = 0; i < frequency; i++) {
            var timeInput = `<div class="boxx">
                <label for="time${i + 1}">Feeding Time ${i + 1}:</label>
                <input type="time" id="time${i + 1}" name="time${i + 1}">
            </div>`;
            container.append(timeInput);
        }

        container.append('<button class="button" id="saveFeedingTimes">Save Feeding Times</button>');
        container.append('<button class="button" id="resetFeedingTimes">Reset to Default</button>'); // New Reset Button

        // Add event listener for day buttons
        $('.day').on('click', function() {
            $(this).toggleClass('active');
        });
    }

    // Function to populate time inputs and day toggles with current schedule
    function populateFeedingTimeInputs(schedule) {
        schedule.forEach((entry, index) => {
            $(`#time${index + 1}`).val(entry.time);
            entry.days.forEach(day => {
                $(`.day[data-day="${day}"]`).addClass('active');
            });
        });
    }

    // Handle form submission
    document.getElementById('feedSettingsForm').addEventListener('submit', function(event) {
        event.preventDefault();

        var amount = $('#amount').val() || currentSettings.amount_per_feeding;
        var times = $('#times').val() || currentSettings.feeding_session_frequency;
        var adjust = $('#adjust').val() || currentSettings.adjust_amount_by;

        $.ajax({
            url: './feed_settings_ajax/update_feed_settings.php',
            type: 'POST',
            data: {
                amount: amount,
                times: times,
                adjust: adjust
            },
            success: function(response) {
                // Update the displayed settings
                fetchFeedSettings();
                // Close the overlay
                document.getElementById('overlay').style.display = 'none';
            },
            error: function(error) {
                console.error('Error updating feed settings:', error);
            }
        });
    });

    // Handle saving feeding times
    $(document).on('click', '#saveFeedingTimes', function(event) {
        event.preventDefault();
        var feedingTimes = [];
        var daysOfWeek = [];

        $('#feedingTimesContainer .boxx').each(function() {
            var time = $(this).find('input[type="time"]').val();
            if (time) {
                feedingTimes.push(time);
            }
        });

        $('.day.active').each(function() {
            daysOfWeek.push($(this).data('day'));
        });

        $.ajax({
            url: './feed_settings_ajax/save_feeding_schedule.php',
            type: 'POST',
            data: JSON.stringify({
                feedingTimes: feedingTimes,
                daysOfWeek: daysOfWeek
            }),
            contentType: 'application/json',
            success: function(response) {
                console.log('Feeding times saved:', response);
                fetchFeedingSchedule();
            },
            error: function(error) {
                console.error('Error saving feeding times:', error);
            }
        });
    });

    // Handle resetting feeding times to default
    $(document).on('click', '#resetFeedingTimes', function(event) {
        event.preventDefault();

        // Call the server to reset to default settings
        $.ajax({
            url: './feed_settings_ajax/reset_feed_settings.php', // Make sure this endpoint handles resetting
            type: 'POST',
            success: function(response) {
                // Update the displayed settings and schedule
                fetchFeedSettings();
                alert('Feeding settings have been reset to default.');
            },
            error: function(error) {
                console.error('Error resetting feed settings:', error);
            }
        });
    });


    // Close the overlay when clicking outside the form
    document.getElementById('overlay').addEventListener('click', function(event) {
        if (event.target === event.currentTarget) {
            document.getElementById('overlay').style.display = 'none';
        }
    });

    // $('#activateMotor').on('click', function() {
    //     $.ajax({
    //         url: './feed_settings_ajax/control_arduino.php',
    //         type: 'GET',
    //         success: function(response) {
    //             alert('Stepper motor activated');
    //         },
    //         error: function(error) {
    //             console.error('Error activating motor:', error);
    //         }
    //     });
    // });

    // Function to open the debug menu
    function openDebugMenu() {
        document.getElementById('debugModal').style.display = 'block';
    }

    // Function to close the debug menu
    function closeDebugMenu() {
        document.getElementById('debugModal').style.display = 'none';
    }

    // Close the modal if the user clicks outside of the modal content
    window.onclick = function(event) {
        var modal = document.getElementById('debugModal');
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>


</html>
<?php ob_end_flush(); ?>