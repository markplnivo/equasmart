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
        // Display the matching images with specific styling for each test type
        foreach ($images as $image) {
            $imageUrl = str_replace($directory, '/uploads/', $image);  // Convert to URL format

            // Extract the test type from the filename
            preg_match('/testType(.*?)_/', basename($image), $matches);
            $testType = isset($matches[1]) ? $matches[1] : 'default';

            // Determine style based on test type
            $shadowColor = 'gray';  // Default color
            switch ($testType) {
                case 'ammonia':
                    $shadowColor = 'blue';
                    break;
                case 'nitrate':
                    $shadowColor = 'green';
                    break;
                case 'ph':
                    $shadowColor = 'red';
                    break;
            }

            // Apply styling and display the image
            echo "<img src='$imageUrl' alt='Image for $selectedDate' class='gallery-image' style='transform:rotate(180deg); box-shadow: 0px 0px 10px 5px $shadowColor;' />";
        }
    } else {
        echo "<p>No images found for the selected date.</p>";
    }
} else {
    echo "<p>No date selected.</p>";
}
?>
