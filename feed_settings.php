<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <title>Feed Settings</title>
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

        .date_container {
            grid-area: 2/1/2/2;
            margin: 50px auto;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            vertical-align: top;
            width: 80%;
        }

        .date_container input {
            width: 80%;
            margin: 0 auto;
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            display: block;
        }

        .chart_container {
            grid-area: 2/2/2/2;
            width: 80%;
            margin: 5%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            vertical-align: top;
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
            justify-content: space-between;
            /* Align items with space between them */
        }

        .button-container button {
            width: 20%;
            /* Adjust width to accommodate both buttons */
        }

        /* Added styles for new containers */
        .feedset_container {
            grid-area: 3 / 1 / 4 / 2;
            width: 100%;
            height: 100%;
            margin: auto;
            padding: 0px;
            background-color: lemonchiffon;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            vertical-align: top;
        }

        .confmen_container {
            grid-area: 3 / 2 / 4 / 3;
            width: 80%;
            margin: 0 0 0 5%;
            padding: 20px;
            background-color: lemonchiffon;
            border-radius: 50px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            display: inline-block;
            vertical-align: top;
        }

        h4 {
            text-align: center;
        }

        .boxSettings {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            grid-template-rows: auto 1fr;
            width: auto;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border-radius: 30px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: honeydew;
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            font-size: 15px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: mediumaquamarine;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
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
            background-color: rgba(0, 0, 0, 0.5);
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
            margin-bottom: 5%;
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
            font-size:16px;
        }

        .day-toggle button.active {
            background-color: mediumaquamarine;
            color: white;
        }

        .boxx {
            text-align:center;    
        }

        .boxx input {
            font-size: 18px;
        }
    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">FEED SETTINGS</h2>

        <div class="date_container">
            <h2>Select Date</h2>
            <input id="date" type="date" value="2021-07-22">
            <button id="activateMotor">Activate Motor</button>
        </div>

        <!-- Left Container -->
        <div class="chart_container">
            <canvas id="lineChart"></canvas>
        </div>

        <!-- Additional containers -->
        <div class="feedset_container">
            <h4>Feed Settings</h4>
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
            </div>
        </div>

        <div class="confmen_container">
            <h4>Configuration Menu for Feeding Times</h4>
            <div class="box1" id="feedingTimesContainer">
                <!-- Feeding times will be dynamically inserted here -->
                <button class="button" id="saveFeedingTimes">Save Feeding Times</button>
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
    var currentSettings = {};
    var currentSchedule = {};


    // Sample data for the line chart
    var data = {
        labels: ['Item 1', 'Item 2', 'Item 3', 'Item 4', 'Item 5'],
        datasets: [{
            label: 'Total Daily Feed History',
            data: [0, 10, 20, 30, 40, 40],
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    };

    // Configuration for the line chart
    var options = {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    };

    // Create the line chart
    var ctx = document.getElementById('lineChart').getContext('2d');
    var lineChart = new Chart(ctx, {
        type: 'line',
        data: data,
        options: options
    });


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

    // Fetch feed settings on page load
    $(document).ready(function() {
        fetchFeedSettings();
    });

    // Close the overlay when clicking outside the form
    document.getElementById('overlay').addEventListener('click', function(event) {
        if (event.target === event.currentTarget) {
            document.getElementById('overlay').style.display = 'none';
        }
    });

    $('#activateMotor').on('click', function() {
            $.ajax({
                url: './feed_settings_ajax/control_arduino.php',
                type: 'GET',
                success: function(response) {
                    alert('Stepper motor activated');
                },
                error: function(error) {
                    console.error('Error activating motor:', error);
                }
            });
        });
</script>


</html>
<?php ob_end_flush(); ?>