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
            height: 75%;
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
            background-color: lightyellow;
            border-radius: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
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
                     <div id="comparisonLabel"><span>OPTIMAL</span><span>OKAY</span><span>NOT RECOMMENDED</span> </div>
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
        </div>

        <div class="calendar">
            <h4>Calendar</h4>
            <input type="date" id="calendar">
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

                <button id="activateButton" type="button">Activate Ammonia Pump</button>
                <!-- <button id="activateButton1" type="button">Activate pH Pump</button>
                <button id="activateButton2" type="button">Activate Ammonia Pump</button> -->
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
    </script>
</body>

</html>