<?php ob_start(); ?>
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
    width: 87.5%;
    margin: 20px auto;
    margin-top: 3%;
    margin-left: 12%;
    padding: 20px;
    background-color: lemonchiffon;
    border-radius: 15px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
    display: flex;
    flex-direction: row;
    justify-content: space-around; /* Adjusts spacing equally */
    align-items: center;
}

        .chart-container {
    width: 50%; /* Adjust width to fit your desired size */
    height: 300px; /* Set a specific height for the chart container */
    margin: 0 auto;
    display: flex;
    justify-content: center;
    align-items: center;
}

canvas {
    width: 10%;
    height: 10%; /* Make sure the canvas takes full height */
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
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: lemonchiffon;
            border-radius: 20px;
            
            padding: 90px;
            width: 100%;
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

        .input{
            grid-area: 3 / 1 / 3 / 1;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            align-items: center;
            align-content: center;
            flex-direction: column;
            background-color: lemonchiffon;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
            padding: 40px;
            width: 70%;
            height: 95%;
            margin-left: 24%;
        }

        .input input[type="text"] {
    width: 80%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

        .input button {
            width: 50%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
            font-size: 16px;
        }

        .input button:hover {
            background-color: #45a049;
        }

        .testing-history {
            grid-area: 3 / 2 / 3 / 2;
            width: 99%;
            height: 95%;
            margin-right: 70%;
            background-color: lemonchiffon;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);

            display: flex;
            flex-direction: column;
            justify-content: center; /* Centers children vertically */
            align-items: center;    /* Centers children horizontally */
        }

        .boxx {
            width: 60%;
            height: 60%;
           
            padding: 20px;
            border-radius: 20px;
            color: white;
        }

        #pageTitle {
            grid-area: 1 / 1 / 1 / span 3;
            height: 10px;
            margin: 0;
        }

        #activateButton,
        #activateButton1,
        #activateButton2 {
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

        #activateButton:hover,
        #activateButton1:hover,
        #activateButton2:hover {
            background-color: #45a049;
        }

        
        .gallery-container {
            width: 100%;
            max-height: 400px;
            /* Adjust the height as needed */
            overflow-y: auto;
            /* Adds a vertical scroll bar */
            overflow-x: hidden;
            padding: 10px;
            display: flex;
            flex-wrap: wrap;
            justify-content: flex-start;
        }

        .image-gallery img {
            max-width: 200px;
            margin: 10px;
            border-radius: 8px;
            transition: transform 0.3s ease;
        }

        .image-gallery img:hover {
            transform: scale(1.1);
            cursor: pointer;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 999;
            padding-top: 100px;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            overflow: auto;
        }

        .modal-content {
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            width: 80%;
            max-width: 900px;
        }

        .modal-content img {
            max-width: 50%;
            border-radius: 10px;
            margin: 0 10px;
            /* Add spacing between images */
        }

        .modal-content img:hover {
            transform: scale(1.05);
        }

        .close {
            position: absolute;
            top: 15px;
            right: 35px;
            color: #f1f1f1;
            font-size: 40px;
            font-weight: bold;
            transition: 0.3s;
            cursor: pointer;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        @media (max-width: 1010px) {
            *, body{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            }

            .container_menu {
                display: block; /* Stack menu items vertically */
            }

            .container, .calendar, .testing-history {
                width: 90%; /* Ensure full width for each section */
                margin-block: 30px; /* Center elements and add spacing */
                margin-inline: 20px;
                height: auto; /* Let height adjust based on content */
            }

            .chart-container {
                width: auto; /* Make chart containers take full width */
            }

            canvas {
                width: 100%; /* Ensure canvases fill their containers */
            }

            
}
    </style>
</head>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <h2 id="pageTitle">WATER SETTINGS</h2>
        <!-- Modal for Enlarged Image -->
        <div id="imageModal" class="modal">
            <span class="close">&times;</span>
            <div class="modal-content">
                <div style="display: flex; justify-content: center;">
                    <!-- Selected Image -->
                    <img id="modalImage" src="" alt="Enlarged Image" style="max-width: 50%; margin-right: 10px; transform:rotate(180deg);">
                    <!-- Comparison Image -->
                    <!-- <div id="comparisonLabel"><span>OPTIMAL</span><span>OKAY</span><span>NOT RECOMMENDED</span> </div> -->
                    <img id="comparisonImage" src="/uploads/ammonia_comparison.jpg" alt="Comparison Image" style="max-width: 50%;">
                </div>
            </div>
        </div>
        
        <div class="container">
            <div class="gallery-container">
                <div id="imageGallery" class="image-gallery">
                    <!-- Images will be loaded here -->
                </div>
            </div>
            <div class="calendar">
            <h4>Calendar</h4>
            <input type="date" id="calendar">
        </div>
            <canvas id="lineChart"></canvas>

            </div>

        <div class="input">
            <h4>Input Fields</h4>
            <input type="text" id="input1" placeholder="Enter Ammonia value">
            <input type="text" id="input2" placeholder="Enter Nitrate value">
            <input type="text" id="input3" placeholder="Enter pH value">
            <button id="insertButton">Insert</button>
        </div>


        <div class="testing-history">
            <!-- <h4>Testing History</h4> -->
            <div class="boxx">

                <!-- <div>
                    <label class="label1">5/5/24</label>
                </div>
                <div>
                    <label class="label1">5/5/24</label>
                </div>
                <div>
                    <label class="label1">5/5/24</label>
                </div> -->

                <button id="activateButton" type="button">Test Ammonia</button>
                <button id="activateButton1" type="button">Test Nitrate</button>
                <button id="activateButton2" type="button">Test pH</button> 
                <button id="activateButton2" onclick="captureImage()">Capture and Upload Image</button>
                <p id="status"></p>
            </div>
        </div>
    </div>

    <script>
        // Function to set the current date in the input field
        function setCurrentDate() {
            const today = new Date();
            const yyyy = today.getFullYear();
            const mm = String(today.getMonth() + 1).padStart(2, '0'); // Months are zero-based
            const dd = String(today.getDate()).padStart(2, '0');

            const formattedDate = `${yyyy}-${mm}-${dd}`;
            document.getElementById('calendar').value = formattedDate; // Set input field to current date
        }

        $(document).ready(function() {
            // Set the current date on page load
            setCurrentDate();

            // Load images when the date is selected
            $('#calendar').on('change', function() {
                var selectedDate = $(this).val();

                // AJAX request to fetch images from the selected date
                $.ajax({
                    url: './water_settings_ajax/fetch_images.php',
                    type: 'POST',
                    data: {
                        date: selectedDate
                    },
                    success: function(response) {
                        $('#imageGallery').html(response); // Update the gallery with the response

                        // Add click event to gallery images to show them in modal
                        $('.gallery-image').on('click', function() {
                            var imageUrl = $(this).attr('src');
                            $('#modalImage').attr('src', imageUrl); // Set the clicked image
                            $('#comparisonImage').attr('src', './ammonia_comparison.jpg'); // Set the comparison image
                            $('#imageModal').fadeIn(); // Show the modal
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching images:', error);
                    }
                });
            });

            // Trigger the change event to load images for the current date on page load
            $('#calendar').trigger('change');

            // Close the modal when the close button is clicked
            $('.close').on('click', function() {
                $('#imageModal').fadeOut();
            });

            // Close the modal if clicked outside the image
            $(window).on('click', function(e) {
                if ($(e.target).is('#imageModal')) {
                    $('#imageModal').fadeOut();
                }
            });
        });



        // Function to send commands to the ESP32
        function sendCommand(command) {
            fetch(`http://esp32water.local/api?command=${command}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error("HTTP error! Status: " + response.status);
                    }
                    return response.text();
                })
                .then(data => {
                    alert(data);
                })
                .catch(error => {
                    console.error("Error occurred:", error);
                    alert("Error: " + error.message);
                });
        }

        function captureImage() {
            console.log("Attempting to capture image..."); // Log the start of the function

            fetch('http://esp32water.local/capture')
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
                    // alert(data); // Alert the user with the response data
                })
                .catch(error => {
                    console.error("Error occurred:", error); // Log the error to the console
                    alert("Error: " + error.message); // Alert the user with the error message
                });
        }


        $(document).ready(function() {
            // Updated buttons to send commands to the ESP32 API
            $('#activateButton').on('click', function() {
                sendCommand('TITRATE_AMMONIA');
            });

            $('#activateButton1').on('click', function() {
                sendCommand('TITRATE_PH');
            });

        //     $('#activateButton2').on('click', function() {
        //         sendCommand('TITRATE_NITRATE');
        //     });
        });

        document.addEventListener("DOMContentLoaded", function() {
            var ctx = document.getElementById('lineChart').getContext('2d');
            var lineChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: ['Ammonia 1', 'Ammonia 2', 'Ammonia 3', 'Ammonia 4', 'Ammonia 5'],
                    datasets: [{
                        label: 'Ammonia',
                        data: [0, 10, 20, 30, 100],
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
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });

        document.getElementById('insertButton').addEventListener('click', function () {
    // Get values from input fields
    const ammonia = document.getElementById('input1').value;
    const nitrate = document.getElementById('input2').value;
    const pH = document.getElementById('input3').value;

    // Send data to the backend PHP script using fetch API
    fetch('insert_data.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            ammonia: ammonia,
            nitrate: nitrate,
            pH: pH
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Clear the input fields
            document.getElementById('input1').value = '';
            document.getElementById('input2').value = '';
            document.getElementById('input3').value = '';
        } else {
            console.error("Failed to insert data.");
        }
    })
    .catch(error => console.error('Error:', error));
});

    </script>
</body>

</html>
<?php ob_end_flush(); ?>