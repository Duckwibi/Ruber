<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #ffffff;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #000000;
        }

        .container {
            text-align: center;
        }

        .card {
            background-color: #ffffff;
            border: 2px solid #000000;
            padding: 20px;
            /* Xóa bỏ border-radius để khung viền vuông */
            max-width: 400px;
            margin: auto;
        }

        .card h1 {
            color: #000000;
            margin-bottom: 10px;
        }

        .card p {
            color: #000000;
            margin-bottom: 20px;
        }

        .card button {
            background-color: #000000;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .card button:hover {
            background-color: #333333;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="card">
            <h1>Payment Successful</h1>
            <p>Thank you for your payment!</p>
            <p>Your transaction has been completed successfully.</p>
            <button onclick="window.location.href=''">Return Home</button>
        </div>
    </div>
</body>

</html>