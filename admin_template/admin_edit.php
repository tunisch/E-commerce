<?php
include 'db_conn.php';


if(isset($_POST["submit"])){
    $first_name = $_POST["first-name"];
    $last_name = $_POST["last-name"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $gender = $_POST["gender"];

    $sql = "UPDATE `admin_table` SET `first_name`='$first_name',`last_name`='
    $last_name',`username`='$username',`password`='$password',`gender`='$gender' WHERE id = $id";
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("Location: admin_list.php?message=Data updated successfully");
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
    <title>ADMİN LOGIN</title>
</head>
<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:chocolate;">
        ADMIN LOGIN PAGE         
    </nav>

    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Admin Information</h3>
            <p class="text-muted">Click update after changing any information</p>
        </div>

        <?php
        
        $sql = "SELECT * FROM admin_table WHERE id";
        /* $id = $_GET["id"]; */
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <div class="container d-flex justify-content-center">
            <form action="add_admin.php" method="post" style="width:50vw; min-width:300px;">
            <div class="row mb-3">
                <div class="col">
                    <label class="form-label">First Name:</label>
                    <input type="text" class="form-control" name="first-name" 
                    value="<?php echo $row["first_name"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Last Name:</label>
                    <input type="text" class="form-control" name="last-name" 
                    value="<?php echo $row["last_name"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Username:</label>
                    <input type="username" class="form-control" name="username" 
                    value="<?php echo $row["username"] ?>">
                </div>

                <div class="col">
                    <label class="form-label">Password:</label>
                    <input type="password" class="form-control" name="password" 
                    value="<?php echo $row["password"] ?>>
                </div>

                <div class="form-group mb-3">
                    <label> Gender: </label> &nbsp;
                    <input type="radio" class="form-check-input" name="gender"
                    id="male" value="male" <?php echo ($row["gender"]=="male")?
                    "checked" :""; ?>>
                    
                    <label for="male" class="form-input-label" >Male</label>

                    <input type="radio" class="form-check-input" name="gender"
                    id="female" value="female" <?php echo ($row ["gender"]== "female")?
                    "checked":""; ?>>

                    <label for="female" class="form-input-label">Female</label>
            </div>

                <div>
                    <button type="submit" class="btn btn-success" name="submit">Update</button>
                    <a href="admin_list.php" class="btn btn-danger">Cancel</a>
                </div>
        </div>
    </div>




<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>




</body>
</html>