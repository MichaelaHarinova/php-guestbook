<?php
declare(strict_types=1);

require 'Post.php';
require 'PostLoad.php';


$postLoad = new PostLoad("messages.txt");

if (isset ($_POST['name'], $_POST['title'], $_POST['content']) && !empty($_POST['name'] && !empty($_POST['title']) && !empty($_POST['content']))) {
    //str_replace get rid of the \n otherwise they can break the program when unserializing
    $post = new Post( $_POST['title'], str_replace("\n", "", $_POST['content']),$_POST['name']);
    $postLoad->addPost($post);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" type="text/css"
          rel="stylesheet"/>
    <link href="style.css" rel="stylesheet" type="text/css"/>
    <title>Guestbook</title>
</head>
<body>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>">
    <div>
        <h1>Guestbook</h1>
        <table>
            <tr>
                <th>Date</th>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
            </tr>
            <?php
            if (count($postLoad->getPosts()) === 0) {
                echo "No posts available";
            } else {
                foreach ($postLoad->getPosts() as $post) {
                    echo "<tr>";
                    echo "<td>" . date("Y M d - h:i:s", $post->getUnixTimeStamp()) . "</td>";
                    echo "<td>" . $post->getTitle() . "</td>";
                    echo "<td>" . $post->getContent() . "</td>";
                    echo "<td>" . $post->getAuthorName() . "</td>";
                    echo "</tr>";
                }
            }
            ?>
        </table>
    </div>
    <fieldset>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="title">Title:</label>
                <input type="text" name="title" class="form-control" id="title"/>
            </div>
            <br>
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="content">Content:</label>
                <input type="text" name="content" class="form-control" id="content"/>

            </div>
            <br>
            <div class="form-group col-md-6">
                <label for="author-name">Author's name</label>
                <input type="text" name="name" class="form-control" id="author-name"/>

            </div>
            <br>
            <div class="form-group col-md-6">
                <input type="submit" value="post comment" name="button" class="form-control"/>

            </div>
        </div>
    </fieldset>
</form>
</body>
</html>

