<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Database Error</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            margin: 0;
            padding: 0;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .error-box {
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
            max-width: 80%;
        }

        h1 {
            font-size: 24px;
            margin-top: 0;
        }

        p {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-box">
            <h1>Database Error</h1>
            <p><?php echo $errorMessage; ?></p>
        </div>
    </div>
</body>
</html>
