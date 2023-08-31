<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        if ($_POST["action"] === "edit_message") {
            // ... (empty)
        } elseif ($_POST["action"] === "view_logs") {
            // ... (empty)
        } elseif ($_POST["action"] === "other_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "clear_logs") {
            // ... (empty)
        } elseif ($_POST["action"] === "reset_messages") {
            // ... (clear messages)
        } elseif ($_POST["action"] === "disable_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "enable_feature") {
            // ... (empty)
        } elseif ($_POST["action"] === "maintenance_mode") {
            // ... (empty)
        } elseif ($_POST["action"] === "test_message") {
            $testMessageContent = $_POST["test_message_content"];
            $testMessage = array(
                "username" => "Console",
                "message" => $testMessageContent
            );

            $chatFilePath = 'chat.json'; // file
            $chatData = json_decode(file_get_contents($chatFilePath), true);
            $chatData[] = $testMessage;

            file_put_contents($chatFilePath, json_encode($chatData));

            echo "Test message sent successfully";
        } elseif ($_POST["action"] === "clear_chat") {
            $chatFilePath = 'chat.json'; // file
            file_put_contents($chatFilePath, json_encode([])); // json array

            echo "Chat cleared successfully";
        } elseif ($_POST["action"] === "delete_all_users") {
            // ... (delete users)
        } elseif ($_POST["action"] === "create_account") {
            // ... (create account)
        }
        // idk
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dev Panel</title>
    <style>
        body {
            background-color: black;
            color: green;
            font-family: 'Consolas', monospace;
        }
        .container {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Developer Panel</h1>
        
        <!-- edit messages form ... -->
        <!-- empty ... -->
        <!-- empty ... -->

        <!-- empty ... -->
        <!-- reset messages ... -->

        <!-- empty ... -->
        <!-- empty ... -->
        <!-- empty ... -->

        <!-- test message -->
        <h2>Send Test Message</h2>
        <form action="" method="POST">
            <input type="hidden" name="action" value="test_message">
            <label for="test_message_content">Test Message Content:</label><br>
            <textarea name="test_message_content" rows="3" cols="40" required></textarea><br>
            <button type="submit">Send Test Message</button>
        </form>

        <!-- clear chat -->
        <h2>Clear Chat</h2>
        <form action="" method="POST">
            <input type="hidden" name="action" value="clear_chat">
            <button type="submit">Clear Chat</button>
        </form>

        <!-- delete all users -->
        <h2>Delete All Users</h2>
        <form action="" method="POST">
            <input type="hidden" name="action" value="delete_all_users">
            <button type="submit">Delete All Users</button>
        </form>

        <!-- create account -->
        <h2>Create Account</h2>
        <form action="" method="POST">
            <input type="hidden" name="action" value="create_account">
            <button type="submit">Create Account</button>
        </form>
    </div>
</body>
</html>

<style>
input[type="text"],
input[type="password"],
input[type="button"]:hover,
textarea,
button,
button:hover {
    background-color: black;
    border: 2px solid white;
    color: white;
    padding: 10px;
    border-radius: 5px;
    font-size: 16px;
    transition: border-color 0.3s; /* transition */
}

input[type="button"]:hover,
button:hover {
    border-color: green; /* border on hover */
}

</style>