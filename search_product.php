<!-- connect file-->
<?php
  include('includes/connect.php');
  include('function/common_function.php');
  session_start();
?>

<html>

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <title>canteen automation system</title>
  <!-- bootstrap css link-->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <!--font awesome link-->
  <!--cdn-content delivery network-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"
    integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <!-- css link-->
  <link rel="stylesheet" href="style.css">

</head>

<body>

  <!--nav bar-->
  <!--p-0 padding-->
  <div class="container-fluid p-0">
    <!--first child-->
    <!-- bg-info clr-->
    <nav class="navbar navbar-expand-lg navbar-light bg-info">
      <div class="container-fluid">
        <!--<img src="./images/logo.jpg" alt="logo">-->
        <a class="navbar-brand" href="#"><i class="fa-solid fa-bowl-food"></i></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="display_all.php">Products</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./users_area/user_registration.php">Register</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Contact</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="cart.php"><i class="fa-solid fa-cart-shopping"></i><sup><?php cart_item();
              ?></sup></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Total price:<?php total_cart_price();?>/-</a>
            </li>
          </ul>
          <form class="d-flex" action="" method="get">
            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
            <input type="submit" value="Search" class="btn btn-outline-light" name="search_data_product">
          </form>
        </div>
      </div>
    </nav>

    <!--calling cart function-->
    <?php
        cart();
    ?>

    <!-- second child-->
    <nav class="nav navbar navbar-expand-lg navbar-dark bg-secondary">
      <ul class="navbar-nav me-auto">
        
        <?php
        if(!isset($_SESSION['username']))
        {
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome guest</a>
          </li>";
        }
        else
        {
            echo "<li class='nav-item'>
            <a class='nav-link' href='#'>Welcome ".$_SESSION['username']." </a>
        </li>";
        }
                    if(!isset($_SESSION['username']))
                    {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/user_login.php'>Login</a>
                    </li>";
                    }
                    else
                    {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='./users_area/logout.php'>Logout</a>
                    </li>";
                    }
                ?>
      </ul>
    </nav>
    <!--third child-->
    <div class="bg-light">
      <h3 class="text-center">A to Z store</h3>
      <p class="text-center">
        Tasty and Healthy food
      </p>
    </div>

    <!--fourth child-->
    <div class="row px-1">
      <div class="col-md-10">
        <!--products-->
        <div class="row">
          <!--fetching products-->
          <?php
          //calling function
          search_product();
          get_unique_categories();
          ?>


        <!--row end-->
        </div>
        <!--col end-->
      </div>
      <!--sidenav-->
      <div class="col-md-2 bg-secondary p-0 ">
        <!-- categories to be displayes-->
        <ul class="navbar-nav me-auto text-center">
          <li class="nav-item bg-info">
            <a href="#" class="nav-link text-light">
              <h4>Categories</h4>
            </a>
          </li>
          
          <?php
            getcategories();
          ?>
        </ul>

      </div>
    </div>


    <!-- last child-->
    <div class="bg-info p-3 text-center">
      <p>Canteen automation system</p>
    </div>
  </div>


  <!--bootstrap js link-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
</body>
</html>