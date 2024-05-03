<?php ob_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
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
        margin-top:10px;
    }

    .chart_header {
        grid-area: 1 / 1 / 2 / span 3;
        display: flex;
        flex-direction: row;
        justify-content: space-around;
        align-items: center;
    }

    #feedQuick:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    #feedQuick {
        background-color: khaki;
        height: 100%;
        width: 30%;
        color: goldenrod;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        margin-left: 10px;
        font-size: 1.2em;
    }

    #feedQuick .icon {
        font-size: 2.5em;
        margin-right: 30px;
    }

    #waterQuick span.status::after {
        content: '"OK"';
        color: chartreuse;
    }

    #waterQuick:hover span.status::after {
        content: '"BAD"';
        color: red;
    }

    #waterQuick:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    #waterQuick {
        background-color: cornflowerblue;
        height: 100%;
        width: 30%;
        color: whitesmoke;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        margin-right: 10px;
        font-size: 1.2em;
    }

    #waterQuick .icon {
        font-size: 2.5em;
        margin-right: 30px;
    }

    #tempQuick:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    #tempQuick {
        background-color: lightcoral;
        height: 100%;
        width: 30%;
        color: whitesmoke;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        font-size: 1.2em;
    }

    #tempQuick .icon {
        font-size: 2.5em;
        margin-right: 30px;
    }

    .liveImage {
        grid-row: 2/ span 2;
        grid-column: 1/ span 3;
        align-self: center;
        justify-self: center;
        width: 50%;
        height: 80%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }

    .liveImage video {
        background-color: whitesmoke;
        border-radius: 10px;
    }

    #liveClock {
        font-size: 2em;
        color: darkslategray;
        margin-bottom: 20px;
    }

    .liveImage .icon {
        font-size: 26px;
        margin-bottom: 20px;
        margin-right: 10px;
    }
</style>

<body>
    <?php include "user_menu.php"; ?>
    <div class="container_menu">
        <div class="chart_header">
            <div id="feedQuick">
                <span class="icon fa fa-fish"></span><span>500 grams fed</span>
            </div>
            <div id="waterQuick">
                <span class="icon fa fa-tint"></span><span class="status">Water Parameters </span>
            </div>
            <div id="tempQuick">
                <span class="icon fa fa-thermometer-half"></span><span>25°C</span>
            </div>
        </div> <!-- End of chart header -->

        <div class="liveImage">
            <span class="clockContainer" style="display: flex; flex-direction: row; align-items:center;">
                <span class="icon fa fa-clock"></span><span id="liveClock"></span>
            </span>
            <video id="video" width="100%" height="100%" autoplay controls>
                <source src="./video/fish_swimming.mp4" type="video/mp4">
            </video>
        </div>

    </div>
</body>
<script>
    function updateClock() {
        const now = new Date();
        const clock = document.getElementById('liveClock');
        clock.textContent = now.toLocaleTimeString();
    }
    setInterval(updateClock, 1000); // Update the clock every second
    updateClock(); // Initialize the clock
</script>

</html>
<?php ob_end_flush(); ?>