<?php
include("../Functions/Mission.php");

$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["Nom"])) {
        $NomM = $_POST["Nom"];
        $DescM = $_POST["Desc"];
    }
    if (isset($_POST["NomU"])) {
        $NomMU = $_POST["NomU"];
        $DescMU = $_POST["DescU"];
    }

    if (isset($_POST["add"])) {   
        $_SESSION["success"] = AddMission($_SESSION["ID"], $NomM, $DescM);
        $style = "success"; 
    }

    if (isset($_POST["actionDelete"])) {
        $_SESSION["success"] = DeleteMission($_SESSION["ID"], $_POST["ID"]);
    }

    if (isset($_POST["Update"]) && isset($_POST["ID"])) {   
        $_SESSION["update"] = UpdateMission($_SESSION["ID"], $NomMU, $DescMU, $_POST["ID"]);
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
    <button type="button" value="add" class="btn btn-warning btn-lg mt-2" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Create Mission</button>

    <div class="table-container">
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
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

    <!-- Modal for adding mission -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Add Mission</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <?php if (!empty($message)): ?>
                        <div class="alert alert-<?php echo $style; ?>" role="alert">
                            <?php echo $message; ?>
                        </div>
                    <?php endif; ?>
                    <form action="" method="post">
                        <input type="hidden" name="add" value="click">
                        <div class="form-group mb-3">
                            <input type="text" class="form-control" placeholder="Mission Name" name="Nom" required>
                        </div>
                        <div class="form-group mb-3">
                            <textarea class="form-control" placeholder="Mission Description" name="Desc" rows="4" required></textarea>
                        </div>
                        <input type="hidden" name="User_id" value="<?php echo $_SESSION['ID']; ?>"> 
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Mission</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>

<script src="../jquery/jquery-3.7.1.min.js"></script>
<script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
