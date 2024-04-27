<?php

require '../dbh.inc.php';
if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $pwd = $_POST["password"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];

    $duplicate = mysqli_query($conn, "SELECT * FROM accounts WHERE username = '$username' OR email = '$email' OR phone = '$phone'");

    if( mysqli_num_rows($duplicate) > 0){
        echo 
        "<script> alert('Username or E-mail or Phone No. has already been taken');</script>";
    }
    else{
        $query = "INSERT INTO accounts (username,pwd,email,phone) VALUES('$username','$pwd','$email','$phone')";
        mysqli_query($conn,$query);
        echo "<script> alert('Registration Successfull')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form validation</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Dancing+Script:wght@400..700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./form.css">
</head>
<body>

    
    <div class="container">

    
        <form action="" method ="post" id="form" autocomplete="off">
            <h1 class="dancing-script">Registration Form</h1>
            
            <div class="form-control">
                <label for="user">Username</label> <br>
                <input type="text" id="user"  name="username"> <br>
                <span class="error"></span>
            </div>

            <div class="form-control">
                <label for="email" >Somaiya Email</label> <br>
                <input type="text" id="email" name="email"> <br>
                <span class="error"></span>
            </div>

            <div class="form-control">
                <label for="phone" >Phone No:</label> <br>
                <input type="text" id="phone" name="phone" placeholder="123-456-7890"> <br>
                <span class="error"></span>
            </div>

            <div class="form-control">
                <label for="pass">Password</label> <br>
                <input type="password" id="pass" name="password"> <br>
                <span class="error">Password needs to be atleast 8 characters</span>
            </div>
            
            <div class="form-control">
                <label for="cPass">Confirm Password</label> <br>
                <input type="password" id="cPass" name="cpass"> <br>
                <span class="error"></span>
            </div>

            <button type="submit" id="submit" name="submit" value="submit">Submit</button>
            <p>Already a member? <a href="../Login/login.php">Login Now</a></p>
            

        </form>

       
    </div>

    <script src="./form.js"></script>
</body>
</html>