<?php
session_start();
require_once __DIR__."/../../backend/config.php";

if(!(isset($_SESSION['authenticated']) && $_SESSION['role'] == 'admin')){
    header('location: ../../user.php');
    die;
}

// echo "For admins only!";

try{
    if(!isset($connection)){
        throw new Exception();
    } 
} catch(Exception $e){
    echo "For some reason, something wrong happened...<br>";
    // echo $e->getMessage(); // For a further log
    die;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    // Changes can be made to the database only upon a valid post id
    if(is_numeric($_GET['postid'])){
        $post_id = intval($_GET['postid']);
        $sql = "DELETE FROM posts WHERE id = :id";

        if($stmt = $connection->prepare($sql)){
            $stmt->bindParam(':id', $post_id);

            $stmt->execute();
            $stmt = null;
            $connection = null;
            header('location: ../../user.php');
        }
    }
}

