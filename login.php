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

    if (isset($users[$username]) && password_verify($password, $users[$username]["password"])) {
        // Successful login
        $_SESSION["username"] = $username;
        header("Location: index.php");
        exit();
    } else {
        $error = "Invalid username or password";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="login.css" />
  
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"
  />
</head>
<body>
  <div class="login-switch"><button class="inactive-button"><a href="signup.php">Signup</a></button><button style="float: right;" class="current-switch"><a href="login.php">Login</a></button></div>
  <h2>Login</h2>
    <div class="login-container">
        <form action="login.php" method="post" class="login-form">
            
            <?php if (isset($error)) { ?>
                <p class="error"><?php echo $error; ?></p>
            <?php } ?>
            <div class="login-inputs">
            <div class="input"><img src="images/user-icon.png"><input type="text" name="username" placeholder="Username" required></div><br>
            <div class="input"><img src="images/lock-icon.png"><input type="password" name="password" placeholder="Password"  required></div><br>
            <button type="submit">Log In<span style="margin-left: 30px;">➤</span></button><br>
              
            </div>
        </form>
    </div>
</body>
</html>
