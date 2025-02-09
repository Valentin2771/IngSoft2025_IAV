<?php
    session_start();

    if(isset($_SESSION['authenticated'])){
        header('Location: user.php');
        die;
    }

    require_once __DIR__."/backend/sendMailBackend.php"
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">-->
    <link href="css/loginRegisterReset.css" rel="stylesheet">

    <title>Contact</title>
</head>
<body>
    <div class="wrapper">
        <h2>Contact form</h2>
        
        <form id="mail-form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
            <label for="name">First and last name:</label><br>
            <input type="text" name="name" id="name" placeholder="Provide your full name" required class="custom-input"><br>
            <label for="email">Email:</label><br>
            <input type="email" name="email" id="email" placeholder="Provide a valid address" required class="custom-input"><br>
            <label for="subject">Subject</label><br>
            <input type="text" name="subject" id="subject" placeholder="The subject you want to take up with us" required class="custom-input"><br>
            <label for="content">Message</label><br>
            <textarea name="content" id="content" placeholder="Message up to 3000 characters" maxlength="3000"></textarea><br>
            <span class="red"><?php echo $mailError; ?></span><br><br>
            <input type="submit" id="submit" value="submit" disabled><br><br>
            <input type="text" name="validation" id="validation" placeholder="Captcha" class="custom-input"><br>
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