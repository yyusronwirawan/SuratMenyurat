<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 Forbidden</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .error-message {
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }

        h1 {
            color: #d9534f;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="error-message">
            <h1>403 Forbidden</h1>
            <p>Maaf, Anda tidak memiliki izin untuk mengakses halaman ini. {{ session('error') }} </p>
        </div>
    </div>
</body>

</html>
