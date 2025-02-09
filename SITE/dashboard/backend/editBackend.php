<?php
session_start();
if(!(isset($_SESSION['authenticated']) &&  $_SESSION['role'] == 'admin')){
    header('location: ../login.php');
    die;
}

// These includes will also work after including in edit.php file
require_once "../backend/config.php";
require_once "../backend/helper.php";

// We need to populate the picture table

$sql = "SELECT * from pics";
$stmt = $connection->query($sql);
$pictures = $stmt->fetchAll();
$sql = $stmt = null;

// Editing logic starts here

$title = $content = $public = $id = $picture_id = "";
$titleError = $contentError = $pictureIdError = "";

// case when landing on this page via GET
if(isset($_GET['postid']) && is_numeric($_GET['postid'])){
    $id = intval($_GET['postid']);
   
    $sql = "SELECT post_title, post_content, picture_id, public FROM posts WHERE id = :id";

    if($stmt = $connection->prepare($sql)){
        $stmt->bindParam(":id", $id);

        if($stmt->execute()){
            $post = $stmt->fetch();
            // User redirected to Add page if no valid post id provided
            if($post == false){ // an invalid id will return an empty result
                header('location: add.php');
                die;
            }
            // The following variables have a global scope!
            $title = $post['post_title'];
            $content = $post['post_content'];
            $public = $post['public'];
            $picture_id = $post['picture_id'];
        }
    }
    $stmt = null;
} else {
    header('location: add.php');
    die;
}

// case when landing on this page via POST
if($_SERVER['REQUEST_METHOD'] == 'POST'){

    $title = sanitize($_POST['title']);
    $content = $_POST['content'];
    $public = $_POST['public'];
    $id = intval($_POST['postid']);
    $picture_id = intval($_POST['picture_id']);

    if(empty($title)){
        $titleError = "Title field can't be left empty";
    }

    if(empty($content)){
        $contentError = "Content field can't be left empty";
    }

    if(empty($picture_id)){
        $pictureIdError = "Picture id field can't be left empty";
    }

    if(empty($titleError) && empty($contentError) && empty($pictureIdError)){
        $sql = "UPDATE posts SET post_title = :post_title, post_content = :post_content, picture_id = :picture_id, public = :public WHERE id = :id";
        if($stmt = $connection->prepare($sql)){
            $stmt->bindParam(':post_title', $title);
            $stmt->bindParam(':post_content', $content);
            $stmt->bindParam(':id', $id); 
            $stmt->bindParam(':public', $public);
            $stmt->bindParam(':picture_id', $picture_id);

            if($stmt->execute()){
                header('location: ../post.php?id=' . $id);
                die;
            } else {
                echo "Something unexpected happened";
            }
        }
        $stmt = null;
        $connection = null;
    }
}