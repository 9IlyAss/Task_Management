<?php
session_start();
include("../Functions/Mission.php");
include("../Functions/Share.php");
include("../Functions/Tasks.php");
include("../Functions/Log.php");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Dashboard</title>
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

            .icon {
                color: #130f40;
            }
        }

        .down {
            margin-top: 110px;
        }
    </style>
</head>

<body>
    <div class="container-fluid h-100">
        <div class="row h-100">
            <div class="col-md-2 sidebar">


                <h4 class="mb-5 mt-1">Task Manager</h3>
                    <a href="?Page=Home" class="d-flex align-items-center p-2">
                        <i class="fas fa-home me-3 icon"></i> Home
                    </a>
                    <a href="?Page=Mission" class="d-flex align-items-center p-2">
                        <i class="fas fa-file-alt me-3 icon"></i> Mission
                    </a>
                    <a href="?Page=Taskes" class="d-flex align-items-center p-2">
                        <i class="fas fa-share-alt me-3 icon"></i>Tasks
                    </a>
                    <a href="?Page=LinkTask" class="d-flex align-items-center p-2">
                        <i class="fas fa-share-alt me-3 icon"></i> Link Tasks
                    </a>
                    <a href="?Page=SharedMission" class="d-flex align-items-center p-2">
                        <i class="fas fa-share-alt me-3 icon"></i> Shared Mission
                    </a>


                    <div class="mt-4 mb-3">OTHER</div>

                    <a href="?page=Account" class="d-flex align-items-center p-2">
                        <i class="fas fa-user me-3 icon"></i> Account
                    </a>
                    <div class="down">
                        <a href="?Page=CreatMission" class="btn btn-primary mt-2 w-100 ">Create a Mission</a>
                        <a href="../Login/Logout.php" class="btn btn-secondary mt-2 w-100">Logout</a>
                    </div>
            </div>

            <div class="col-md-10 main-content mt-4">
                
                <?php
                $page = isset($_GET['Page']) ? $_GET['Page'] : 'Home';
                $page = preg_replace('/[^a-zA-Z0-9]/', '', $page);
                $page = "../Pages/{$page}.php";
                include($page);
                ?>
            </div>










            <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>

</html>