<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="images/equasmartlogo_croppedlogo.png" type="image/svg+xml">
    <title>User Dashboard</title>
</head>
<style>
    body {
        display: grid;
        grid-template-columns: 60px 1fr;
        grid-template-rows: auto 1fr;
        margin: 0;
        height: 100vh;
    }

    .container_menu {
        grid-area: 1 / 2 / -1 / -1;
        display: grid;
        grid-template-columns: 1fr 1fr 1fr;
        grid-template-rows: auto 12% 1fr 1fr;
        background-color: azure;
        margin-top: 10px;
    }

    .chart_header {
        grid-area: 2 / 1 / 3 / span 3;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }

    #feedQuick:hover,
    #waterQuick:hover,
    #tempQuick:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.9);
    }

    #feedQuick,
    #waterQuick,
    #tempQuick {
        background-color: khaki;
        height: 90%;
        width: 100%;
        color: goldenrod;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        margin: 0 10px;
        font-size: 1.2em;
        margin-left: 12%;
    }

    #waterQuick {
        background-color: cornflowerblue;
        color: whitesmoke;
    }

    #tempQuick {
        background-color: lightcoral;
        color: whitesmoke;
    }

    #feedQuick .icon,
    #waterQuick .icon,
    #tempQuick .icon {
        font-size: 2.5em;
        margin-right: 30px;
    }

    .liveImage {
        grid-row: 3 / span 2;
        grid-column: 1 / span 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        height: 100%;
        position: relative;
    }

    .liveImage .videoWrapper {
        display: flex;
        justify-content: center;
        width: 100%;
        height: 70%;
        margin-top: 10%;
    }

    .liveImage video {
        background-color: whitesmoke;
        border-radius: 10px;
        width: 20%; /* Smaller width for the videos */
        height: auto;
        margin: 0 20px;
        margin-left: 10%;
    }

    #liveClock {
        font-size: 2em;
        color: darkslategray;
        margin: 10px 10px;
        margin-top: 40px;
        text-align: center;

    }

    .clockContainer {
        position: absolute;
        top: 0;
        width: 20%;
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        padding: 5px;
    }

    .clockContainer .icon {
        font-size: 26px;
        margin-left: 15px;
        margin-top: 40px;
    }
</style>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">

        <!-- Header Section -->
        <div class="chart_header">
            <div id="feedQuick">
                <span class="icon fa fa-fish"></span><span class="feedAmount">0 grams fed</span>
            </div>
            <div id="waterQuick">
                <span class="icon fa fa-tint"></span><span class="status">Water Parameters</span>
            </div>
            <div id="tempQuick">
                <span class="icon fa fa-thermometer-half"></span><span>21°C</span>
            </div>
        </div>

        <!-- Video Section with Live Clock -->
        <div class="liveImage">
            <div class="clockContainer">
                <span class="icon fa fa-clock"></span><span id="liveClock"></span>
            </div>
            <div class="videoWrapper">
                <!-- <video id="video1" autoplay controls> -->
                    <!-- <source src="./video/fish_swimming.mp4" type="video/mp4"> -->
                    <img id="video1" src="http://esp32feeder.local:81/stream" alt="ESP32 Cam Stream" style="transform: rotate(90deg);">
                <!-- </video> -->
                <video id="video2" autoplay controls>
                <source src="./video/fish_swimming.mp4" type="video/mp4">
                </video>
                <video id="video3" autoplay controls>
                <source src="./video/fish_swimming.mp4" type="video/mp4">
                </video>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updateClock() {
        const now = new Date();
        const clock = document.getElementById('liveClock');
        clock.textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000);
    updateClock();

    function fetchFeedAmount() {
        $.ajax({
            url: './user_dashboard_ajax/fetch_feed_amount.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                const feedAmountSpan = document.querySelector('#feedQuick .feedAmount');
                feedAmountSpan.textContent = `${data.total_feed} grams fed`;
            },
            error: function(xhr, status, error) {
                console.error('Error fetching feed amount:', error);
            }
        });
    }

    setInterval(fetchFeedAmount, 60000);
    fetchFeedAmount();
</script>

</html>
<?php ob_end_flush(); ?>
