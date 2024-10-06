<?php

session_start();
include("../dbconn.php");

$sql = "SELECT  (Nom) FROM tasks 
        ORDER BY RAND() LIMIT 3";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) 
    {
        echo '<p class="text-white">$row["Nom"]</p> <br> ';
    }
}


?>