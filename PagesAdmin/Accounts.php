<?php

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['activation'])) {

        $userID = $_POST['user_id'];
        $action = $_POST['activation'];
        $Status = ($action === 'active') ? 'active' : 'desactive';
        StatusAcc($userID,$Status);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<style>
        body {
            background-color: #dbe1fe; /* Light background */
            font-family: 'Arial', sans-serif; /* Font style */
        }
        h2 {
            margin-bottom: 20px; /* Spacing below heading */
            color: #01041d; /* Heading color */
        }
        .table {
            background-color: #ffffff; /* White background for the table */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }
        th {
            background-color: #9e0451; /* Dark header */
            color: white; /* White text for header */
        }
        .bg-success {
            background-color: #7b8dfb; /* Active state color */
            color: white; /* White text for active state */
        }
        .bg-danger {
            background-color: #f81f19; /* Inactive state color */
            color: white; /* White text for inactive state */
        }
        .table-hover tbody tr:hover {
            background-color: #f1f1f1; /* Light grey on hover */
        }
        .btn-success {
            background-color: #7b8dfb; /* Button color for activate */
            border-color: #7b8dfb; /* Button border color */
        }
        .btn-danger {
            background-color: #f81f19; /* Button color for deactivate */
            border-color: #f81f19; /* Button border color */
        }
    </style>
<body>
<div class="container mt-5">
        <h2>List d'account :</h2>
        <table class="table table-bordered table-hover mt-3">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Etat</th>
                    <th>Email</th>
                    <th>Number of Missions</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php AllAccount(); ?>
            </tbody>
        </table>
    </div>
</body>
</html>
