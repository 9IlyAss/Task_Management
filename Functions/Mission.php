<?php

function AllMission($userID)
{
    include("../dbconn.php");

    $sql = "SELECT id,Nom,`Desc` FROM Missions WHERE User_id=? ORDER BY id DESC;";
    $sql = $conn->prepare($sql);
    $sql->bind_param("i", $userID);
    $sql->execute();
    $result = $sql->get_result();
    
    if ($result) {
        $Nbr = $conn->query("SELECT COUNT(*) AS Count FROM Missions");
        $Nbr = $Nbr->fetch_assoc();

        while ($row = $result->fetch_assoc()) {
            echo ' <tr>
                    <td>'. $row["Nom"].'</td>
                    <td>'. $row["Desc"].'</td>
                    <td>'. $Nbr["Count"] .'</td>
                    <form method="POST">
                        <input type="hidden" name="ID" value="'. $row["id"] . '">
                        <td><button type="submit" class="btn btn-success" name="actionTasks" value="Tasks">Tasks</button></td>
                        <td><button type="submit" class="btn btn-danger" name="actionDelete" value="delete">Delete</button></td>
                        <td><button type="submit" class="btn btn-warning" name="actionUpdate" data-bs-toggle="modal" data-bs-target="#staticBackdrop" value="update">Update</button></td>
                        <td><button type="submit" class="btn btn-primary" name="actionShare" value="Share">Share</button></td>

                    </form>
                </tr>
             ';
        }
    }
}

function AddMission($userID, $NomM, $DescM)
{
    include("../dbconn.php");

    $sql = "INSERT INTO Missions (Nom,`Desc`,User_id) VALUES (?, ?, ?);";
    $sql = $conn->prepare($sql);
    $sql->bind_param("ssi", $NomM, $DescM, $userID);
    $sql->execute();
    
    if ($sql) {
        return "Mission Created successfully";
    } 
}

function UpdateMission($userID, $NomM, $DescM, $Mid)
{
    include("../dbconn.php");

    $sql = "UPDATE Missions SET Nom=?, `Desc`=? WHERE User_id=? AND id=?";
    $sql = $conn->prepare($sql);
    $sql->bind_param("ssii", $NomM, $DescM, $userID, $Mid);
    $sql->execute();
    
    if ($sql) {
        return "Mission Updated successfully";
    }
}

function DeleteMission($userID, $Mid)
{
    include("../dbconn.php");

    $sql = "DELETE FROM Missions WHERE User_id=? AND id=?";
    $sql = $conn->prepare($sql);
    $sql->bind_param("ii", $userID, $Mid);
    $sql->execute();
    
    if ($sql) {
        return "Mission Deleted successfully";
    }
}
?>
