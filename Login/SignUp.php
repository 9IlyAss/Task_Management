<?php
session_start([
    'cookie_lifetime' => 0,          // Session cookie expires when the browser is closed
    'cookie_httponly' => true,       // Prevent JavaScript from accessing the session cookie
    'cookie_secure' => true,         // Ensure session cookies are only sent over HTTPS
    'use_strict_mode' => true,       // Reject uninitialized session IDs
    'use_only_cookies' => true,      // Prevent using session IDs in the URL
    'sid_length' => 64,              // Increase session ID length for more security
    'sid_bits_per_character' => 6,   // Increase session ID randomness
]);
include("../dbconn.php");
include("../Functions/Log.php");

$message = '';
$style = '';
$Etat="user";
$Droit="desactive";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["Email"];
    $Name = $_POST["Name"];
    $Password = $_POST["Password"];
    $ConfirmPassword = $_POST["Confirmpassword"];
    $Etat="desactive";
    $Droit="user";
    if ($Password != $ConfirmPassword) {
        $message = "Passwords do not match!";
        $style = "danger";
    } else {
        $sql = "SELECT Email FROM USERS WHERE Email=?;";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $message = "The Email Already Exists!";
            $style = "danger";
        } else {

            $hashedPassword = password_hash($Password, PASSWORD_BCRYPT);
            $sql = "INSERT INTO USERS (Nom,Email,Password,Etat,Droit) VALUES (?,?,?,?,?);";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sssss", $Name, $email,$hashedPassword,$Etat,$Droit);
            $stmt->execute();
            $message = "You have successfully signed up! <a href='Login.php' class='alert-link'>Click here to log in</a>";
            $style = "warning";

        }
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../bootstrap-5.3.3-dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS.css">

    <title>Sign Up</title>
</head>
<body>
    
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="card p-4" style="width: 22rem;">
            <div class="card-body text-center">
                <h3 class="card-title mb-5">Sign Up</h3>
                <form action="" method="post">
                <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $style; ?> mt-3" role="alert">
                        <?php echo $message; ?>
                        <?php
                        $message= '';
                        $style = '';
                        ?>
                    </div>
                <?php endif; ?>
                    <div class="form-group mb-2">
                        <input type="text" class="form-control" placeholder="Name" name="Name" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="email" class="form-control" placeholder="Email" name="Email" required>
                    </div>
                    <div class="form-group mb-2">
                        <input type="password" class="form-control" placeholder="Password" name="Password" required>
                    </div>
                    <div class="form-group mb-3">
                        <input type="password" class="form-control" placeholder="Confirm Password" name="Confirmpassword" required>
                    </div>
                    <button type="submit" class="btn btn-dark btn-block">Sign Up</button>
                </form>
                <div class="mt-3">
                    <p>Already have an account? <a href="login.php">Sign In</a></p>
                </div>
                
            </div>
        </div>
    </div>
</body>
</html>