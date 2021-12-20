<?php
    include 'mysql.php';
    $id =  $_POST['room_id'];
    $id_room = $_POST['room_uid'];
    mysqli_query($conn, "DELETE FROM `rooms` WHERE `rooms`.`id` = $id");
    mysqli_query($conn, "DELETE FROM `rooms_sata` WHERE `rooms_sata`.`id_room` = $id_room");
    header("Location: myPage");