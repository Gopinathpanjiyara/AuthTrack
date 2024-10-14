<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mobile = $_POST["mobile"];
    $password = $_POST["password"];

    // Check the credentials in the database
    $dbHost = 'localhost'; // Hostname or IP address of your MySQL server
    $dbName = 'id21480896_msritproject'; // Name of your database
    $dbUser = 'id21480896_msrit'; // Your database username
    $dbPass = 'Aman@143';

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT * FROM admin WHERE mobile = :mobile AND password = :password";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        $user = $stmt->fetch();

        if ($user) {
            // Authentication successful
            // Store the user's information in a session
            $_SESSION['user'] = $user;

            // Redirect to the admin panel or any other page
            header("Location: admin_panel.php");
            exit();
        } else {
            $loginError = "Invalid credentials. Please try again.";
        }
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f4f4f4;
        }
        h1 {
            color: #333;
        }
        form {
            max-width: 300px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        label {
            display: block;
            text-align: left;
            font-weight: bold;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <h1>Admin Login</h1>
    <form method="POST" action="admin_login.php">
        <label for="mobile">Mobile Number:</label>
        <input type="tel" id="mobile" name="mobile" required pattern="[0-9]{10}" title="Enter a 10-digit mobile number">
        <br><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Login</button>
        <?php
            if (isset($loginError)) {
                echo '<div class="error">' . $loginError . '</div>';
            }
        ?>
    </form>
</body>
</html>
