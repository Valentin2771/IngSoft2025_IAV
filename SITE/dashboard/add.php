<?php
require_once __DIR__."/backend/addBackend.php";
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Add New Post</title>
        <link href="../css/dashboard.css" rel="stylesheet">
    </head>
    <body>
        <h1>Welcome to Add New Post page</h1>
        <div class="clearfix">
            <section class="sixty">
                <h2>Editor</h2>
                <a href="../user.php" class="button-link">User's page</a>
                
                <form id="post-form" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST">
                    <label for="title">Post title:</label>
                    <input type="text" id="title" name="title" placeholder="Add title" maxlength="100" size="100" value="<?php if(isset($title) && !empty($title)) echo $title;?>">
                    <span class="red"><?php echo $titleError; ?></span><br>
                    <label for="public">Public: </label>
                    <select name="public" id="public">
                        <option value="0" selected>No</option>
                        <option value="1">Yes</option>
                    </select><br><br>
                    <label for="picture_id">Picture id:</label>
                    <input type="text" name="picture_id" id="picture_id" placeholder="Add picture id" value="<?php if(isset($picture_id) && !empty($picture_id)) echo $picture_id;?>"><br>
                    <span class="red"><?php echo $pictureError; ?></span><br>
                    <label for="content">Post content: </label>
                    <textarea name="content" id="content" placeholder="Add content"><?php if(isset($content) && !empty($content)) echo $content;?></textarea>
                    <span class="red"><?php echo $contentError; ?></span><br>
                    <input type="submit" value="Publish"><br>
                </form>
            
            </section>
            <section class="forty">
                <h2>Pictures</h2>
                <div id="img-table">
                    <table>
                        <tr><th>Id</th><th>Name</th><th>Category</th><th>Path</th></tr>
                        <?php 
                        if(isset($pictures)){
                            foreach($pictures as $picture){
                                echo "<tr><td>". $picture['id']. "</td><td>" . $picture['name'] . "</td><td>" . $picture['category'] ."</td><td><a href='../" . $picture['path'] . "/" . $picture['name'] . "' target='_blank'>View</a></td></tr>";
                            }
                        }
                        ?>
                    </table>
                </div>
            </section>
        </div>
    </body>
</html>