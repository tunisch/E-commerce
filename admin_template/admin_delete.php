<?php
include "db_conn.php";
session_start();

if (isset($_GET["id"])) {
    $id = $_GET["id"];
    $sql = "DELETE FROM admin_table WHERE id = $id";
    if (mysqli_query($conn, $sql)) {
        header("Location: admin_list.php?message=Admin deleted successfully");
        exit();
    } else {
        echo "Failed: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {
    header("Location: admin_list.php");
    exit();
}

mysqli_close($conn);

?>
