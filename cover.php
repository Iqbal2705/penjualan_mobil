<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #ffe6f0, #ffc0cb);
            color: #333;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            text-align: center;
            position: relative;
        }

        .header {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .header a {
            text-decoration: none;
            color: white;
            background-color: #ff69b4;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: bold;
            transition: background-color 0.3s;
        }

        .header a:hover {
            background-color: #ff85c1;
        }

        .welcome-box {
            background: rgba(255, 255, 255, 0.7);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
            max-width: 90%;
        }

        .welcome-box h1 {
            font-size: 2.8em;
            margin-bottom: 20px;
            color: #d63384;
        }

        .welcome-box p {
            font-size: 1.2em;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="header">
        <a href="login.php">Login</a>
    </div>

    <div class="welcome-box">
        <h1>Selamat Datang!</h1>
        <p>Temukan kenyamanan dan kemudahan dalam layanan kami.  
        <br/>Kami siap memberikan pengalaman terbaik untuk Anda.</p>
    </div>
</body>
</html>

