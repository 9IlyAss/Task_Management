



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <title>Document</title>
</head>
<style>
    .card {
        width: 200px;
        height: 130px;

    }

    .paper {
        font-size: 55px;
        color: white;

    }

    .text {
        color: white;
    }

    .Share {
        background-color: #4834d4;
        height: 150px;
    }

    .Share:hover {
        background-color: #6655d6;
    }

    .card-title {
        font-size: 40px;
    }

    .card-footer,
    .card-text {
        font-size: 20px;
    }

    .tasks {
        height: 100px;
    }

    .task-card {
        padding: 15px;
        border-radius: 8px;
    }

    .tasks {
        height: auto;
    }

    .task-status {
        padding: 5px 10px;
        border-radius: 5px;
        color: white;
        font-weight: bold;
    }

    .status-outstanding {
        background-color: #28a745;
    }
</style>

<body>
                <h3>Welcome <?php echo $_SESSION["Name"]; ?> </h3>
                <!--*******************************************************************************************************
*************************************************************************************************************-->
<?php if(isset($_SESSION["success"])): ?>

<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <strong>Success !! </strong> <?php echo $_SESSION["success"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> 
<?php unset($_SESSION["success"]); ?>
<?php endif; ?>

<?php if(isset($_SESSION["failed"])): ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Failed !! </strong> <?php echo $_SESSION["failed"]; ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div> 
<?php unset($_SESSION["failed"]); ?>
<?php endif; ?>



<div class="stats">
                    <div class="row justify-content-center">
                        <div class="col-auto">
                            <div class="card text-center">
                                <div class="card-body bg-danger">
                                    <h5 class="card-title pt-3">125</h5>
                                </div>
                                <div class="card-footer text-body-secondary" style="background-color: #f74663 ;">
                                    Tasks
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="card text-center">
                                <div class="card-body bg-warning">
                                    <h5 class="card-title pt-3">125</h5>
                                </div>
                                <div class="card-footer text-body-secondary" style="background-color: #ffca2c ;">
                                    Mission
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="card text-center ">
                                <div class="card-body bg-success">
                                    <h5 class="card-title pt-3">125</h5>
                                </div>
                                <div class="card-footer text-body-secondary" style="background-color: #4caf50  ;">
                                    Shared Tasks
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="card text-center Share">
                                <div class="card-body">
                                    <i class="fa-solid fa-paper-plane paper pt-3"></i>
                                    <p class="card-text pt-2 text">Share a Task</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!--*******************************************************************************************************
*************************************************************************************************************-->
                <div class="container mt-3">
                    <div class="row">


                        <div class="col-8 p-3 rounded">
<!-------------------Last 4----->
                            <h4 class="text-white bg-primary p-2 rounded">Last Tasks</h4>
                                    <?php #include("../Functions/Last4.php"); ?>
                        </div> 



                        <div class="col-4 p-3 rounded">
<!-------------------Suggested Accounts-->                           
                            <h5 class="text-white bg-primary p-2 rounded">Suggested Accounts</h5>
                                    <?php #include("../Functions/SuggestedAcc.php"); ?>

                            <h5 class="text-white bg-primary p-2 rounded">Missions</h5>
                                    <?php #include("../Functions/Last4.php"); ?>
                        </div>
                    </div>


                </div>
                <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>

</body>

</html>