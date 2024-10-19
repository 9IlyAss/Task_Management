<?php
function AllAccount()
{
    include '../dbconn.php';

    $sql = "SELECT u.id, u.Nom, u.Etat, u.Email, COUNT(m.id) AS mission_count
            FROM USERS u
            LEFT JOIN Missions m ON u.id = m.User_id
            WHERE Droit ='user'
            GROUP BY u.id;";
    $result = $conn->query($sql);

    // Display users and their mission counts
    if ($result->num_rows > 0) {
        while ($user = $result->fetch_assoc()) {
            $color = ($user['Etat'] == "active") ? "success" : "danger";
            echo "<tr>
                    <td>{$user['id']}</td>
                    <td>{$user['Nom']}</td>
                    <td class='bg-$color'>{$user['Etat']}</td>
                    <td>{$user['Email']}</td>
                    <td>{$user['mission_count']}</td>
                    <td>
                        <form action='' method='POST' style='display: inline;'>
                            <input type='hidden' name='user_id' value='{$user['id']}'>
                            <button type='submit' class='btn btn-success' name='activation' value='active'>Activate</button>
                            <button type='submit' class='btn btn-danger' name='activation' value='desactive'>Deactivate</button>
                        </form>
                    </td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='6' class='text-center'>No users found</td></tr>";
    }

    $conn->close();
}

function StatusAcc($userId, $Status)
{
    include("../dbconn.php");
    $sql = "UPDATE USERS SET Etat = ? WHERE id = ?";
    $sql = $conn->prepare($sql);
    $sql->bind_param("si", $Status, $userId);
    $sql->execute();
}
function NbrAccount($Status)
{
    include("../dbconn.php");
    $Role="user";
    $sql = "SELECT COUNT(*) as total FROM USERS WHERE  Etat= ? AND Droit =? ;";
    $sql = $conn->prepare($sql);
    $sql->bind_param("ss",$Status,$Role);
    $sql->execute();
    
    $sql = $sql->get_result();
    
    if ($row = $sql->fetch_assoc()) {
        echo $row['total']; // Output the total number of shared missions
    } else {
        echo "0"; // If no shared missions found
    }
}
?>