<?php

function CreateToken():string
{
    return bin2hex(random_bytes(32));
}

function UpdateToken()
{
    include("../dbconn.php");
    $sql="UPDATE token  SET nbr=?;";
    $sql=$conn->prepare($sql);
    $sql->execute(["nbr"=> CreateToken()]);
}
function CheckTocken($token)
{
    include("../dbconn.php");
    $sql="SELECT * FROM token;";
    $sql=$conn->prepare($sql);
    $sql->execute();
    $result=$sql->get_result();
    if ($result->num_rows > 0) 
    {   $row = $result->fetch_assoc();
        if($row["nbr"]===$token)
          return true;
    }    
}

?>