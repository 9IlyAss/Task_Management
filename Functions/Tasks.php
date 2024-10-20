
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
                        <td><button type='button' class='btn btn-warning' name='actionUpdate' value='update'>Update</button></td>
                        <td><button type=\"submit\" class=\"btn btn-primary\" name=\"actionShare\" value=\"Share\">Share</button></td>
                    </form>
                </tr>";
        }
    }
}

function AddTask($userID, $NomT, $DescT, $resultat, $Priorite)
{
    include("../Functions/Log.php");
    include("../dbconn.php");
    
    $MissionID=null;
    $sql = "INSERT INTO tasks (Nom, `Desc`, resultat, Priorite, User_id, Mission_id) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssis", $NomT, $DescT, $resultat, $Priorite, $userID,$MissionID);

    $op="added a new Task.";
    AddLog($_SESSION["ID"],$op);
    
    if ($stmt->execute()) {
        return "Task Created successfully";
    }
}

function UpdateTasks($userID, $TaskID, $NomT, $DescT, $resultat, $Priorite)
{
    include("../dbconn.php");

    $sql = "UPDATE tasks SET Nom = ?, `Desc` = ?, resultat = ?, Priorite = ? WHERE User_id = ? AND id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssii", $NomT, $DescT, $resultat, $Priorite, $userID, $TaskID);

    $op="update a Task.";
    AddLog($_SESSION["ID"],$op);
    
    if ($stmt->execute()) {
        return "Task Updated successfully";
    }
}

function DeleteTasks($userID, $TaskID)
{
    include("../dbconn.php");
    include("../Functions/Log.php");

    $sql = "DELETE FROM tasks WHERE User_id = ? AND id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $userID, $TaskID);

    $op="Delete a  Task.";
    AddLog($_SESSION["ID"],$op);
    
    if ($stmt->execute()) {
        return "Task Deleted successfully";
    } 
}
function AllTaskRows($userID) {
    include("../dbconn.php");

    $sql = "SELECT * FROM tasks WHERE User_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID); // Fixed variable name to $userID
    $stmt->execute();
    $tasksResult = $stmt->get_result(); // Correct variable name

    while ($tasks = $tasksResult->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($tasks['id']) . '">' . htmlspecialchars($tasks['Nom']) . '</option>';
    }
}
?>