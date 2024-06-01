<?php
include 'db_conn.php';


if(isset($_POST["submit"])){
   
    $name = $_POST["name"];
    $order = $_POST["order"];
    $status = $_POST["status"];

    


    $sql = "UPDATE `category_table` SET `name`='$name',`order`='
    $order',`status`='$status' WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: category_list.php?message=Data updated successfully");
    }
    else{
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }
}
    
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
    
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:chocolate;">
        CATEGORY PAGE         
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
                <li><a class="dropdown-item" href="admin_delete.php">DELETE ADMIN</a></li>
                <li><a class="dropdown-item" href="category_list.php">CATEGORY LIST</a></li>
                <li><a class="dropdown-item" href="add_category.php">ADD CATEGORY</a></li>
                <li><a class="dropdown-item" href="category_edit.php">EDIT CATEGORY</a></li>
                <li><a class="dropdown-item" href="category_delete.php">DELETE CATEGORY</a></li>
                <li><a class="dropdown-item" href="product_list.php">PRODUCT LIST</a></li>
                <li><a class="dropdown-item" href="add_product.php">ADD PRODUCT</a></li>
                <li><a class="dropdown-item" href="product_edit.php">EDIT PRODUCT</a></li>
                <li><a class="dropdown-item" href="product_delete.php">DELETE PRODUCT</a></li>
                <li><a class="dropdown-item" href="order_list.php">ORDER LIST</a></li>
            </ul>
        </li>
    </ul>
</div>


    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Category Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        
        $sql = "SELECT * FROM category_table WHERE id";
        /* $id = $_GET["id"]; */
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="add_category.php" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" 
                    value="<?php echo $row["name"] ?>">
                </div>

                <div class="col">

                    <label for="order"  class="form-label">Order:</label>
                    <input type="text" class="form-control" name="order" 
                    value="<?php echo $row["order"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Status:</label>
                    <input type="text" class="form-control" name="status" 
                    value="<?php echo $row["status"] ?>">
                </div>


            </div>

                
            

               

              
              

                
                    
            
                    
                    

                    

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="category_list.php" class="btn btn-danger">Cancel</a>
                </div>
        </div>
    </div>




<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




</body>
</html>