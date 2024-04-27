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
        $describe = $_POST["describe"];
        $category = $_POST["category"];
        $used = $_POST["used"];
        $file_name = $_FILES['image']['name'];
        $tempname = $_FILES['image']['tmp_name'];
        $unique_filename = uniqid() . '_' . time() . '_' . rand(1000, 9999) . '_' . $file_name;
        $folder = '../pdtImage/' . $unique_filename;

        $query = mysqli_query($conn,"INSERT INTO products (name,accounts_id,category,description,used,file) VALUES ('$name','$id','$category','$describe','$used','$unique_filename')");

        move_uploaded_file($tempname,$folder);

        echo "<script>alert('Product Added');
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
    <link rel="stylesheet" href="./add.css">
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
            <form action="" id="form" method="post" enctype="multipart/form-data">
                <h1 class="dancing-script">Add Product</h1>
                <div class="form-control">
                    <label for="name">Name</label> <br>
                    <input type="text" id="name" name="name"> <br>
                    <span class="error"></span>
                </div>
                <div class="form-control">
                    <label for="category">Category</label> <br>
                    <select name="category" id="category">
                        <option value="Lab Coat">Lab Coat</option>
                        <option value="Boiler Suit">Boiler Suit</option>
                        <option value="Books">Books</option>
                        <option value="Stationary">Stationary</option>
                    </select>
                </div>
                

                <div class="form-control">
                    <label for="describe">Product Description (as short as possible)</label> <br>
                    <input type="text" id="describe" name="describe"> <br>
                    <span class="error"></span>
                </div>

                <div class="form-control"> 
                    <label for="used">Useful for students in</label> <br>
                    <select name="used" id="used">
                        <option value="1">1st year</option>
                        <option value="2">2nd year</option>
                        <option value="3">3rd year</option>
                        <option value="4">4th year</option>
                    </select>
                </div>
                


                <div class="form-control">
                    <label for="image">Image of Product</label> <br>
                    <input type="file" id="image" name="image"> <br>
                    <span class="error"></span>
                </div>
                
                <button type="submit" id="submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
    

    <script src="./add.js"></script>
</body>
</html>