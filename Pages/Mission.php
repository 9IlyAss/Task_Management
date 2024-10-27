<?php
$message = '';
$style = '';
$selectedMissionID = null; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["actionDelete"])) {
        $_SESSION["success"] = DeleteMission($_SESSION["ID"], $_POST["ID"]);
    }
    if (isset($_POST["actionShare"])) {   
        $_SESSION["success"] = ShareMission($_SESSION["ID"], $_POST["ID"], $_SESSION["Role"]);
        $style = "success"; 
    }

    if (isset($_POST["actionShowTasks"])) {
        $selectedMissionID = $_POST["ID"]; 
    }

    if (isset($_POST["actionHideTasks"])) {
        $selectedMissionID = null; 
    }

    if (isset($_POST['ID']) && isset($_POST['Nom']) && isset($_POST['Desc'])) {
        $missionID = $_POST['ID'];
        $name = $_POST['Nom'];
        $description = $_POST['Desc'];
        UpdateMission($_SESSION["ID"], $name, $description,$missionID); // Ensure this function is defined
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
        .task-container { display: <?php echo $selectedMissionID ? 'block' : 'none'; ?>; }
        #updateForm { display: none; margin-top: 20px; margin-bottom: 20px; }
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

    <!-- Collapsible div for tasks -->
    <div class="task-container mt-4">
        <h2>Tasks for Mission ID: <?php echo htmlspecialchars($selectedMissionID); ?></h2>
        <form method="post">
        <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="ID" value="<?php echo htmlspecialchars($selectedMissionID); ?>">
            <button type="submit" class="btn btn-danger" name="actionHideTasks">Close</button>
        </form>
        <div class="table-container">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"># Task ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Resultat</th>
                        <th scope="col">Priorite</th>
                    </tr>
                </thead>
                <tbody>
                    <?php DisplayTasks($selectedMissionID); ?>
                </tbody>
            </table>
        </div>
    </div>

    <div id="updateForm">
        <h3>Update Mission</h3>
        <form action="" method="POST">

            <input type="hidden" name="ID" value="">
            <div class="form-group mb-3">
                <label for="missionName" class="form-label">Mission Name</label>
                <input type="text" class="form-control" id="missionName" name="Nom" placeholder="Enter mission name" required>
            </div>
            <div class="form-group mb-3">
                <label for="missionDescription" class="form-label">Mission Description</label>
                <textarea class="form-control" id="missionDescription" name="Desc" placeholder="Enter mission description" rows="4" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Mission</button>
        </form>
    </div>
</div>

<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
<script>
        function showUpdateForm(id, name, description) {
            const updateForm = document.getElementById("updateForm");
            updateForm.style.display = "block"; 

            updateForm.querySelector("[name='ID']").value = id;
            updateForm.querySelector("[name='Nom']").value = name;
            updateForm.querySelector("[name='Desc']").value = description;
        }
    </script>
</body>
</html>
