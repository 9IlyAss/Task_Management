<?php
$message = '';
$style = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {


    if (isset($_POST["actionDelete"])) {
        $_SESSION["success"] = DeleteMission($_SESSION["ID"], $_POST["ID"]);
    }
    if (isset($_POST["actionShare"])) {   
        $_SESSION["success"] = ShareMission($_SESSION["ID"],$_POST["ID"],$_SESSION["Role"]);
        $style = "success"; 
    }
    
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Missions Management</title>
    <style>
        h1 { margin-top: 20px; font-size: 2.5rem; color: #343a40; text-align: center; }
        .table { background-color: #ffffff; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); }
        .table th, .table td { vertical-align: middle; text-align: center; }
        .table-container { padding: 20px; width: 1100px; }
    </style>
</head>

<body>

<div class="col-md-10 main-content mt-4">
    <h1>Missions</h1>
    <div class="table-container">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col"># Mission ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Nbr Tasks</th>
                    <th scope="col" colspan="4">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php AllMission($_SESSION["ID"]); ?>
            </tbody>
        </table>
    </div>
</div>

<script src="../jquery/jquery-3.7.1.min.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
