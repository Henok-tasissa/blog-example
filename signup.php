<?php
    require("./db.php");
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if(!empty($firstName) && !empty($lastName) && !empty($email) && !empty($password)){
        $password = md5($password);

        $sql = "INSERT INTO users(first_name,last_name,email,password) VALUES ('$firstName','$lastName','$email','$password')";

        $query = mysqli_query($conn,$sql);

        if($query){
            echo "User registered successfully. Please <a  href='login.php'>click here</a> to login.";
        }else{
            //echo "User not registered";
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
            <a class="sign-nav" href="login.php">Login</a>
        </nav>
        <content>
            <form action="signup.php" method="POST">
                <input name="firstName" placeholder="First Name"> <br><br>
                <input name="lastName" placeholder="Last Name"> <br><br>
                <input name="email" placeholder="Email address"> <br><br>
                <input name="password" type="password" placeholder="Password"> <br><br>
                <input type="submit" value="Sign Up" />
            </form>
        </content>
    </div>
</body>
</html>