<?php
    error_reporting(0);
    session_start();

    // check if user is authenticated
    if(!isset($_SESSION['authenticated'])){
        header('location: login.php');
        die;
    }
    require_once __DIR__."/backend/config.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title>User</title>
        <link href="css/user.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <nav>
            <h1>Hello, <?php echo $_SESSION['first_name'] . ' '. $_SESSION['last_name']; ?></h1>
                <ul>
                    <li><a href="index.php">First page</a></li>
                    <li><a href="resetPassword.php">Reset password</a></li>
                    <li><a href="backend/logout.php">Logout</a></li>
                    <li>
                        <?php
                            if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'writer')
                                echo '<a href="dashboard/add.php">Add an article</a>';
                        ?>
                    </li>
                    <li>
                        <?php
                            if($_SESSION['role'] == 'admin')
                                echo '<a href="#editor">Edit/Delete an article</a>';
                        ?>
                    </li>
                    
                </ul>
            </nav>
        </header>
        <main>
        
            <h2>For admins only</h2>
            <p>In order to edit/delete an article, pick an id from the corresponding table and click Edit/Delete.</p>
            <p>In order to delete a registered user, pick an id from the corresponding table and click Delete.</p>
            <p>The following tables will be empty, as long as the authenticated user doesn't have administrator rights.</p>

            <section id="posts" class="table-wrapper">
                <h3 id="editor">Posts</h3>
                <table>
                    <tr><th>Post Id</th><th>Post Title</th><th>Picture id</th><th>Public status</th><th>Created at</th><th>Author id</th><th>Edit post</th><th>Delete post</th></tr>
                    <?php 
                        $sql = "SELECT id, post_title, author_id, picture_id, public, created_at FROM posts ORDER BY id DESC";
                        if($stmt = $connection->query($sql)){
                            $data = $stmt->fetchAll();
                            foreach($data as $row){
                                if($_SESSION['role'] == 'admin')
                                {
                                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['post_title'] . "</td><td>" . $row['picture_id'] . "</td><td>" . $row['public'] . "</td><td>" . $row['created_at'] . "</td><td>" . $row['author_id'] . "</td><td><a href='dashboard/edit.php?postid=" . $row['id'] . "'>Edit</a></td><td><a href='dashboard/backend/deletePost.php?postid=" . $row['id'] . "'>Delete</a></td></tr>";
                                }
                                
                            }
                        }
                        $stmt = null;
                        
                    ?>
                </table>
            </section><!----><section id="users" class="table-wrapper">
                <h3>Users</h3>
                <p id="user-del-error"><?php if(isset($_SESSION['user_del_error'])) echo $_SESSION['user_del_error']; $_SESSION['user_del_error'] = ''; ?></p>
                <table>
                    <tr><th>User id Id</th><th>First name</th><th>Last name</th><th>Username</th><th>Role</th><th>Delete user</th></tr>
                    <?php 
                        $sql = "SELECT id, first_name, last_name, username, role FROM users";
                        if($stmt = $connection->query($sql)){
                            $data = $stmt->fetchAll();
                            foreach($data as $row){
                                if($_SESSION['role'] == 'admin')
                                {
                                    echo "<tr><td>" . $row['id'] . "</td><td>" . $row['first_name'] . "</td><td>" . $row['last_name'] . "</td><td>" . $row['username'] . "</td><td>" . $row['role'] . "</td><td><a href='dashboard/backend/deleteUser.php?userid=" . $row['id'] . "'>Delete</a></td></tr>";
                                }
                                
                            }
                        }
                        $stmt = null;
                        $connection = null;
                    ?>
                </table>
            </section>
        </main>
        <footer>
            <section id="footer-content">
                <p>Contact <a href="mailto:valentin.iclozan27@gmail.com">by e-mail</a></p>
                <p>This is a school project, made up with no intention of breaching copyrights. All code has been written, tweaked and tested by student <a href="https://adrian2771.github.io/studyproject/">Adrian Valentin Iclozan</a></p>
        </footer>
    </body>
</html>