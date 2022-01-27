<?php
session_start();
session_destroy();
setcookie("Email","");
header('Location:first.php');
?>