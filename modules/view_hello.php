<?php defined('BASEPATH') or exit('Akses langsung tidak diizinkan!'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di miniFramework</title>
    <style>
        body {
            margin: 0;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
            font-family: sans-serif;
        }

        div {
            padding: 15px;
            width: 500px;
            height: fit-content;
            text-align: center;
            border: 1px solid #ccc;
            box-shadow: 0 0 15px -5px #ccc;
        }

        h1, p {
            color: #666;
        }
    </style>
</head>
<body>
    <div>
        <h1><?=$header?></h1>
        <p><?=$text?></p>
    </div>
</body>
</html>