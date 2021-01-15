<?php
    session_start();
    if(isset($_SESSION['userId'])){
        header("Location: create.php");
    }
?>

<?php
require("db.php");

$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($email) && !empty($password)){
    $password = md5($password);

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";

    $query = mysqli_query($conn,$sql);


    if(mysqli_num_rows($query)>0){
       $user = mysqli_fetch_assoc($query);
       $userId = $user['id'];

       $_SESSION['userId'] = $userId;
       header("Location: create.php");
    }
}

?>
<!Doctype html>
<html>
<head>
    <link href="./style.css" type="text/css" rel="stylesheet" />
</head>

<body>
    <div class="main-container">
        <nav>
            <a class="home-nav" href="index.php">HOME</a>
            <a class="sign-nav" href="signup.php">Sign Up</a>
        </nav>
        <content>
            <form action="./login.php" method="POST">
                <input name="email" placeholder="Email address"> <br><br>
                <input name="password" type="password" placeholder="Password"> <br><br>
                <input type="submit" value="Login" />
            </form>
        </content>
    </div>
</body>

</html>