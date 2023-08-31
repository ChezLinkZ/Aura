<?php
session_start();

// Check if the user is not logged in
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

$username = $_SESSION["username"]; // Get the signed-in username

// Load user data from users.json
$users = json_decode(file_get_contents("users.json"), true);

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $selectedTheme = $_POST["theme"];

    // Update user's theme setting
    if (isset($users[$username])) {
        $users[$username]["theme"] = $selectedTheme;
        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Settings - Aura</title>
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="navbar">
        <img src="logo.png" class="logo">
        <button><img src="images/assets/auraplus.png"></button>
        <button class="current-button"><img src="images/assets/settings.png"></button>
        <a href="logout.php"><button style="margin-right: 80px;width: 180px;"><img src="images/assets/logout.png"></button></a>
    </div>
    
    <div class="settings-container">
        <h2>Settings</h2>
        <form action="settings.php" method="post">
            <label for="theme">Choose Theme:</label>
            <select name="theme">
                <option value="0" <?php echo $users[$username]["theme"] == 0 ? "selected" : ""; ?>>Theme 1</option>
                <option value="1" <?php echo $users[$username]["theme"] == 1 ? "selected" : ""; ?>>Theme 2</option>
                <!-- Add more theme options as needed -->
            </select>
            <button type="submit">Save</button>
        </form>
    </div>

  
</body>
</html>
dude i was so fuckiing scareed i got called up to the office with my pc, but he didnt look at it. also dont deelte things like this, i will
DUDE ARE YOU OK
bru
silly
yes
