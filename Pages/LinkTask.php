<?php
    include("../dbconn.php");


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    if (isset($_POST['associate_task'])) {
        $task_id = $_POST['task_id'];
        $mission_id = $_POST['mission_id'];

        Associate($mission_id, $task_id, $_SESSION["ID"]);

    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Associer une Tâche à une Mission</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }
        .content {
            margin-left: 240px;
            padding: 20px;
            margin-top: 80px;
        }
        .form-control {
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="content">
        <h4>Associer une tâche à une mission</h4>
        <form method="POST">

            <div class="form-group">
                <label for="task_id">Tâche :</label>
                <select class="form-control" id="task_id" name="task_id" required>
                    <option value="">Sélectionnez une tâche</option>
                    <?php  AllTaskRows($_SESSION["ID"]);?>
                </select>
            </div>
            <div class="form-group">
                <label for="mission_id">Mission :</label>
                <select class="form-control" id="mission_id" name="mission_id" required>
                    <option value="">Sélectionnez une mission</option>
                    <?php AllMissionRows($_SESSION["ID"]);?>
                </select>
            </div>
            <button type="submit" name="associate_task" class="btn btn-success">Associer la Tâche</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
