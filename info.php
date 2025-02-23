<?php
// Enable error reporting to catch any issues
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Allow cross-origin requests (CORS headers)
header("Access-Control-Allow-Origin: *"); // Allow any domain to access the resource
header("Access-Control-Allow-Methods: POST, GET, OPTIONS"); // Allow POST method
header("Access-Control-Allow-Headers: Content-Type"); // Allow Content-Type header

// Check if the form was submitted via POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if required fields are present in the POST request
    if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['message'])) {
        // Sanitize the input data to prevent XSS
        $name = htmlspecialchars($_POST["name"]);
        $email = htmlspecialchars($_POST["email"]);
        $message = htmlspecialchars($_POST["message"]);

        // Prepare the data entry
        $entry = "Name: $name\nEmail: $email\nMessage:\n$message\n-----------------\n";

        // Path to the file where inquiries will be saved
        $file = 'inquiries.txt';

        // Attempt to append the data to the file
        if (file_put_contents($file, $entry, FILE_APPEND | LOCK_EX)) {
            echo "Your inquiry has been saved successfully!";
        } else {
            echo "There was an error saving your inquiry.";
        }
    } else {
        echo "Required fields are missing.";
    }
} else {
    echo "Invalid request method.";
}
?>