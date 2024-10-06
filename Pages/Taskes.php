<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Task Management</title>

    <style>
        /* Header styling */
        h1 {
            margin-top: 20px;
            font-size: 2.5rem;
            color: #343a40;
            text-align: center;
        }

        /* Table styling */
        .table {
            background-color: #ffffff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: center;
        }

        /* Buttons styling */
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

        /* Add some spacing to the table */
        .table-container {
            padding: 20px;
            width: 1100px;
        }
    </style>
</head>

<body>
            <div class="col-md-10 col-lg-8">
                <h1>Tasks</h1>

                <div class="table-container">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Mission Number</th>
                                <th scope="col">Nom</th>
                                <th scope="col">Description</th>
                                <th scope="col">Résultat</th>
                                <th scope="col">Priorité</th>
                                <th scope="col" colspan="2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php   
                                    include ("../Functions/Tasks.php");
                                    AllTasks(1);
                                ?>
                        <!---->


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</body>

</html>
