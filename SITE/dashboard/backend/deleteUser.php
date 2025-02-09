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
    echo "For some reason, something went wrong...<br>";
    die;
}

if($_SERVER['REQUEST_METHOD'] == 'GET'){
    if(is_numeric($_GET['userid'])){
        $user_id = intval($_GET['userid']);
        $sql1 = "SELECT role FROM users WHERE id = :id";

        if($stmt1 = $connection->prepare($sql1)){
            $stmt1->bindParam(':id', $user_id);
            $stmt1->execute();
            $user = $stmt1->fetch();

            if($user['role'] == 'admin') {
                // Users with 'admin' role can't be deleted!
                $_SESSION['user_del_error'] = "Users with 'admin' role couldn't be deleted!";
                header('location: ../../user.php');
                die;
            } else {
                // Deletion of any other users will be allowed, but we must first verify if they have published posts
                // If so, we must first delete their posts (foreign key constraint)
                $stmt1 = null;

                $sql2 = "SELECT post_title
                FROM posts INNER JOIN users
                ON posts.author_id = users.id
                WHERE users.id = :id";

                if($stmt2 = $connection->prepare($sql2)){
                    $stmt2->bindParam(':id', $user_id);
                    $stmt2->execute();
                    $titles = $stmt2->fetch();
                    if($titles){
                        // User still hass posts
                        $_SESSION['user_del_error'] = "Users having posts can't be deleted! Delete their posts first!";
                        header('location: ../../user.php');
                        die;
                    } else {
                        $sql3 = "DELETE FROM users WHERE id = :id";
                        if($stmt3 = $connection->prepare($sql3)){
                            $stmt3->bindParam(':id', $user_id);
                            $stmt3->execute();
                            header('location: ../../user.php');
                        }
                        $stmt3 = null;
                    }
                }
            }
        }
    }
}

$connection = null;
header('location: ../../user.php');