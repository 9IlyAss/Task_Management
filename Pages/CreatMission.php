<?php

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name=$_POST["Nom"];
        $Description=$_POST["Desc"];
        AddMission($_SESSION["ID"], $name, $Description);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Create Mission</title>
    <style>
        body {
            background-color: #f4f5f7;
            font-family: 'Roboto', sans-serif;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        .form-title {
            text-align: center;
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h2 class="form-title">Create Mission</h2>

            <form action="" method="post">
                <div class="form-group mb-3">
                    <label for="missionName" class="form-label">Mission Name</label>
                    <input type="text" class="form-control" id="missionName" name="Nom" placeholder="Enter mission name" required>
                </div>

                <!-- Mission Description Field -->
                <div class="form-group mb-3">
                    <label for="missionDescription" class="form-label">Mission Description</label>
                    <textarea class="form-control" id="missionDescription" name="Desc" placeholder="Enter mission description" rows="4" required></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Add Mission</button>
            </form>
        </div>
    </div>

    <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
