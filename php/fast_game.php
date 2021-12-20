<?php
session_start();
include 'mysql.php';

?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- <link rel="stylesheet" href="../css/style.css?10"> -->
        <!-- <link rel="shortcut icon" href="../img/icon.ico" type="image/x-icon"> -->
        <title>Тайный Сантa</title>
    </head>
    <body>
        <form name = "players">
            <p>Вфберите количество игроков</p>
            <input type="radio" value = 2 name = "group1">
            <input type="radio" value = 3 name = "group1">
            <input type="radio" value = 4 name = "group1">
            <input type="radio" value = 5 name = "group1">
            <input type="radio" value = 6 name = "group1">
            <input type="radio" value = 7 name = "group1">
            <input type="radio" value = 8 name = "group1">


        </form>
    </body>
</html>