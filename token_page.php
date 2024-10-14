<!DOCTYPE html>
<html>
<head>
    <title>Token Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            text-align: center;
        }

        h1 {
            color: #333;
        }

        p {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            text-align: left;
        }

        p::before {
            content: "Your Token: ";
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Your Token</h1>
    <p><?php echo isset($_GET["token"]) ? $_GET["token"] : "Token not available"; ?></p>
</body>
</html>
