<?php
    include('../includes/connect.php');
    include('../function/common_function.php');
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>user registration</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>

    <!-- bootstrap css link-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid my-3">
        <h2 class="text-center ">USER REGISTRATION</h2>
        <div class="row d-flex align-items-center justify-content-center">
            <div class="col-lg-12 col-xl-6">
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-outline mb-4">
                            <!-- user name field -->
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" id="user_username" class="form-control" placeholder="enter your username" 
                            autocomplete="off" required="required" name="user_username">
                        </div>
                        
                        <div class="form-outline mb-4">
                            <!-- email field -->
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" id="user_email" class="form-control" placeholder="enter your email" 
                            autocomplete="off" required="required" name="user_email">
                        </div>

                        <div class="form-outline mb-4">
                            <!-- Image field -->
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" id="user_image" class="form-control" 
                            required="required" name="user_image">
                        </div>

                        <div class="form-outline mb-4">
                            <!-- password field -->
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" id="user_password" class="form-control" placeholder="Set Password" 
                            autocomplete="off" required="required" name="user_password">
                        </div>

                        <div class="form-outline mb-4">
                            <!--confirm password field -->
                            <label for="conf_user_password" class="form-label">Confirm Password</label>
                            <input type="password" id="conf_user_password" class="form-control" placeholder="Re-Enter Password" 
                            autocomplete="off" required="required" name="conf_user_password">
                        </div>

                        <div class="form-outline mb-4">
                            <!--contact field -->
                            <label for="user_contact" class="form-label">Contact Number</label>
                            <input type="text" id="user_contact" class="form-control" placeholder="enter your mobile number" 
                            autocomplete="off" required="required" name="user_contact">
                        </div>

                        <div class="mt-4 pt-2">
                            <input type="submit" value="Register" class="bg-info py-2 px-3 border-0" name="user_register">
                            <p class="small fw-bold mt-2 pt-1 mb-0">Already have an account ? <a href="user_login.php" class="text-danger"> Login</a></p>
                        </div>

                    </form>
            </div>
        </div>
    </div>

</body>

</html>

<!-- php vode -->

<?php 
    if(isset($_POST['user_register']))
    {
        $user_username=$_POST['user_username'];
        $user_email=$_POST['user_email'];
        $user_password=$_POST['user_password'];

        // password hashing technique
        $hash_password=password_hash($user_password,PASSWORD_DEFAULT);
        $conf_user_password=$_POST['conf_user_password'];
        $user_contact=$_POST['user_contact'];
        // image 
        $user_image=$_FILES['user_image']['name'];
        $user_image_tmp=$_FILES['user_image']['tmp_name'];

        // user ip adress
        $user_ip=getIPAddress();

        // select query
        $select_query="Select * from `user_table` where username = '$user_username' or user_email='$user_email'";
        $result=mysqli_query($con,$select_query);
        $rows_count=mysqli_num_rows($result);
        if($rows_count>0)
        {
            echo "<script>alert('User name and email already exist') </script>";
        }
        else if( $user_password != $conf_user_password)
        {
            echo "<script>alert('passwords not matched')</script>";
        }
        else
        {
        // insert query
        move_uploaded_file($user_image_tmp,"./user_images/$user_image");
        $insert_query="insert into `user_table` (username,user_email,user_password,user_image,user_ip,user_mobile)
            values ('$user_username','$user_email','$hash_password','$user_image','$user_ip','$user_contact')";
        $sql_execute=mysqli_query($con,$insert_query);
        }
    
        // selecting cart item
        $select_cart_items="Select * from `cart_details` where ip_address='$user_ip'";
        $result_cart=mysqli_query($con,$select_cart_items);
        $rows_count=mysqli_num_rows($result_cart);
        if($rows_count>0)
        {
            $_SESSION['username']=$user_username;

            echo "<script>alert('You have items in your cart')</script>";
            echo "<script>window.open('checkout.php','_self')  </script>";
        }
        else
        {
            echo "<script>window.open('../index.php','_self')  </script>";
        }
    }


?>