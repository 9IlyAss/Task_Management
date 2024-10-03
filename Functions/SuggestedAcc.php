<?php
session_start();
include("../dbconn.php");

$result = $conn->query("SELECT COUNT(*) AS Count FROM USERS");
random_int(1,$result);



$sql="SELECT  (Nom)  FROM tasks  
        WHERE id=?
        ORDER BY id DESC LIMIT 3;";
$sql=$conn->prepare($sql);
$sql->bind_param("i",$_SESSION["ID"]);
$sql->execute();
$result = $sql->get_result();
if ($result) {
    while ($row = $result->fetch_assoc()) 
        {
            echo ' <p class="text-white">$row["Nom"]</p> ';
        }
    }
            


?>