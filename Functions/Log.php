<?php
if (!function_exists('AddLog')) {
function AddLog($userID,$op) {
    include("../dbconn.php");

    $sql = "INSERT INTO Operations (user_id,operation) VALUES (?,?);";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $userID,$op);
    $stmt->execute();

}}

if (!function_exists('ViewLog')) {

function ViewLog() { 
    include("../dbconn.php");
    
    $sql = "SELECT * FROM Operations 
            ORDER BY Dateheur DESC;";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->get_result(); 
    if ($result && $result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<tr>
                    <td>' . $row["user_id"] . '</td>
                    <td>' . $row["operation"] . '</td>
                    <td>' . $row["Dateheur"] . '</td>
                </tr>';
        }
    } else {
        echo "<tr><td colspan='7'>No operations found.</td></tr>";
    }
}}


/*$sql = "CREATE TABLE IF NOT EXISTS Operations (
    user_id int,
    operation varchar(255),
    Dateheur date,
    FOREIGN KEY (user_id) REFERENCES USERS(id)
);"; */
?>