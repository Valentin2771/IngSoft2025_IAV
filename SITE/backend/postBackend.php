<?php

require_once __DIR__. "/config.php";

if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id = intval($_GET['id']);

    $sql = "SELECT pics.name, posts.post_title, posts.post_content, posts.public, posts.created_at, posts.modified_at, users.first_name, users.last_name 
    FROM users INNER JOIN posts 
    ON users.id = posts.author_id
    INNER JOIN pics
    ON posts.picture_id = pics.id
    WHERE posts.id = :id";

    try{
        if(!isset($connection)) {
            
            throw new Exception();
        }
    } catch(Exception $e){
        echo "For some reason, something went wrong...<br>";
        // echo $e->getMessage() // For a further log
        die;
    }

    if($stmt = $connection->prepare($sql)){
        $stmt->bindParam(':id', $id);

        if($stmt->execute()){
            $post = $stmt->fetch();
            session_start();
            if($post == false || ($post['public'] == 0 && !isset($_SESSION['authenticated']))) {
                header('location: ../index.php'); // If this page is accessed directly, user is redirected to an empty page!
                die;
            }
            // A variable declared outside a function has a global scope
            $title = $post['post_title'];
            $content = $post['post_content'];
            $created = $post['created_at'];
            $modified = $post['modified_at'];
            $author = $post['first_name'] . ' ' . $post['last_name'];
            $picture = $post['name'];
        }
        $stmt = null;
    }
    $connection = null;

} else {
    header('location: ../index.php');
    die;
}