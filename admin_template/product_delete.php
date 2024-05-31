<?php
include "db_conn.php";
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM product_table WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: product_list.php?message=Product deleted successfully");
        exit();
    } else {
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: product_list.php");
    exit();
}

mysqli_close($conn);

?>
