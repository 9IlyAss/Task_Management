<?php
include("../Functions/Tasks.php");

$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["NomT"])) {
        $NomT = $_POST["NomT"];
        $DescT = $_POST["DescT"];
        $Mission_id = $_POST["Mission_id"];
        $prio = $_POST["Priorite"];
        $res = $_POST["resultat"];
    }

    if (isset($_POST["add"])) {
        $message = AddTask($_SESSION["ID"], $NomT, $DescT, $res, $prio, $Mission_id);
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
    <title>Task Management</title>

    <style>
        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #343a40;
            text-align: center;
        }

        .table {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
            border-radius: 20px;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
            border-radius: 20px;
        }

        .btn-edit:hover,
        .btn-delete:hover {
            opacity: 0.9;
        }

        .table-container {
            padding: 20px;
            width: 1100px;
        }
    </style>
</head>

<body>
    <div class="col-md-10 col-lg-8">
        <h1>Tasks</h1>
        <button type="button" class="btn btn-warning btn-lg mt-2" data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">Create Task</button>

        <div class="table-container">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"># Task Number</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Description</th>
                        <th scope="col">Résultat</th>
                        <th scope="col">Priorité</th>
                        <th scope="col" colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    AllTasks($_SESSION["ID"]);
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Modal for adding task -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Task</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <form action="" method="post">
                            <input type="hidden" name="add" value="click">
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Mission associée" name="Mission_id"
                                    required>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Task Name" name="NomT" required>
                            </div>
                            <div class="form-group mb-3">
                                <textarea class="form-control" placeholder="Task Description" name="DescT" rows="4"
                                    required></textarea>
                            </div>
                            <div class="form-group mb-3">
                                <input type="text" class="form-control" placeholder="Résultat" name="resultat" required>
                            </div>
                            <div class="form-group mb-3">
                                <label>Priorité:</label><br>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Priorite" value="En cours"
                                        id="enCours" required>
                                    <label class="form-check-label" for="enCours">
                                        En cours
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Priorite" value="Terminée"
                                        id="terminee" required>
                                    <label class="form-check-label" for="terminee">
                                        Terminée
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Priorite" value="Imposible"
                                        id="imposible" required>
                                    <label class="form-check-label" for="imposible">
                                        Imposible
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="Priorite" value="Reporte"
                                        id="reporte" required>
                                    <label class="form-check-label" for="reporte">
                                        Reporte
                                    </label>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>