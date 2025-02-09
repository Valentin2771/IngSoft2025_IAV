<?php

require_once __DIR__."/config.php";

$newPassword = $confirmPassword = "";
$newPasswordError = $confirmPasswordError = "";

if($_SERVER['REQUEST_METHOD'] == 'POST'){

    try{
        if(!isset($connection)){

            throw new Exception();
        }
    } catch (Exception $e) {
        echo "For some reason, something went wrong...<br>";
        // echo $e->getmessage(); // For a further log
        die;
    }

    
    if(!isset($connection)){
        throw new Exception();
    } else {

        $newPassword = trim($_POST['newPassword']);
        $confirmPassword = trim($_POST['confirmPassword']);

        if(empty($newPassword)){
            $newPasswordError = "The new password can't be empty.";
        
        } else if(strlen($newPassword) < 8){
            $newPasswordError = "The new password must be at least 8 characters long.";
            $newPassword = "";
        }

        if(empty($confirmPassword)){
            $confirmPasswordError = "The new password can't be empty.";
        
        } else if(strcmp($newPassword, $confirmPassword) != 0){
            $confirmPasswordError = "You must confirm the new password.";
            $newPassword = "";
            $confirmPassword = "";
        }

        // If the previous checks succeed, we'll update the information in the database
        if(empty($newPasswordError) && empty($confirmPasswordError)){
            $sql = "UPDATE users SET password = :password WHERE id = :id";
            if($stmt = $connection->prepare($sql)){
                $hashedPwd = password_hash($newPassword, PASSWORD_DEFAULT);
                $stmt->bindParam(':password', $hashedPwd);
                $stmt->bindParam(':id', $_SESSION['id']);
                if($stmt->execute()){
                    header('location: backend/logout.php'); 
                    die;
                }
            } else {
                echo "Something unexpected happened. No changes have been made to the database.";
            }
            $stmt = null;
            $connection = null;
        }
    }
} 