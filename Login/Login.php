<?php
session_start([
    'cookie_lifetime' => 0,
    'cookie_httponly' => true,
    'cookie_secure' => true,
    'use_strict_mode' => true,
    'use_only_cookies' => true,
    'sid_length' => 64,
    'sid_bits_per_character' => 6,
]);

include("../dbconn.php");
include("../Functions/Log.php");

$message = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])) {
        die("Invalid CSRF token");
    }
    $Email = $_POST["Email"];
    $Password = htmlspecialchars($_POST["Password"],ENT_QUOTES, 'UTF-8');

    if (!filter_var($Email, FILTER_VALIDATE_EMAIL)) {
    die("Invalid email format.");
    }

    
    $sql = "SELECT Nom, Email, Password, id, Etat, Droit FROM USERS WHERE Email = ?;";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $Email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        $message = "Invalid email or password!";
    } else {
        $stmt->bind_result($dbName, $dbEmail, $dbPassword, $dbUserID, $Etat, $Role);
        $stmt->fetch();

        if ($Etat === "desactive") {
            $message = "Your account isn't active yet!";
        } else {
            if (!password_verify($Password, $dbPassword)) {
                $message = "Invalid email or password!";
            } else {
                $_SESSION["Email"] = $dbEmail;
                $_SESSION["Name"] = $dbName;
                $_SESSION["ID"] = $dbUserID;
                $_SESSION["Role"] = $Role;

                $op = "has logged into the system";
                AddLog($dbUserID, $op);

                if ($dbEmail === "Admin@gmail.com") {
                    header("Location: ../Dashboard/AdminDashboard.php");
                } else {
                    header("Location: ../Dashboard/CleintDashboard.php");
                }
                exit();
            }
        }
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS.css">
    <title>Login</title>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-5 fs-2">Login</h3>
                <?php if (!empty($_SESSION['message'])): ?>
                    <div class="alert alert-success" role="alert">
                        <?php echo $_SESSION['message'];
                        unset($_SESSION['message']); ?>
                    </div>
                <?php endif; ?>
                <?php if (!empty($message)): ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $message; ?>
                    </div>
                <?php endif; ?>
                <form action="" method="post" autocomplete="off">
                <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">

                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Email" name="Email" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="ForgetPass.php" class="small">Forgotten password?</a>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Sign In</button>
                </form>
                <div class="mt-3">
                    <p>Don't have an account? <a href="SignUp.php">Sign Up</a></p>
                </div>
            </div>
        </div>
    </div>
    <script src="/jquery/jquery-3.7.1.min.js"></script>
</body>
</html>
