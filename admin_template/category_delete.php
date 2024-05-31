<?php
include "db_conn.php";
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM category_table WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: category_list.php?message=Category deleted successfully");
        exit();
    } else {
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: category_list.php");
    exit();
}

mysqli_close($conn);

?>
