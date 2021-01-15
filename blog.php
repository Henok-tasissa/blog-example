<?php
session_start();
require("db.php");

if(empty($_GET['id']) || !isset($_GET['id'])){
    header("Location: index.php");
}

if(!empty($_POST['blogId']) && !empty($_POST['comment'])){
    $userId = $_SESSION['userId'];
    $blogId = $_POST['blogId'];
    $comment = $_POST['comment'];

    $sql = "INSERT INTO comments(author_id,blog_id,comment) VALUES('$userId','$blogId','$comment')";

    $query = mysqli_query($conn,$sql);
    if($query){
        echo "<p>Successfully commented on post.</p>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <link href="./style.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="main-container">
        <nav>
            <a class="home-nav" href="index.php">HOME</a>
            <?php
                if(isset($_SESSION['userId'])){
                    echo '<a class="sign-nav" href="logout.php">Logout</a>';
                }else{
                    echo '<a class="sign-nav" href="signup.php">Sign Up</a>';
                }
            ?>
        </nav>
        <content>
             <?php
                require("db.php");
                $id = $_GET['id'];

                $sql = "SELECT blog.title,blog.content,users.first_name,users.last_name FROM blog LEFT JOIN users ON blog.author_id = users.id WHERE blog.id='$id'";

                $query = mysqli_query($conn,$sql);

                while($blog = mysqli_fetch_assoc($query)){
                    echo '<div class="blog-container">';
                    echo '<h1>'.$blog['title'].'</h1>';
                    echo '<p>'.$blog['content'].'</p>';
                    echo '<p>Author name: <strong>'.$blog['first_name'].' '.$blog['last_name'].'</strong></p>';
                   echo '</div>';
                }
            ?>
            <div>
                <?php 
                if(isset($_SESSION['userId'])){
                echo '<form class="comment-form-container" action="#" method="POST">
                        <input type="hidden" name="blogId" value='.$_GET["id"].' />
                        <textarea name="comment" placeholder="Write your comment here."></textarea> <br><br>
                        <input type="submit" name="Comment">
                     </form>';
                }else{
                    echo "<p>Sign in to give a comment.</p>";
                }

                ?>
                <p>Comments:</p>
                <?php
                    $blogId = $_GET['id'];
                    $sql = "SELECT comments.author_id,comments.blog_id,comments.comment,users.first_name,users.last_name FROM comments LEFT JOIN users ON comments.author_id=users.id WHERE comments.blog_id='$blogId'";

                    $query = mysqli_query($conn,$sql);

                    while($comment = mysqli_fetch_assoc($query)){
                        echo "<div>
                    <p><strong>".$comment['first_name']." ".$comment['last_name']."</strong>:</p>";
                    echo "<p>".$comment['comment']."</p></div>";
                    }

                ?>
            </div>
        </content>
    </div>
</body>

</html>