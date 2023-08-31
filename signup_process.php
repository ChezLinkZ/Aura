<?php
session_start();

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code here
    include("db_connection.php");

    // Get form data
    $username = $_POST["username"];
    $password = $_POST["password"];
    $theme = $_POST["theme"]; // Assuming you have a form field for theme selection

    // Hash the password
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and execute the SQL query to insert the new user into the database
    $stmt = $connection->prepare("INSERT INTO users (username, password, theme) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashedPassword, $theme);

    if ($stmt->execute()) {
        // User registration successful
        $_SESSION["username"] = $username; // Log the user in
        $_SESSION["theme"] = $theme; // Store the theme in the session
        header("Location: index.php"); // Redirect to the main page
        exit();
    } else {
        // Registration failed
        $_SESSION["signup_error"] = "Registration failed. Please try again.";
        header("Location: signup.php"); // Redirect back to signup page
        exit();
    }

    // Close the database connection
    $stmt->close();
    $connection->close();
}
?>
