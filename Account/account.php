<?php

require '../dbh.inc.php';

if(isset($_POST["submit"])){
    $pwd = $_POST["oldpassword"];
    $newpwd = $_POST["newpassword"];
    $id = $_SESSION["id"];

    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE id= '$id'");
    $row = mysqli_fetch_assoc($result);

    if(mysqli_num_rows($result)>0){
        if($pwd == $row["pwd"]){
            
            $result2 = mysqli_query($conn,"UPDATE accounts SET pwd='$newpwd' WHERE id= '$id'");
            echo "<script> alert('New Password set successfully'); </script>";
            header("Location: ../logout.php");
        }
        else{
            echo "<script> alert('Password Incorrect'); </script>";
            header("Location ./account.php");
            exit();
        }

    }
    else{
        echo "<script> alert('Database Connectivity issue try again!'); </script>";
        header("Location ./account.php");
        exit();
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
    <link rel="stylesheet" href="./account.css">
    
</head>
<body>

    <div class="container">

    
        <form action="" method ="post" id="form" autocomplete="off">
            <h1 class="dancing-script">Password Change</h1>
            
            <div class="form-control">
                <label for="oldpass">Old Password</label> <br>
                <input type="password" id="oldpass" name="oldpassword"> <br>
                <span class="error"></span>
            </div>

            <div class="form-control">
                <label for="newpass">New Password</label> <br>
                <input type="password" id="newpass" name="newpassword"> <br>
                <span class="error">Password needs to be atleast 8 characters</span>
            </div>
            
            <div class="form-control">
                <label for="cPass">Confirm Password</label> <br>
                <input type="password" id="cPass" name="cpass"> <br>
                <span class="error"></span>
            </div>

            <button type="submit" id="submit" name="submit" value="submit">Submit</button>
            

        </form>

       
    </div>

    <script src="./account.js"></script>
</body>
</html>