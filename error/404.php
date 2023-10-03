<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 : Not Found</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            font-family: sans-serif;
        }

        div {
            width: 500px;
            height: fit-content;
            margin: auto;
            overflow: hidden;
            border: 1px solid #ccc;
            padding: 15px;
            border-radius: 15px;
            box-shadow: 2px 2px 15px -5px #ccc;
            text-align: center;
            color: #5d5858;
        }
    </style>
</head>

<body>
    <div>
        <h1>404</h1>
        <h3>Halaman yang Anda Cari Tidak ditemukan!</h3>
        <a href="javascript:history.back()">Kembali</a> &nbsp;
        <a href="<?= url('/') ?>">Halaman Utama</a>
    </div>
</body>

</html>