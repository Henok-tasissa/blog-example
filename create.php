<?php
    session_start();
    if(!isset($_SESSION['userId'])){
        header("Location: index.php");
    }
?>

<?php
    require("./db.php");

    $title = $_POST['title'];
    $content = $_POST['content'];
    $authorId = $_SESSION['userId'];

    if(!empty($title) && !empty($content)){
        $sql = "INSERT INTO blog(author_id,title,content) VALUES('$authorId','$title','$content')";
        $query = mysqli_query($conn,$sql);

        if($query){
            echo "Blog Posted";
            header("Location: index.php");
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
            <a class="home-nav" href="index.php">Blogs</a>
            <a class="sign-nav" href="logout.php">Logout</a>
        </nav>
        <content>
            <form action="create.php" method="POST">
                <input name="title" placeholder="Title" /> <br><br>
                <textarea name="content" placeholder="Blog content"></textarea><br><br>
                <input type="submit" value="Create" />
            </form>
        </content>
    </div>
</body>

</html>