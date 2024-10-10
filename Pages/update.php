<?php
session_start();
include("../Functions/Mission.php");

$message = '';
$style = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST["NomU"])) {
        $NomMU = $_POST["NomU"];
        $DescMU = $_POST["DescU"];

        $_SESSION["update"] = UpdateMission($_SESSION["ID"], $NomMU, $DescMU, $_GET['id']);

        $_SESSION['success'] = "Mission updated successfully!";

        header("Location: ../Dashboard/CleintDashboard.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Mission</title>
</head>
<style>
    body {
        background-color: #f4f5f7;
        font-family: 'Roboto', sans-serif;
    }

    .sidebar {
        background-color: #130f40;
        color: white;
        min-height: 100vh;
        padding: 20px;
    }

    .sidebar a {
        color: white;
        text-decoration: none;
        margin-bottom: 15px;
        display: block;
        font-weight: 500;
    }

    .sidebar a:hover {
        background-color: rgb(255, 255, 255);
        border-radius: 8px;
        color: #130f40;
    }

    .down {
        margin-top: 110px;
    }
</style>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 sidebar">
                <h4 class="mb-5 mt-1">Task Manager</h4>
                <a href="?Page=Home" class="d-flex align-items-center p-2">
                    <i class="fas fa-home me-3 icon"></i> Home
                </a>
                <a href="?Page=Taskes" class="d-flex align-items-center p-2">
                    <i class="fas fa-tasks me-3 icon"></i> Tasks
                </a>
                <a href="?Page=Mission" class="d-flex align-items-center p-2">
                    <i class="fas fa-file-alt me-3 icon"></i> Mission
                </a>
                <a href="?Page=Statistics" class="d-flex align-items-center p-2">
                    <i class="fas fa-chart-bar me-3 icon"></i> Review & Statistics
                </a>
                <a href="?Page=shared" class="d-flex align-items-center p-2">
                    <i class="fas fa-share-alt me-3 icon"></i> Shared Tasks
                </a>
                <div class="mt-4 mb-3">OTHER</div>
                <a href="?page=Account" class="d-flex align-items-center p-2">
                    <i class="fas fa-user me-3 icon"></i> Account
                </a>
                <div class="down">
                    <a href="#" class="btn btn-primary mt-2 w-100 ">Create a Task</a>
                    <a href="#" class="btn btn-secondary mt-2 w-100">Logout</a>
                </div>
            </div>

            <div class="col-md-8 mx-auto main-content mt-4">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h2 class="text-center">Update Mission</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="post">
                            <input type="hidden" name="ID" value="<?php echo htmlspecialchars($_GET['id']); ?>">
                            <div class="mb-3">
                                <label for="NomU" class="form-label">Mission Name</label>
                                <input type="text" class="form-control" name="NomU" value="<?php echo htmlspecialchars($_GET['Nom']); ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="DescU" class="form-label">Mission Description</label>
                                <textarea class="form-control" name="DescU" rows="4" required><?php echo htmlspecialchars($_GET['Des']); ?></textarea>
                            </div>
                            <div class="d-flex justify-content-between">
                                <button type="submit" class="btn btn-primary">Update Mission</button>
                                <a href="../Dashboard/CleintDashboard.php" class="btn btn-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>
