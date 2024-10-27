<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["AddTask"])) {
        $NomT = $_POST["NomT"];
        $DescT = $_POST["DescT"];
        $prio = $_POST["Priorite"];
        $res = $_POST["resultat"];
        $message = AddTask($_SESSION["ID"], $NomT, $DescT, $res, $prio);
        $style = 'success';
    }
    

    if (isset($_POST["actionDelete"])) {
        $_SESSION["success"] = DeleteTasks($_SESSION["ID"], $_POST["ID"]);
    }

    if (isset($_POST["actionShare"])) {
        $message = ShareTask($_SESSION["ID"], $_POST["ID"], $_SESSION["Role"]);
        $style = 'info';
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
        body {
            background-color: #f5f6fa;
            font-family: Arial, sans-serif;
        }

        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #343a40;
            text-align: center;
        }

        .form-container {
            max-width: 700px;
            margin: 30px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-container h2 {
            text-align: center;
            margin-bottom: 15px;
            font-size: 1.5rem;
            color: #343a40;
        }

        .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
        }

        .form-control {
            padding: 10px;
            font-size: 0.9rem;
            border-radius: 6px;
        }

        .btn-primary {
            background-color: #7b8dfb;
            border: none;
            border-radius: 6px;
            padding: 10px;
            font-size: 1rem;
            width: 100%;
        }

        .table-container {
            padding: 20px;
            max-width: 1100px;
            margin: 0 auto;
        }

        .table th, .table td {
            vertical-align: middle;
            text-align: center;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-edit, .btn-delete {
            padding: 6px 12px;
            font-size: 0.85rem;
        }

        .btn-edit {
            background-color: #28a745;
            color: white;
        }

        .btn-delete {
            background-color: #dc3545;
            color: white;
        }

        .btn-edit:hover, .btn-delete:hover {
            opacity: 0.9;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <h1>Tasks</h1>

    <div class="form-container">
        <h2>Add Task</h2>
        <form action="" method="post">
            <input type="hidden"  name="AddTask">

            <div class="row mb-3">
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Task Name" name="NomT" required>
                </div>
                <div class="col-md-6">
                    <input type="text" class="form-control" placeholder="Résultat" name="resultat" required>
                </div>
            </div>

            <!-- Task Description -->
            <div class="form-group mb-3">
                <textarea class="form-control" placeholder="Task Description" name="DescT" rows="3" required></textarea>
            </div>

            <div class="form-group mb-3">
                <label>Priorité:</label>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Priorite" value="En cours" id="enCours" required>
                            <label class="form-check-label" for="enCours">En cours</label>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Priorite" value="Terminée" id="terminee" required>
                            <label class="form-check-label" for="terminee">Terminée</label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Priorite" value="Imposible" id="imposible" required>
                            <label class="form-check-label" for="imposible">Imposible</label>
                        </div>
                    </div>
                    <div class="col-md-6 mt-2">
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="Priorite" value="Reporte" id="reporte" required>
                            <label class="form-check-label" for="reporte">Reporte</label>
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit"  class="btn btn-primary">Add Task</button>
        </form>
    </div>

    <div class="table-container">
        <table class="table table-hover table-bordered">
            <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $style; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <thead class="table-dark">
                <tr>
                    <th scope="col"># Task ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Résultat</th>
                    <th scope="col">Priorité</th>
                    <th scope="col" colspan="3">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php AllTasks($_SESSION["ID"]); ?>
            </tbody>
        </table>
    </div>

    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
