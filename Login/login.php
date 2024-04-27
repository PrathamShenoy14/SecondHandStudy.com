<?php

require '../dbh.inc.php';
if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE username = '$username' OR email='$username'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)>0){
        if($password == $row["pwd"]){
            
            if(isset($_POST["remember"])){
                setcookie("user",$row["username"],time()+(30*60));
                setcookie("pass",$row["pwd"],time()+(30*60));
            }

            $_SESSION["id"] = $row["id"];
            header("Location: ../home.php");
            
        }
        else{
            echo "<script> alert('Password Incorrect'); </script>";
            header("Location ./login.php");
            exit();
        }

    }
    else{
        echo "<script> alert('User not registered'); </script>";
        header("Location ./login.php");
        exit();
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./login.css">
    
</head>
<body>

    
    <div class="container">
        <form action="" id="form" method="post" autocomplete="off">
            <h1 class="dancing-script">Login Form</h1>
            
            <div class="form-control">
                <label for="user">Username or Email</label> <br>
                <input type="text" id="user" name="username"> <br>
                <span class="error"></span>
            </div>

            <div class="form-control">
                <label for="pass">Password</label> <br>
                <input type="password" id="pass" name="password"> <br>
                <span class="error"></span>
            </div>

            <div class="remember-wrapper">
                <input type="checkbox" id="remember" name="remember">
                <label for="remember">Remember Me</label>
            </div>
            

            <button type="submit" id="submit" name="submit" value="submit">Submit</button>
            <p>Don't have an account? <a href="../Register/register.php">Register Now</a></p>
            
        </form>
    </div>

    <script src="./login.js"></script>

    
</body>
</html>