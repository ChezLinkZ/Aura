<?php
session_start();

// Check if the user is already logged in
if (isset($_SESSION["username"])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Load user data from users.json
    $users = json_decode(file_get_contents("users.json"), true);

    if (!isset($users[$username])) {
        // Hash the password
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Add user to users.json
        $users[$username] = ["password" => $hashedPassword, "theme" => 0];
        file_put_contents("users.json", json_encode($users, JSON_PRETTY_PRINT));

        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Username already taken";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>
<body>
  
    <div class="login-switch"><button class="current-switch"><a href="signup.php">Signup</a></button><button class="inactive-button" style="margin-left: 50px;"><a href="login.php">Login</a></button></div>
    <h2>Sign Up</h2>
    <div class="login-container">
        <form action="signup.php" method="post" class="login-form">
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="login-inputs">
                <div class="input">
                    <img src="images/user-icon.png">
                    <input type="text" name="username" placeholder="Username" maxlength=24 required>
                </div><br>
                <div class="input">
                    <img src="images/lock-icon.png">
                    <input type="password" name="password" placeholder="Password" required>
                </div><br>
                <button type="submit">Sign Up<span style="float: right;">➤</span></button><br>
            </div>
        </form>
    </div>
</body>
</html>
