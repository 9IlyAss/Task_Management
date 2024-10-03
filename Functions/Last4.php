<?php
session_start();
include("../dbconn.php");


$sql="SELECT  (Nom,Desc)  FROM tasks  
        WHERE id=?
        ORDER BY id DESC LIMIT 4;";
$sql=$conn->prepare($sql);
$sql->bind_param("i",$_SESSION["ID"]);
$sql->execute();
$result = $sql->get_result();
if ($result) {
    while ($row = $result->fetch_assoc()) 
        {
            echo ' <div class="card task-card w-100 tasks mb-2">
                        <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h5 class="m-0">$row["Nom"]</h5>
                                    <p class="mb-0">$row["Desc"]</p>
                                </div>
                            <span class="task-status status-outstanding">OUTSTANDING</span>
                        </div>
                    </div> ';
        }
    }
            


?>