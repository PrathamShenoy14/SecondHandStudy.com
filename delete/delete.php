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
        $name = $_POST["name"];
        $query = mysqli_query($conn,"SELECT * FROM products WHERE accounts_id='$id' AND name='$name'");
        
        if(mysqli_num_rows($query)>0){
            $product = "DELETE FROM products WHERE accounts_id='$id' AND name='$name'";
            mysqli_query($conn,$product);
            echo "<script>alert('Product Deleted');
                window.location.href = './delete.php';
                </script>";
        }
        else{
            echo "<script>alert('Product Not found');
            window.location.href = './delete.php';
            </script>";
        }
        
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="../home.css">
    <link rel="stylesheet" href="./Delete.css">
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
                    <a href="../catalog.php">Catalog<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="../yourpdt.php">Your Products</a>
                    <a href="../Add/add.php">Add Products</a>
                    <a href="../delete/delete.php">Delete Products</a>
                    <a href="#">Delete Products</a>
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
                <h1 class="dancing-script">Delete Product</h1>
            
    
                <div class="form-control">
                    <label for="name">Product name</label> <br>
                    <input type="text" id="name" name="name"> <br>
                    <span class="error"></span>
                </div>
                
    
                <button type="submit" id="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
    

    <script src="./delete.js"></script>
</body>
</html>