<?php 
require 'dbh.inc.php';

if(!empty($_SESSION["id"])){
    $id = $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM accounts WHERE id = '$id'");
    $row = mysqli_fetch_assoc($result); 
}
else{
    header("Location: ./Login/login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Website</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./home.css">
 
</head>
<body>
    <a href="#header"><button class="top-taker">▲</button></a>
    <header id="header">
        <div class="logo-wrapper">
            <a href="#" style="text-decoration:none;">
                <img src="./Images/icons8-backpack-32.png" alt="" style="cursor: pointer;">
                <strong style="font-size:x-large; color:black;">SecondHandStudy</strong> 
            </a>
        </div>
        <div class="nav-links">
            <ul>
                <li><a href="#header">Home</a></li>
                <li><div class="dropdown">
                    <a href="./catalog.php">Catalog<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="./yourpdt.php">Your Products</a>
                    <a href="./Add/add.php">Add Products</a>
                    <a href="./delete/delete.php">Delete Products</a>
                    </div>
                  </div></li>
                <li><a href="./Account/account.php">Account</a></li>
                <li><a href="./Contact/contact.php">Contact Us</a></li>
                <li><div class="dropdown">
                    <a href="./logout.php">Logout<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="./Register/register.php">Register</a>
                    </div>
                  </div></li>
            </ul>
        </div>
        <div class="search-wrapper">
            <form action="./catalog.php" method="post">
                <input type="text" placeholder="Search..." name="search_product">
                <img src="./Images/icons8-search-32.png" alt="">
                <button type="submit" name="search" id="submit_search">Submit</button>
            </form>
            
        </div>
    </header>
    <section class="intro">
        <div class="row">
            <div class="left col-6">
                <h1>Buy and Sell Second-Hand College Essentials with Ease!</h1>
                <p style="margin-bottom: 15px;">Find everything you need for college life on <span style="font-weight:bolder;">'SecondHandStudy.com'</span>. Buy or sell second-hand textbooks, dorm decor, and more. Join our community and start saving today!</p>
                <a href="./catalog.php"><button class="shop-now">Check Products ></button></a>
                <h3>😄 Fulfilled Students</h3>
                <p>
                    
                    "<span style="font-weight: bold;">SecondHandStudy.com</span> has been a student's dream come true! Finding affordable textbooks and selling my own items has made college life much easier. With its user-friendly interface and vast selection, it's my go-to for budget-friendly essentials. Thanks to them, I've saved money without sacrificing quality."</p>
            </div> 
            <div class="right col-6">
                <img src="https://www.somaiya.edu/upload_file/images20/images/sahas.jpg" alt="">
            </div>
        </div>
        
    </section>
    <hr>

    <section class="new-products">
        <h1>New Products</h1>
        <p>Explore our latest offerings!</p>
        <div class="product-card-wrapper">

        <?php

            $query = mysqli_query($conn,"SELECT * FROM products ORDER BY created_at DESC LIMIT 4;");
            $row = mysqli_fetch_assoc($query);
            
            foreach ($query as $product) :
                $accounts_id = $product['accounts_id'];
                $query2 = mysqli_query($conn,"SELECT * FROM accounts WHERE id='$accounts_id';");
                $row2 = mysqli_fetch_assoc($query2);
                ?> 
                <form action="./phpmailer/send.php" method="post">
                <div class="product-card">
                <div class="product-img-wrapper" style="border-bottom: 1px solid black;"> 
                <img src="./pdtImage/<?= $product['file'];?>">
                </div><br>
                <div class="product-description-wrapper">
                    <h1 class="pdtname" style="border-bottom: 1px solid black;"><?= $product['name'];?></h1><br>
                    <div class="product-price">
                        <!-- <span class="new-price">$<?= $product['price'];?></span>
                        <span class="old-price">$<?= $product['old_price'];?></span> -->
                        <span class="describe">Description:<span style="font-weight: lighter; font-size:1.1rem"><?=$product['description']?></span></span>
                        <!-- <span class="review"><?= $product['rating'];?><img src="./Images/star.png" alt=""></span> -->
                        <!-- <span class="product-left">(<?= $product['quantity'];?>)</span> -->
                        <br><span class="text">Email: <span style="font-weight: lighter;"><?=$row2['email']?></span> </span> 
                        <span class="text">Phone No:  <span style="font-weight: lighter;"> <?=$row2['phone']?></span></span> 
                        <span class="text">Product added at:  <span style="font-weight: lighter;">  <?=$product['created_at']?></span></span>
                        <button type="submit" name="notify" id="notify">Notify</button>
                        <input type="hidden" name="email" value="<?=$row2['email']?>">
                        <input type="hidden" name="pdtname" value="<?= $product['name'];?>">
                    </div>
                </div>
            </div>
                </form>
                
                <?php
            endforeach;
    ?>

        </div>
        
    </section>
    <hr>
    
    
    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="#header" class=" px-2">Home</a></li>
          <li class="nav-item"><div class="dropdown ">
                    <a href="./catalog.php">Catalog<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                        <a href="./yourpdt.php">Your Products</a>
                        <a href="./Add/add.php">Add Products</a>
                        <a href="./delete/delete.php">Delete Products</a>
                    </div>
                  </div></li>
          <li class="nav-item"><a href="./Account/account.php" class=" px-2">Account</a></li>
          <li class="nav-item"><a href="./Contact/contact.php" class=" px-2">Contact Us</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
      </footer>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> -->
    <script src="./home.js"></script>
</body>
</html>

