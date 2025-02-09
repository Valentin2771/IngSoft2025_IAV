<?php
    require_once __DIR__."/backend/postBackend.php";
?>

<!DOCTYPE html>
<html>
    <head>
        <title><?php ?></title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
        <link href="css/indexStyle.css" rel="stylesheet">
    </head>
    <body>
        <header>
        
            <h1 class="blue"><a href="index.php">Bine ați venit la Blue Jack Asylum</a></h1>
            <hr>
            <nav>
                <a href="index.php">First page</a>
                <a href="login.php">Login</a>
                <a href="register.php">Register</a>
            </nav>
        </header>
        <main>
            <section>
                <h2 class='blue' id="top"><?php echo $title; ?></h2>
                <span class="fixed-button"><a href="#top">Top</a></span>
                <article class="single-post">
                    <div class="single-post-img">
                        <img <?php echo "src='img/" . $picture . "' alt='post image'"; ?>> 
                    </div>
                    
                    <p><?php echo $content; ?></p>
                    <p>Author: <?php echo $author; ?><small> Created: <?php echo $created; ?></small><small> Modified: <?php echo $modified; ?></small></p>
                <article>
            <hr>
            </section>
        </main>
        <footer>
            <section id="footer-content">
                <p>Contact <a href="mailto:valentin.iclozan27@gmail.com">via e-mail</a></p>
                <p>Acesta este un proiect școlar, care a avut în vedere respectarea condițiilor de copyright. Fotografiile utilizate sunt preluate din <a href="https://pixabay.com/" target="_blank">surse gratuite</a>. Întreg codul a fost scris, modificat și testat de studentul <a href="https://adrian2771.github.io/studyproject/">Adrian Valentin Iclozan</a></p>
            </section>
        </footer>
    </body>
</html>