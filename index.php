<!DOCTYPE html>
<html>
<head>
    <title>Login Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            max-width: 400px;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .logo {
            width: 100px; /* Adjust the width as needed */
            margin-bottom: 20px;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
        }

        a {
            display: inline-block;
            background-color: #4285F4;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
        }

        a:hover {
            background-color: #357AE8;
        }

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: bold;
            margin-bottom: 10px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        button {
            background-color: #4285F4;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #357AE8;
        }

        .google-button-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .google-button {
            background-color: #4285F4;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 4px;
            margin-top: 20px;
            display: flex;
            align-items: center;
        }

        .google-button:hover {
            background-color: #357AE8;
        }

        .google-icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <center><img class="logo" src="google-logo.jpg" alt="Google Logo"></center>
        <h1>Login</h1>
        <form method="POST" action="login.php">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" required>

            <label for="password">Password:</label>
            <input type="password" name "password" id="password" required>

            <button type="submit">Login</button>
        </form>

        <p>OR</p>

        <?php
        session_start();
        require_once 'vendor/autoload.php';

        // Replace with your own Google OAuth 2.0 client ID, client secret, and redirect URI
        $clientID = '';
        $clientSecret = '';
        $redirectURI = 'https://holophytic-frequenc.000webhostapp.com/dashboard.html';

        $client = new Google_Client();
        $client->setClientId($clientID);
        $client->setClientSecret($clientSecret);
        $client->setRedirectUri($redirectURI);
        $client->addScope('email');
        $client->addScope('profile');

        if (isset($_GET['code'])) {
            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
            $client->setAccessToken($token);
            $_SESSION['access_token'] = $token;

            $googleService = new Google_Service_Oauth2($client);
            $userData = $googleService->userinfo->get();
            echo '<a class="google-button" href="' . $authURL . '">';
            echo '<img class="google-icon" src="google-icon.png" alt="Google Icon"> Login with Google';
            echo '</a>';
        } else {
            $authURL = $client->createAuthUrl();
            echo '<a class="google-button" href="' . $authURL . '">';
            echo '<img class="google-icon" src="google-icon.png" alt="Google Icon"> Login with Google';
            echo '</a>';
        }
        ?>
    </div>
</body>
</html>
