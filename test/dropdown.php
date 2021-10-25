<?php include("connect.php");?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bigfoot </title>
    <style>
    .container {
        display: flex;
        margin: 3% 10%;
    }

    .dropdown {
        margin-left: 20px;
        width: 50%;
    }

    select {
        width: 100%;
        height: 28px;
    }


    ul {
        list-style-type: none;
    }

    li {
        margin: 10px 0;
    }
    </style>
</head>

<body>
    <div class="container">
        <div class="dropdown">
            <label for="brand">Brand</label>
            <select name="brands" id="brands">

            </select>
        </div>
        <div class="dropdown">
            <label for="model">Model</label>
            <select name="model" id="models">

            </select>
        </div>
    </div>
    <div class="container">
        <ul id="sizes">

        </ul>
    </div>
    <script src="jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>
</body>

</html>