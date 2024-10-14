<?php
session_start();

// Check if the user is authenticated
if (!isset($_SESSION['user'])) {
    // If the user is not authenticated, redirect to the login page
    header("Location: admin_login.php");
    exit();
}

// User is authenticated, continue displaying the admin panel
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #0c1829;
            color: #fff;
            text-align: center;
            padding: 1rem 0;
        }

        .container {
            width: 90%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            border: 1px solid #ddd;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #0c1829;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        select, button {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            background-color: #fff;
        }

        button {
            background-color: #0c1829;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #283e57;
        }

        button:active {
            background-color: #07101c;
        }

        button:focus {
            outline: none;
        }

        a {
            text-decoration: none;
            color: #0c1829;
        }

        a:hover {
            color: #283e57;
        }
    </style>
</head>
<body>
    <header>
        <h1>Admin Panel</h1>
    </header>
    <div class="container">
        <table>
            <tr>
                <th>Name</th>
                <th>Mobile</th>
                <th>Token</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            <?php
            // Fetch and display the data from the database
            try {
                $conn = new PDO("mysql:host=localhost;dbname=id21480896_msritproject", "id21480896_msrit", "Aman@143");
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $sql = "SELECT * FROM users";
                $stmt = $conn->query($sql);

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['mobile'] . "</td>";
                    echo "<td>" . $row['token'] . "</td>";
                    echo "<td>" . $row['status'] . "</td>";
                    echo "<td>
                        <form action='update_status.php' method='post'>
                            <input type='hidden' name='token' value='" . $row['token'] . "'>
                            <select name='status'>
                                <option value='in-progress'>In Progress</option>
                                <option value='approved'>Approved</option>
                                <option value='denied'>Denied</option>
                            </select>
                            <button type='submit'>Update Status</button>
                        </form>
                    </td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Database connection failed: " . $e->getMessage();
            }
            ?>
        </table>
    </div>
</body>
</html>
