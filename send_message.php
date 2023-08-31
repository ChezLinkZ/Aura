<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    session_start();

    if (!isset($_SESSION["username"])) {
        http_response_code(403); // Forbidden
        exit("Access denied. You must be logged in to send messages.");
    }

    $username = $_SESSION["username"];
    $message = $_POST["message"];

    // Load existing messages from chat.json
    $messages = json_decode(file_get_contents("chat.json"), true);

    // Add the new message to the array
    $newMessage = ["username" => $username, "message" => $message];
    $messages[] = $newMessage;

    // Save the updated messages to chat.json
    file_put_contents("chat.json", json_encode($messages, JSON_PRETTY_PRINT));

    // Redirect back to the index page
    header("Location: index.php");
    exit();
}
?>
