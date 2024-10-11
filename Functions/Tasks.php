
<?php

function AllTasks($userID)
{
    include("../dbconn.php");

    $sql = "SELECT * FROM tasks WHERE User_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['Nom']}</td>
                    <td>{$row['Desc']}</td>
                    <td>{$row['resultat']}</td>
                    <td>{$row['Priorite']}</td>
                    <form method='POST'>
                        <input type='hidden' name='ID' value='{$row['id']}'>
                        <td><button type='submit' class='btn btn-danger' name='actionDelete' value='delete'>Delete</button></td>
                        <td><button type='button' class='btn btn-warning' onclick=\"window.location.href='../Pages/update.php?id={$row['id']}&Nom=" . urlencode($row['Nom']) . "&Des=" . urlencode($row['Desc']) . "'\">Update</button></td>
                    </form>
                </tr>";
        }
    }
}

function AddTask($userID, $NomT, $DescT, $resultat, $Priorite, $MissionId)
{
    include("../dbconn.php");

    $sql = "INSERT INTO tasks (Nom, `Desc`, resultat, Priorite, User_id, Mission_id) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $NomT, $DescT, $resultat, $Priorite, $userID, $MissionId);
    if ($stmt->execute()) {
        return "Task Created successfully";
    }
}

function UpdateTasks($userID, $TaskID, $NomT, $DescT, $resultat, $Priorite)
{
    include("../dbconn.php");

    $sql = "UPDATE tasks SET Nom = ?, `Desc` = ?, resultat = ?, Priorite = ? WHERE User_id = ? AND id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssiii", $NomT, $DescT, $resultat, $Priorite, $userID, $TaskID);

    if ($stmt->execute()) {
        return "Task Updated successfully";
    }
}

function DeleteTasks($userID, $TaskID)
{
    include("../dbconn.php");

    $sql = "DELETE FROM tasks WHERE User_id = ? AND id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userID, $TaskID);

    if ($stmt->execute()) {
        return "Task Deleted successfully";
    } 
}
?>