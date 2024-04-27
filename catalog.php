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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./home.css">
    <link rel="stylesheet" href="./catalog.css">
    <title>Catalogue</title>
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
                <li><a href="./home.php">Home</a></li>
                <li><div class="dropdown">
                    <a href="./catalog.php">Catalog<span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="./yourpdt.php">Your Products</a>
                    <a href="./Add/add.php">Add Products</a>
                    <a href="./delete/delete.php">Delete Products</a>
                    </div>
                  </div></li>
                <li><a href="./cart.php">Cart</a></li>
                <li><a href="./Contact/contact.php">Contact Us</a></li>
                <li><div class="dropdown">
                    <a href="./logout.php">Logout <span style="font-size: smaller;">▼</span></a>
                    <div class="dropdown-content">
                    <a href="./Register/register.php">Register</a>
                    </div>
                  </div></li>
            </ul>
        </div>
        <div class="search-wrapper">
            <form action="catalog.php" method="post">
                <input type="text" placeholder="Search..." name="search_product">
                <img src="./Images/icons8-search-32.png" alt="">
                <button type="submit" name="search" id="submit_search">Submit</button>
            </form>
        </div>
    </header>

    <section class="new-products">
        <h1>Our Products</h1>
        <p style="text-align:center; padding: 0px 40px;">"Unlock access to a vast array of college products, available at your fingertips."</p>
        <label for="filter" style="padding: 0px 40px; font-weight: bold; font-size: 1.25rem;">Filter:</label> <br>
            <form action="" method="post">
                <select name="filter" id="filter">
                    <option value="None">None</option>
                    <option value="Lab Coat">Lab Coat</option>
                    <option value="Boiler Suit">Boiler Suit</option>
                    <option value="Books">Books</option>
                    <option value="Stationary">Stationary</option>
                    <option value="Ascend">A-Z</option>
                    <option value="Descend">Z-A</option>
                    <option value="1">1st Year</option>
                    <option value="2">2nd Year</option>
                    <option value="3">3rd Year</option>
                    <option value="4">4th Year</option>
                </select>

                <button type="submit" name="submit" id="submit_filter">Filter</button>
            </form>

        <div class="product-card-wrapper">

            <?php

                if(isset($_POST["search"])){
                    $search = $_POST["search_product"];
                    $query = mysqli_query($conn,"SELECT * FROM products WHERE name = '$search'");
                    $row = mysqli_fetch_assoc($query);

                    if(mysqli_num_rows($query)>0){
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
                    }
                    else{
                        echo "<h1>Product not Found</h1>";
                    }
                }
                        
                        

                else if(isset($_POST["submit"])){
                    $filter = $_POST["filter"];

                    if($filter == "None"){
                        $query = mysqli_query($conn,"SELECT * FROM products");
                        $row = mysqli_fetch_assoc($query);
                    
                    }
                    else if($filter == "Lab Coat"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE category='Lab Coat'");
                        $row = mysqli_fetch_assoc($query);
                    }

                    else if($filter == "Boiler Suit"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE category='Boiler Suit'");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "Books"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE category='Books'");
                        $row = mysqli_fetch_assoc($query);
                    }

                    else if($filter == "Stationary"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE category='Stationary'");
                        $row = mysqli_fetch_assoc($query);
                    }

                    else if($filter == "Ascend"){
                        $query = mysqli_query($conn,"SELECT * FROM products ORDER BY name ASC");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "Descend"){
                        $query = mysqli_query($conn,"SELECT * FROM products ORDER BY name DESC");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "1"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE used = 1");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "2"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE used = 2");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "3"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE used = 3");
                        $row = mysqli_fetch_assoc($query);
                    }
                    else if($filter == "4"){
                        $query = mysqli_query($conn,"SELECT * FROM products WHERE used = 4");
                        $row = mysqli_fetch_assoc($query);
                    }


                    if(mysqli_num_rows($query)>0){
                        foreach ($query as $product):
                            $accounts_id = $product['accounts_id'];
                            $query2 = mysqli_query($conn,"SELECT * FROM accounts WHERE id='$accounts_id';");
                            $row2 = mysqli_fetch_assoc($query2);
                            ?> 
                            <form action="./manage_cart.php" method="post">
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
                    }
                    else{
                        echo"<h2 style:text-align:center;>No Products</h2>";
                    }
                    
                    }
                else{
            $query = mysqli_query($conn,"SELECT * FROM products");
            $row = mysqli_fetch_assoc($query);
            
            foreach ($query as $product) :
                $accounts_id = $product['accounts_id'];
                $query2 = mysqli_query($conn,"SELECT * FROM accounts WHERE id='$accounts_id';");
                $row2 = mysqli_fetch_assoc($query2);
                ?> 
                <form action="./manage_cart.php" method="post">
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
            endforeach;}
    ?>
    </section>

    <footer class="py-3 my-4">
        <ul class="nav justify-content-center border-bottom pb-3 mb-3">
          <li class="nav-item"><a href="./home.php" class=" px-2">Home</a></li>
          <li class="nav-item"><a href="#header" class=" px-2">Catalogue</a></li>
          <li class="nav-item"><a href="./cart.php" class=" px-2">Cart</a></li>
          <li class="nav-item"><a href="./Contact/contact.php" class=" px-2">Contact Us</a></li>
        </ul>
        <p class="text-center text-body-secondary">© 2024 Company, Inc</p>
      </footer>
     
     <script src="./Catalog.js"></script> 
</body>
</html>