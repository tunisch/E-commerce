<?php
session_start();
include 'db_conn.php';

if(isset($_POST["submit"])){
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    $sql = "INSERT INTO `admin_table` (`id`, `first_name`, `last_name`, `username`, `password`, `gender`) 
    VALUES (NULL, '$first_name', '$last_name', '$username', '$password', '$gender')";
    
    // if empty fields are submitted 
    if(empty($first_name) || empty($last_name) || empty($username) || empty($password) || empty($gender)){
        header("Location: add_admin.php?message=Please fill in all fields");
        exit();
    }
    //if changes are made to the database old data will be deleted and new data will be added 
    if(mysqli_query($conn, $sql)){
        header("Location: admin_list.php?message=Admin added successfully");
        exit();
    }
    else{
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }
}
   
    mysqli_close($conn);

    ?>
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">    
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <title>ADMİN LOGIN</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:chocolate;">
        ADMIN LOGIN PAGE         
    </nav>
    <div class="container">
    <ul class="nav justify-content-left">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: chocolate;">
                ADMIN MANAGEMENT
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="admin_panel.php">ADMIN PANEL</a></li>
                <li><a class="dropdown-item" href="admin_list.php">ADMIN LIST</a></li>
                <li><a class="dropdown-item" href="add_admin.php">ADD ADMIN</a></li>
                <li><a class="dropdown-item" href="admin_edit.php">EDIT ADMIN</a></li>
                <li><a class="dropdown-item" href="category_list.php">CATEGORY LIST</a></li>
                <li><a class="dropdown-item" href="add_category.php">ADD CATEGORY</a></li>
                <li><a class="dropdown-item" href="category_edit.php">EDIT CATEGORY</a></li>
                <li><a class="dropdown-item" href="product_list.php">PRODUCT LIST</a></li>
                <li><a class="dropdown-item" href="add_product.php">ADD PRODUCT</a></li>
                <li><a class="dropdown-item" href="product_edit.php">EDIT PRODUCT</a></li>
                <li><a class="dropdown-item" href="order_list.php">ORDER LIST</a></li>
            </ul>
        </li>
    </ul>
</div>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New Admin</h3>
            <?php
                if(isset($_GET["message"])){ //if message is set
                  $message = $_GET["message"];
                  echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                  '.$message.'
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>';
                }
            ?>
            <p class="text-muted">Complete the form below to add a new admin</p>
        </div>

        <div class="container d-flex justify-content-center">
            <form action="add_admin.php" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" class="form-control" name="first-name" placeholder="Name">
                </div>

                <div class="col">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="form-control" name="last-name" placeholder="Surname">
                </div>

                <div class="col">
                    <label class="form-label">Username:</label>
                    <input type="username" class="form-control" name="username" placeholder="Nickname">
                </div>

                <div class="col">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>

                <div class="form-group mb-3">
                    <label> Gender: </label>
                    <input type="radio" class="form-check-input" name="gender"
                    id="male" value="male">
                    <label for="male" class="form-input-label" >Male</label>

                    <input type="radio" class="form-check-input" name="gender"
                    id="female" value="female">
                    <label for="female" class="form-input-label">Female</label>
            </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Save</button>
                    <a href="admin_list.php" class="btn btn-danger">Cancel</a>
                </div>
        </div>
    </div>




<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




</body>
</html>