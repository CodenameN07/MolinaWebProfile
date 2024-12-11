<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent XSS
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $comment = htmlspecialchars(trim($_POST['comment']));

    // Validate inputs
    if (!empty($name) && !empty($email) && !empty($comment)) {
        // Connect to the database
        $servername = "localhost";
        $username = "root";  // Change this to your database username
        $password = "";      // Change this to your database password
        $dbname = "webprofdb";  // Your database name

        // Create a connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
            echo "error"; // If connection fails, return error
        } else {
            // Insert data into the database
            $sql = "INSERT INTO comments (name, email, comment) VALUES ('$name', '$email', '$comment')";
            if ($conn->query($sql) === TRUE) {
                echo "success"; // If successful, return success
            } else {
                echo "error"; // If there was a problem, return error
            }
        }

        // Close connection
        $conn->close();
    } else {
        echo "error"; // If fields are empty, return error
    }
}
?>
