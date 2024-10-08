<!DOCTYPE html>
<html>
<head>
<title>Equa Smart</title>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="manifest" href="/manifest.php">

</head>
<body>
<div id="page">
  <div id="header">
    <div><img src="images/logo.png" alt="" style="width: 20%;"></div>
    <ul>
      <li class="current"><a href="index.php"><span><i class="fa fa-home"></i> Home</span></a></li>
      <li><a href="wes.php"><span>What is Equa Smart</span></a></li>
      <li><a href="tips.php"><span>Advantages </span></a></li>
      <li><a href="gallery.php"><span><i class="fa fa-image"></i> Gallery</span></a></li>
      <li><a href="about.php"><span><i class="fa fa-user-circle-o"></i> About</span></a></li>
      <li><a href="contact.php"><span><i class="fa fa-phone"></i> Contact</span></a></li>
      <button id="installButton" style="display: none;">Install App</button>
      <a href="login_page.php"><span><i class="fa fa-sign-in"></i> Login</span></a></li>
    </ul>
  </div>
  <div id="body">
    <ul>
      <li>
        <h1>Equa Smart</a></h1>
        <div> <img src="images/aqua.jpg" alt="" style="width: 98%; height: 100%"></a> </div>
        <span>What is Aquaponics</span>
        <p>Aquaponics is a sustainable farming method that integrates aquaculture, the raising of fish or other aquatic animals, with hydroponics, the growing of plants in water. In this symbiotic system, fish waste provides essential nutrients for the plants, while the plants help to filter and purify the water, which is then recirculated back to the fish tanks. </p>
        <a href="wes.php" class="readmore">Read more</a> </li>
      <li>
        <h1><a href="tips.html">Advantage of Equa Smart</a></h1>
        <div> <a href="tips.html"><img src="images/18.jpg" alt="" style="width: 98%; height: 100%"></a> </div>
        <span>Vestibulum Ut Nisl Nec Massa Interdum Tincidunt</span>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris aliquet interdum diam, vitae tristique diam feugiat id. If you're having problems editing this website template, then don't hesitate to ask for help on the Forum.</p>
        <a href="tips.php" class="readmore">Read more</a> </li>
      <li>
        <h1><a href="#">Equa Smart Gallery</a></h1>
        <div> <a href="#"><img src="images/1.jpg" alt="" style="width: 98%; height: 100%;"></a> </div>
        <div> <a href="#"><img src="images/2.jpg" alt="" style="width: 98%; height: 100%;"></a> </div>
        <a href="gallery.php" class="readmore">View More</a> </li>
    </ul>
  </div>
<div id="footer">
    <ul>
      <li>
        <h3>Books</h3>
        <div id="magazine">
          <p>The book of Complete guide to Aquaponics</p>
          <a href="#"><img src="images/book.jpg" alt=""style="width: 72%; "></a> </div>
      </li>
      <li>
        <h3>Gallery</h3>
        <div id="gallery"> <b>Gellery of Aquaponics</b> <a href="#"><img src="images/14.jpg" alt="" style="width: 90%; height: 100%;"></a>
          <p>This is the Gallery of Aquaponics or Equa Smart <br>
            by: Group Phoenix</p>
          <a href="gallery.php" class="viewall">View all Photos</a> </div>
      </li>
      <li>
        <h3>Get in Touch</h3>
        <div>
          <p>Email:<br>
            Equasmart@gmail.com<br>
            <br>
          </p>
          <p>Address:<br>
            Block 7 Lot 11 Mt. Kilimanjaro Street Panorama Hills Subdivision, Antipolo<br>
            <br>
          </p>
          <p>Phone:<br>
            +639 475402264</p>
        </div>
      </li>
    </ul>
    <div>
      <p style="text-align: center;color: #988878;">Copyright © 2024 Group Phoenix ®</p>
    </div>
  </div>
</div>
</body>
<script>

   // Register the service worker when the page loads
   if ('serviceWorker' in navigator) {
  window.addEventListener('load', () => {
    navigator.serviceWorker.register('/service-worker.js')
      .then((registration) => {
        console.log('ServiceWorker registration successful with scope: ', registration.scope);
      }).catch((error) => {
        console.log('ServiceWorker registration failed: ', error);
      });
  });
  }

  let deferredPrompt;

// Listen for the 'beforeinstallprompt' event
window.addEventListener('beforeinstallprompt', (event) => {
  // Prevent the default mini-infobar from appearing
  event.preventDefault();

  // Store the event to trigger it later
  deferredPrompt = event;

  // Show the install button
  const installButton = document.getElementById('installButton');
  installButton.style.display = 'block';

  // Handle the install button click event
  installButton.addEventListener('click', () => {
    // Hide the button after it is clicked
    installButton.style.display = 'none';

    // Show the install prompt
    deferredPrompt.prompt();

    // Wait for the user to respond to the prompt
    deferredPrompt.userChoice.then((choiceResult) => {
      if (choiceResult.outcome === 'accepted') {
        console.log('User accepted the install prompt');
      } else {
        console.log('User dismissed the install prompt');
      }
      deferredPrompt = null;
    });
  });
});

// Optionally, listen for the 'appinstalled' event to detect when the app is installed
window.addEventListener('appinstalled', () => {
  console.log('PWA has been installed');
});


</script>
</html>
