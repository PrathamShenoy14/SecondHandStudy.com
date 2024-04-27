<?php 
require '../dbh.inc.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result); 
}
else{
    header("Location: ../Login/login.php");
    exit();
}
    if(isset($_POST["submit"])){
        $query = $_POST["query"];
        $problem = "INSERT INTO contact (problem,accounts_id) VALUES('$query','$id')";
        mysqli_query($conn,$problem);
        echo "<script>alert('Problem Sent');
        window.location.href = '../home.php';
        </script>";
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./contact.css">
</head>
<body>

    <header id="header">
        <div class="logo-wrapper">
            <a href="#" style="text-decoration:none;">
                <img src="../Images/icons8-backpack-32.png" alt="" style="cursor: pointer;">
                <strong style="font-size:x-large; color:black;">SecondHandStudy</strong> 
            </a>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="../home.php">Home</a></li>
                <li><div class="dropdown">
                    <a href="./logout.php">Catalog<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="../yourpdt.php">Your Products</a>
                    <a href="../Add/add.php">Add Products</a>
                    <a href="../delete/delete.php">Delete Products</a>
                    </div>
                  </div></li>
                <li><a href="../Account/account.php">Account</a></li>
                <li><a href="#header">Contact Us</a></li>
                <li><div class="dropdown">
                    <a href="../logout.php">Logout <span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="../Register/register.php">Register</a>
                    </div>
                  </div></li>
            </ul>
        </div>
    </header>



    <div class="container-wrapper">
        <div class="container">
            <form action="" id="form" method="post">
                <h1 class="dancing-script">Contact Us</h1>
            
    
                <div class="form-control">
                    <label for="query">Problem Description</label> <br>
                    <input type="text" id="query" name="query"> <br>
                    <span class="error"></span>
                </div>
                
    
                <button type="submit" id="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
    

    <script src="./Contact.js"></script>
</body>
</html>