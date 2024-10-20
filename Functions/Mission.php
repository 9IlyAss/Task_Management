<?php
function AllMission($userID) {
    include("../dbconn.php");

    $sql = "SELECT id, Nom, `Desc` FROM Missions WHERE User_id=? ORDER BY id DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' .$row["id"] .'</td>
                    <td>' . $row["Nom"] . '</td>
                    <td>' . $row["Desc"] . '</td>
                    <td>' . $result->num_rows . '</td>
                    <form action="" method="POST">
                        <input type="hidden" name="ID" value="' . $row["id"] . '">
                        <td><button type="submit" class="btn btn-success" name="actionTasks" value="Tasks">Tasks</button></td>
                        <td><button type="submit" class="btn btn-danger"  name="actionDelete" value="delete">Delete</button></td>
                        <td><button type="button" class="btn btn-warning" name="actionUpdate" value="Update">Update</button></td>
                        <td><button type="submit" class="btn btn-primary" name="actionShare" value="Share">Share</button></td>
                    </form>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='7'>No missions found.</td></tr>";
    }
}


function GetMission($missionID) {
    include("../dbconn.php");
    $sql = "SELECT Nom, `Desc` FROM Missions WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $missionID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result && $result->num_rows > 0) 
        return $result->fetch_assoc();
    else 
        return 0;
}

function AddMission($userID, $NomM, $DescM) {
    include("../dbconn.php");

    
    $sql = "INSERT INTO Missions (Nom, `Desc`, User_id) VALUES (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $NomM, $DescM, $userID);

    $op="added a new mission.";
    AddLog($_SESSION["ID"],$op);

    if ($stmt->execute()) {
        return "Mission added successfully!";
    } else {
        return "Error adding mission: " . $stmt->error;
    }
}

function UpdateMission($userID, $NomMU, $DescMU, $missionID) {
    include("../dbconn.php");
    include("../Functions/Log.php");

    $sql = "UPDATE Missions SET Nom=?, `Desc`=? WHERE id=? AND User_id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $NomMU, $DescMU, $missionID, $userID);

    $op="updated a mission.";
    AddLog($_SESSION["ID"],$op);
    
    if ($stmt->execute()) {
        return "Mission updated successfully!";
    } else {
        return "Error updating mission: " . $stmt->error;
    }
}


function DeleteMission($userID, $missionID) {

    include("../dbconn.php");
    include("../Functions/Log.php");

    DeleteSharedMission($missionID);
    $sql = "DELETE FROM Missions WHERE id=? AND User_id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $missionID, $userID);

    $op="deleted a mission.";
    AddLog($_SESSION["ID"],$op);
    
    if ($stmt->execute()) {
        return "Mission deleted successfully!";
    } else {
        return "Error deleting mission: " . $stmt->error;
    }
}

function Last4Mission($userID)
{
    include("../dbconn.php");
    $sql = "SELECT id, Nom, `Desc` FROM Missions WHERE User_id=? ORDER BY id DESC  LIMIT 4;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row["Nom"] . '</td>
                    <td>' . $row["Desc"] . '</td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='7'>No missions found.</td></tr>";
    }
}

function NbrMission($userID) {
    include("../dbconn.php");

    $sql = "SELECT COUNT(*) as total FROM Missions WHERE User_id = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
        $result = $stmt->get_result();
    
    if ($row = $result->fetch_assoc()) {
        echo $row['total']; // Output the total number of missions
    } else {
        echo "0"; // If no missions found
    }
}

function AllMissionRows($userID) {
    include("../dbconn.php");
    
    $sql = "SELECT * FROM Missions WHERE User_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $missionsResult = $stmt->get_result();

    while ($mission = $missionsResult->fetch_assoc()) {
        echo '<option value="' . htmlspecialchars($mission['id']) . '">' . htmlspecialchars($mission['Nom']) . '</option>';
    }
}

function Associate($mission_id, $task_id, $user_id) {
    include("../dbconn.php");
    include("../Functions/Log.php");

    $sql = "UPDATE tasks SET mission_id = ? WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $mission_id, $task_id, $user_id);
    $stmt->execute();

    $op="associated mission with task";
    AddLog($_SESSION["ID"],$op);
    
    $stmt->close();
}
?>
