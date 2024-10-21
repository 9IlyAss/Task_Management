<?php
session_start();
include("../dbconn.php");
include("../Functions/Log.php");

$op = "logged out from the system.";
AddLog($_SESSION["ID"], $op);

session_unset();
session_destroy();

header("Location: ../Login/Login.php");
exit();

?>