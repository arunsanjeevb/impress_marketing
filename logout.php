<?php
session_start();
session_destroy();
//echo "in";exit;
header("Location: index.php");
?>