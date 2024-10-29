<?php
// Ensure the date is passed
if (isset($_POST['date'])) {
    $selectedDate = $_POST['date'];  // Date format: YYYY-MM-DD

    // Path to the uploads folder
    $directory = '../uploads/';

    // Convert date to the format used in image filenames: YYYY.MM.DD
    $datePattern = str_replace('-', '.', $selectedDate);

    // Find all images that match the selected date
    $images = glob($directory . "$datePattern*.{jpg,png,gif,jpeg}", GLOB_BRACE);

    if (count($images) > 0) {
        // Display the matching images
        foreach ($images as $image) {
            $imageUrl = str_replace($directory, '/uploads/', $image);  // Convert to URL format
            echo "<img src='$imageUrl' alt='Image for $selectedDate' class='gallery-image' style='transform:rotate(180deg);' />";
        }
    } else {
        echo "<p>No images found for the selected date.</p>";
    }
} else {
    echo "<p>No date selected.</p>";
}
?>
