<?php

require_once __DIR__."/config.php";

$postsPerPage = 6;

$pageNumber = 1;

if(isset($_GET['page']) && is_numeric($_GET['page'])){
    $pageNumber = $_GET['page'];
}

$offset = $postsPerPage * $pageNumber - $postsPerPage;

session_start();
// Only authenticated users can see private articles
if(isset($_SESSION['authenticated'])){
    $allPosts = "";
} else {
    $allPosts = "WHERE posts.public = 1";
}

$sql = "SELECT posts.id,
               posts.post_title,
               posts.post_content,
               posts.author_id,
               posts.created_at,
               users.first_name,
               users.last_name,
               pics.name
        FROM users
        INNER JOIN posts
        ON users.id = posts.author_id
        INNER JOIN pics 
        ON posts.picture_id = pics.id " . $allPosts . " ORDER BY posts.id DESC LIMIT :postsPerPage OFFSET :offset";
try {
    
    if(!isset($connection)){
        throw new Exception();
    }

    $stmt = $connection->prepare($sql);
    $stmt->bindParam(':postsPerPage', $postsPerPage, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

    if($stmt->execute()){
        $posts = $stmt->fetchAll();

        if($posts == false){
            header("location: index.php");
            die();
        }
    }

    $stmt = null;
    $connection = null;
} catch(Exception $e){
    echo "For some reason, something went wrong...<br>";
    // echo $e->getMessage(); // For a further log
}



 