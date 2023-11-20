<?php
session_start();
session_unset();
header("Location: /page_login.php");
exit;
?>