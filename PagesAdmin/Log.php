
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Shared Missions and Tasks Management</title>
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

        .table-container {
            padding: 20px;
            width: 1100px;
        }
    </style>
</head>

<body>

    <div class="col-md-10 main-content mt-4">
        <h1>Log</h1>

        <div class="table-container">
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th scope="col"># ID USER</th>
                        <th scope="col">User Name</th>
                        <th scope="col">Type</th>
                        <th scope="col">Date </th>
                    </tr>
                </thead>
                <tbody>
                    <?php ViewLog(); ?>
                </tbody>
            </table>
        </div>
    </div>
        <script src="../jquery/jquery-3.7.1.min.js"></script>
        <script src="../bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>