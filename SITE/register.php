<?php
session_start();

require_once __DIR__."/backend/registerBackend.php";

if(isset($_SESSION['authenticated'])){
    header("Location: user.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="css/loginRegisterReset.css" rel="stylesheet">
        <title>Register</title>
    </head>
    <body>
        <div class="wrapper">
            <h1>Register</h1>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="text" name="first_name" placeholder="First name" class="custom-input"><br><br>
                <input type="text" name="last_name" placeholder="Last name" class="custom-input"><br><br>
                <input type="text" name="username" placeholder="User name" class="custom-input"><br>
                <span class="red"><?php echo $usernameError;?><br>
                <input type="password" name="password" placeholder="Password" class="custom-input"><br>
                <span class="red"><?php echo $passwordError;?><br>
                <input type="password" name="confirmPassword" placeholder="Password re-typed" class="custom-input"><br>
                <span class="red"><?php echo $confirmPasswordError;?><br>
                <input type="submit" id="submit" disabled><br><br>
                <input type="text" name="validation" id="validation" placeholder="Captcha" class="custom-input"><br><br>
            </form>
            <div id="captchaBackrgound">
                <canvas id="captcha"></canvas>
            </div>
            <span id="buttonVal">Validate</span>
            <a href="index.php" target="_self" class="button-link">First page</a>
        </div>
        <script src="js/captcha.js"></script>
    </body>
</html>
