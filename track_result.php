<!DOCTYPE html>
<html>
<head>
    <title>Token Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #0c1829;
            color: #fff;
            margin: 0;
            padding: 0;
        }

        h1 {
            background-color: #0c1829;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

        p {
            text-align: center;
            color: #333;
            font-size: 1.2em;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Your Token Status</h1>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"])) {
        // Sanitize the input to prevent SQL injection (you can add more validation)
        $token = filter_var($_POST["token"], FILTER_SANITIZE_STRING);

        // Update the database connection details as needed
        $dbHost = 'localhost'; // Hostname or IP address of your MySQL server
        $dbName = 'id21480896_msritproject'; // Name of your database
        $dbUser = 'id21480896_msrit'; // Your database username
        $dbPass = 'Aman@143'; // Your database password
        try {
            $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Query the database for the tracking status based on the token
            $sql = "SELECT status FROM users WHERE token = :token";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':token', $token);
            $stmt->execute();

            $result = $stmt->fetch();

            if ($result) {
                $status = $result['status'];
                echo "<p>Token Number: $token</p>";
                echo "<p>Status: $status</p>";
            } else {
                echo "<p>Token Number not found.</p>";
            }
        } catch (PDOException $e) {
            echo "Database connection failed: " . $e->getMessage();
        }
    }
    ?>
</body>
</html>
