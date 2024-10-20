<?php
function AllSharedMission() {
    include("../dbconn.php");
    $sql="SELECT * FROM Shared_Mission
          ORDER BY mission_id DESC;";
    $sql=$conn->prepare($sql);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //user name email
            $UserID="SELECT Nom,Email FROM USERS
                    WHERE id=?;";
            $UserID=$conn->prepare($UserID);
            $UserID->bind_param("i",$row["user_partage_id"]);
            $UserID->execute();
            $UserID = $UserID->get_result();
            $UserID = $UserID->fetch_assoc();

            //mission name description

            $MissionID="SELECT Nom,`Desc` FROM Missions
                    WHERE id=?;";
            $MissionID=$conn->prepare($MissionID);
            $MissionID->bind_param("i",$row["mission_id"]);
            $MissionID->execute();
            $MissionID = $MissionID->get_result();
            $MissionID = $MissionID->fetch_assoc();

            echo '<tr>
                    <td>' .$UserID["Nom"] .'</td>
                    <td>' . $UserID["Email"] . '</td>
                    <td>' . $MissionID["Nom"] . '</td>
                    <td>' . $MissionID["Desc"] . '</td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='7'>No missions Shared.</td></tr>";
    }

}
function ShareMission($userID, $missionID,$Role) {
    include("../dbconn.php");

    $sql = "INSERT INTO Shared_Mission 
            VALUES (?,?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iis",$missionID,$userID,$Role);
    if ($stmt->execute()) {
        return "Mission Shared successfully!";
    } else {
        return "Error Sharing mission: " . $stmt->error;
    }
}
function DeleteSharedMission($missionID) {
    include("../dbconn.php");

    $sql = "DELETE FROM Shared_Mission WHERE mission_id=? ;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $missionID);
    if ($stmt->execute()) {
        return "Mission deleted successfully!";
    } else {
        return "Error deleting mission: " . $stmt->error;
    }
}


function Last4Shared($userID)
{
    include("../dbconn.php");
    $sql="SELECT * FROM Shared_Mission
          ORDER BY mission_id DESC LIMIT 4;";
    $sql=$conn->prepare($sql);
    $sql->execute();
    $result = $sql->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            //user name email
            $UserID="SELECT Nom,Email FROM USERS
                    WHERE id=?;";
            $UserID=$conn->prepare($UserID);
            $UserID->bind_param("i",$row["user_partage_id"]);
            $UserID->execute();
            $UserID = $UserID->get_result();
            $UserID = $UserID->fetch_assoc();

            //mission name description

            $MissionID="SELECT Nom,`Desc` FROM Missions
                    WHERE id=?;";
            $MissionID=$conn->prepare($MissionID);
            $MissionID->bind_param("i",$row["mission_id"]);
            $MissionID->execute();
            $MissionID = $MissionID->get_result();
            $MissionID = $MissionID->fetch_assoc();

            echo '<tr>
                    <td>' .$UserID["Nom"] .'</td>
                    <td>' . $MissionID["Nom"] . '</td>
                    <td>' . $MissionID["Desc"] . '</td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='7'>No missions Shared.</td></tr>";
    }
}

function NbrSharedMission($userID) {
    include("../dbconn.php");

    // Use a prepared statement to count shared missions from the SharedMissions table
    $sql = "SELECT COUNT(*) as total FROM Shared_Mission WHERE  user_partage_id= ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    
    // Fetch the result
    $result = $stmt->get_result();
    
    // Get the total count from the result
    if ($row = $result->fetch_assoc()) {
        echo $row['total']; // Output the total number of shared missions
    } else {
        echo "0"; // If no shared missions found
    }
}
function AllSharedTasks() {
    include("../dbconn.php");
    $sql = "SELECT ut.Nom AS user_name, ut.Email AS user_email, t.Nom AS task_name, t.`Desc` AS task_desc 
            FROM Shared_Task st
            JOIN USERS ut ON st.user_partage_id = ut.id
            JOIN tasks t ON st.Task_id = t.id
            ORDER BY st.Task_id DESC;";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . htmlspecialchars($row["user_name"]) . '</td>
                    <td>' . htmlspecialchars($row["user_email"]) . '</td>
                    <td>' . htmlspecialchars($row["task_name"]) . '</td>
                    <td>' . htmlspecialchars($row["task_desc"]) . '</td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='4'>No tasks shared.</td></tr>"; // Adjusted colspan to match the number of columns
    }
}

?>