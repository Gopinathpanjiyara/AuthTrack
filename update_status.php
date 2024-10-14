<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST["token"];
    $status = $_POST["status"];

    // Update the database with the new status
    try {
        $conn = new PDO("mysql:host=localhost;dbname=id21480896_msritproject", "id21480896_msrit", "Aman@143");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "UPDATE users SET status = :status WHERE token = :token";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':token', $token);
        $stmt->execute();

        // Redirect back to the admin panel
        header("Location: admin_panel.php");
        exit();
    } catch (PDOException $e) {
        echo "Error: Status not updated.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Status Update</title>
</head>
<body>
    <h1>Status Update</h1>
    <p>Status updated successfully.</p>
    <a href="admin_panel.php">Back to Admin Panel</a>
</body>
</html>
