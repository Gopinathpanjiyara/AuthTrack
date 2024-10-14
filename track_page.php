<!DOCTYPE html>
<html>
<head>
    <title>Tracking Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1b273b;
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

        form {
            text-align: center;
            margin: 2rem auto;
            padding: 1rem;
            background-color: #283e57;
            border: 1px solid #0c1829;
            border-radius: 8px;
            width: 60%;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 10px;
            color: #fff;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #0c1829;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button {
            background-color: #0c1829;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #1b273b;
        }
    </style>
</head>
<body>
    <h1>Tracking Page</h1>
    <form method="POST" action="track_result.php">
        <label for="search">Enter Token Number:</label>
        <input type="text" name="token" id="search" required>
        <button type="submit">Search</button>
    </form>
</body>
</html>
