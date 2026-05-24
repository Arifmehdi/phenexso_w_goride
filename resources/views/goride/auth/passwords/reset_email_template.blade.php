<!DOCTYPE html>
<html>
<head>
    <style>
        .button {
            background-color: #facc15;
            border: none;
            color: black;
            padding: 15px 32px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 8px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the button below to reset your password:</p>
    <a href="{{ $link }}" class="button">Reset Password</a>
    <p>This password reset link will expire in 60 minutes.</p>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Regards,<br>GoRide Bangladesh</p>
</body>
</html>
