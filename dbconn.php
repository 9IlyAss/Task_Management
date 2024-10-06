<?php
$servername = "localhost";
$username = "root";
$password = "";

$conn = new mysqli($servername, $username, $password);
if (!$conn) 
    die("Connection failed: " . $conn->connect_error);

$sql = "CREATE DATABASE IF NOT EXISTS task_Manager;";
$conn->query($sql);
$conn->select_db("task_Manager");

$sql = "CREATE TABLE IF NOT EXISTS USERS (
    id int AUTO_INCREMENT PRIMARY KEY,
    Nom varchar(30),
    Droit Enum('admin', 'user'),
    Etat Enum('active', 'desactive'),
    Email varchar(70) UNIQUE,
    Password varchar(70)
);";
$conn->query($sql);

// Missions table
$sql = "CREATE TABLE IF NOT EXISTS Missions (
    id int AUTO_INCREMENT PRIMARY KEY,
    Nom varchar(30),
    `Desc` varchar(255),
    User_id int,
    FOREIGN KEY (User_id) REFERENCES USERS(id)
);";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS tasks (
    id int AUTO_INCREMENT PRIMARY KEY,
    Nom varchar(30),
    `Desc` varchar(255),
    resultat varchar(255),
    Priorite Enum('En cours', 'Terminée', 'Imposible', 'Reporte'),
    User_id int,
    Mission_id int,
    FOREIGN KEY (User_id) REFERENCES USERS(id),
    FOREIGN KEY (Mission_id) REFERENCES Missions(id)
);";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS Shared_Mission (
    mission_id int,
    user_partage_id int,
    Droit Enum('admin', 'user'),
    FOREIGN KEY (mission_id) REFERENCES Missions(id),
    FOREIGN KEY (user_partage_id) REFERENCES USERS(id)
);";
$conn->query($sql);

$sql = "CREATE TABLE IF NOT EXISTS Operations (
    user_id int,
    operation varchar(255),
    Dateheur date,
    FOREIGN KEY (user_id) REFERENCES USERS(id)
);";
$conn->query($sql);


$result = $conn->query("SELECT COUNT(*) AS Count FROM USERS");
$row = $result->fetch_assoc();

if ($row['Count'] == 0) 
{
    $adminName = "Admin";
        $adminRole = "admin";
        $adminStatus = "active";
        $adminEmail = "Admin@gmail.com";
        $Password="Admin12";
    $sql="INSERT INTO USERS (Nom,Droit,Etat,Email,Password)
            VALUES (?,?,?,?,?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $adminName, $adminRole, $adminStatus, $adminEmail, $Password);
    $stmt->execute();
    $stmt->close();
}
?>
