<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $mobile = $_POST["mobile"];
    
    $token = bin2hex(random_bytes(10)); // Generates a 20-character token

    // Update the database connection details
    $dbHost = 'localhost'; // Hostname or IP address of your MySQL server
    $dbName = 'id21480896_msritproject'; // Name of your database
    $dbUser = 'id21480896_msrit'; // Your database username
    $dbPass = 'Aman@143'; // Your database password

    try {
        $conn = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "INSERT INTO users (name, mobile, token) VALUES (:name, :mobile, :token)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':mobile', $mobile);
        $stmt->bindParam(':token', $token);

        if ($stmt->execute()) {
            header("Location: token_page.php?token=" . $token);
            exit();
        } else {
            echo "Error: Data not saved.";
        }
    } catch (PDOException $e) {
        echo "Database connection failed: " . $e->getMessage();
    }
}
?>
