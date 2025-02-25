<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enable Your Account</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #e0ecfc;
            text-align: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .button {
            display: inline-block;
            padding: 12px 24px;
            background: black; /* Dark Green */
            color: white;
            font-size: 16px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .footer {
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2 style="color: black;">Welcome, {{ $user->name }}!</h2>
        <p>Thank you for registering. Click the button below to enable your account:</p>
        <a href="{{ $url }}" class="button">Enable Account</a>
        <p class="footer">If you did not register for this account, please ignore this email.</p>
    </div>
</body>
</html>
