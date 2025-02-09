<?php 
    require_once __DIR__."/backend/indexBackend.php";
?>

<!DOCTYPE html>
<html lang="RO">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blue Jack Asylum</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed" rel="stylesheet">
    <link href="css/indexStyle.css" rel="stylesheet">
</head>
<body>
    <header>
        <h1 class="blue"><a href="index.php">Bine ați venit la azilul lui Blue Jack</a></h1>
        <hr>
        <nav>
            <a href="login.php">Login</a>
            <a href="register.php">Register</a>
            <a href="sendMail.php">Contact us</a>
        </nav>
    </header>
    <main>
        <section id="all-stories">
        <h2 id="top">Toate titlurile</h2>
        <span class="fixed-button"><a href="#top">Top</a></span>
        <?php
            try{
                if(!isset($posts)){
                    throw new Exception();
                    
                } else {

                    for($i = 0; $i < count($posts); $i++): ?>
            
                        <article class="one-third">
                            <h3 class="blue">
                                <a href="post.php?id=<?php echo $posts[$i]['id'] . '&page=' . $pageNumber; ?>"><?php echo $posts[$i]['post_title'];?></a>
                            </h3>
                            <div class="post-img">
                                <img src="img/<?php echo $posts[$i]['name'];?>" alt="post image">
                            </div>
                            <p><?php echo mb_strimwidth($posts[$i]['post_content'], 0, 100, '...'); ?></p>
                            <p class="author">Author: <?php echo $posts[$i]['first_name'] . ' ' . $posts[$i]['last_name'] . ' &bull; ' . $posts[$i]['created_at']; ?></p>
                            <a href="post.php?id=<?php echo $posts[$i]['id']; ?>">More</a>
                        </article><!-- We need to clearfix after each line of three articles or at the end of the last article,
                         in order to avoid unexpected floating effects -->
                        <?php 
                            if((($i + 1 != 0) && (($i + 1) % 3 == 0)) || $i == count($posts) - 1) echo '<div class="clearfix"></div>';
                             endfor;
                    }
                } catch(Exception $e) {
                echo "For some reason, something went wrong...<br>";
                // echo $e->getMessage(); // For a further log
            }
            
        ?>
        </section>
        <div id="pagination">
            <a href="index.php?page=<?php echo ($pageNumber - 1); ?>"><button <?php if($pageNumber - 1 <= 0) echo 'disabled'; ?>>Previous page</button></a>
            <a href="index.php?page=<?php echo ($pageNumber + 1); ?>"><button>Next page</button></a>
        </div>
    </main>
    <footer>
            <section id="footer-content">
                <p>Contact <a href="mailto:valentin.iclozan27@gmail.com">via e-mail</a></p>
                <p>Acesta este un proiect școlar, care a avut în vedere respectarea condițiilor de copyright. Fotografiile utilizate sunt preluate din <a href="https://pixabay.com/" target="_blank"> surse gratuite</a>. Întreg codul a fost scris, modificat și testat de studentul <a href="https://adrian2771.github.io/studyproject/">Adrian Valentin Iclozan</a></p>

            </section>
    </footer>
</body>
</html>