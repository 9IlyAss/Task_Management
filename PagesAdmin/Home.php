<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    <header class="bg-black text-white text-center py-4 mb-4">
        <h1>Welcome <?php echo $_SESSION["Name"]; ?> </h1>
    </header>
    <!--*******************************************************************************************************
*************************************************************************************************************-->
   

    <div class="stats">
        <div class="row justify-content-center">
            <div class="col-auto">
                <div class="card text-center">
                    <div class="card-body bg-danger">
                        <h5 class="card-title pt-3"><?php NbrAccount($Status="active");  ?></h5>
                    </div>
                    <div class="card-footer text-body-secondary" style="background-color: #f74663 ;">
                        Nbr Account +
                    </div>
                </div>
            </div>
            <div class="col-auto">
                <div class="card text-center">
                    <div class="card-body bg-warning">
                        <h5 class="card-title pt-3"><?php NbrAccount($Status="desactive");   ?></h5>
                    </div>
                    <div class="card-footer text-body-secondary" style="background-color: #ffca2c ;">
                    Nbr Account -
                    </div>
                </div>
            </div>
            
            
        </div>
    </div>
</body>
</html>