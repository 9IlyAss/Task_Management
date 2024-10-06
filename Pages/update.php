<?php

include("../Functions/Mission.php");

$message = '';
$style = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["NomU"]) && isset($_POST["ID"])) {
        $NomMU = $_POST["NomU"];
        $DescMU = $_POST["DescU"]; 

        // Update the mission
        $_SESSION["update"] = UpdateMission($_SESSION["ID"], $NomMU, $DescMU, $_POST["ID"]);
        
        // Set a message to be displayed after redirect
        $_SESSION['success'] = "Mission updated successfully!";

        // Redirect after the update
        header("Location: ../Dashboard/CleintDashboard.php"); // Redirect to the client dashboard
        exit(); // Exit after redirection
    }
}
if (isset($_GET['id'])) {
    $mission = GetMission($_GET['id']);
} else {
    header("Location: ../Dashboard/CleintDashboard.php");
    exit();
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

<body>
    <div class="container mt-5">
        <h2 class="text-center">Update Mission</h2>

        <?php if (!empty($message)): ?>
            <div class="alert alert-<?php echo $style; ?>" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <form action="" method="post">
            <input type="hidden" name="ID" value="<?php echo $_GET['id']; ?>">
            <div class="mb-3">
                <label for="NomU" class="form-label">Mission Name</label>
                <input type="text" class="form-control" name="NomU" value="<?php echo htmlspecialchars($mission['Nom']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="DescU" class="form-label">Mission Description</label>
                <textarea class="form-control" name="DescU" rows="4" required><?php echo htmlspecialchars($mission['Desc']); ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Update Mission</button>
            <a href="../Dashboard/CleintDashboard.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="../jquery/jquery-3.7.1.min.js"></script>
    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
