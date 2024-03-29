<!DOCTYPE html>
<html>
<head>
    <style>
        * {
            font-family: montserrat;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .logo img {
            max-width: 150px;
        }
        .content {
            margin-bottom: 20px;
        }
        .button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #0091dc;
            color: #ffffff;
            text-decoration: none;
            border-radius: px;
        }
        .img {
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="img">
                <img width="272" height="272" src="https://img.icons8.com/external-flat-icons-vectorslab/272/external-Password-Reset-social-media-flat-icons-vectorslab.png" alt="external-Password-Reset-social-media-flat-icons-vectorslab"/>
            </div>
            <h1 style="text-align: center;">Reset Password</h1>
            <h4>Hello {{ session('username') }},</h4>
            <p style="text-indent: 15px;">You are receiving this email because we received a password reset request for your account.</p>
            <p>Your verification code is :</p>
            <a class="button">{{ session('token') }}</a>
            <p>If you did not request a password reset, no further action is required.</p>
            <p>Regards,</p>
            <h3>EVENTO Team</h3>
        </div>
    </div>
</body>
</html>