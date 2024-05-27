<?php
session_start();
// Destroy the session.
session_destroy();
// Redirect to login page with a status message

if(!empty($_GET['warning']) && $_GET['warning'] == 1) {
	header("Location: admin_login.php?warning=1");
} else {
	header("Location: admin_login.php");
}
exit();

?>