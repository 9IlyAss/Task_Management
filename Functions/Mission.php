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
                    <td>' . $row["Nom"] . '</td>
                    <td>' . $row["Desc"] . '</td>
                    <td>' . $result->num_rows . '</td>
                    <form action="" method="POST">
                        <input type="hidden" name="ID" value="' . $row["id"] . '">
                        <td><button type="submit" class="btn btn-success" name="actionTasks" value="Tasks">Tasks</button></td>
                        <td><button type="submit" class="btn btn-danger" name="actionDelete" value="delete">Delete</button></td>
                        <td>
                            <button type="button" class="btn btn-warning" onclick="window.location.href=\'../Pages/update.php?id=' . $row['id'] . '&Nom=' . urlencode($row['Nom']) . '&Des=' . urlencode($row['Desc']) . '\'">Update</button>
                        </td>
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

    return $result->fetch_assoc();
}

function AddMission($userID, $NomM, $DescM) {
    include("../dbconn.php");

    $sql = "INSERT INTO Missions (Nom, `Desc`, User_id) VALUES (?, ?, ?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $NomM, $DescM, $userID);
    if ($stmt->execute()) {
        return "Mission added successfully!";
    } else {
        return "Error adding mission: " . $stmt->error;
    }
}

function UpdateMission($userID, $NomMU, $DescMU, $missionID) {
    include("../dbconn.php");

    $sql = "UPDATE Missions SET Nom=?, `Desc`=? WHERE id=? AND User_id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $NomMU, $DescMU, $missionID, $userID);
    if ($stmt->execute()) {
        return "Mission updated successfully!";
    } else {
        return "Error updating mission: " . $stmt->error;
    }
}


function DeleteMission($userID, $missionID) {
    include("../dbconn.php");

    $sql = "DELETE FROM Missions WHERE id=? AND User_id=?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $missionID, $userID);
    if ($stmt->execute()) {
        return "Mission deleted successfully!";
    } else {
        return "Error deleting mission: " . $stmt->error;
    }
}
?>
