<?php
session_start();

function AllTasks($userID)
{
    include("../dbconn.php");

    $sql = "SELECT * FROM tasks WHERE User_id = ?;";
    $sql = $conn->prepare($sql);
    $sql->bind_param("i", $userID);
    $sql->execute();
    $result = $sql->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['Nom']}</td>
                    <td>{$row['Desc']}</td>
                    <td>{$row['resultat']}</td>
                    <td>{$row['Priorite']}</td>
                    <form method='POST'>
                        <input type='hidden' name='ID' value='{$row['id']}'>
                        <td><button type='submit' class='btn btn-warning' name='action' value='delete'>Delete</button></td>
                        <td><button type='submit' class='btn btn-warning' name='action' value='update'>Update</button></td>
                    </form>
                </tr>";
        }
    }
}

function AddTask($userID, $NomT, $DescT, $resultat, $Priorite,$MissionId)
{
    include("../dbconn.php");

    $sql = "INSERT INTO tasks (Nom, Desc, resultat, Priorite, User_id,Mission_id) VALUES (?, ?, ?, ?, ?);";
    $sql = $conn->prepare($sql);
    $sql->bind_param("sssii", $NomT, $DescT, $resultat, $Priorite, $userID,$MissionId);
    $sql->execute();

    if ($sql) {
        return "Task Created successfully";
    }
}

function UpdateTasks($userID, $TaskID, $NomT, $DescT, $resultat, $Priorite)
{
    include("../dbconn.php");

    $sql = "UPDATE tasks SET Nom = ?, `Desc` = ?, resultat = ?, Priorite = ? WHERE User_id = ? AND id = ?;";
    $sql = $conn->prepare($sql);
    $sql->bind_param("sssiii", $NomT, $DescT, $resultat, $Priorite, $userID, $TaskID);
    $sql->execute();

    if ($sql) {
        return "Task Updated successfully";
    }
}

function DeleteTasks($userID, $TaskID)
{
    include("../dbconn.php");

    $sql = "DELETE FROM tasks WHERE User_id = ? AND id = ?;";
    $sql = $conn->prepare($sql);
    $sql->bind_param("ii", $userID, $TaskID);
    $sql->execute();

    if ($sql) {
        return "Task Deleted successfully";
    }
}
?>
