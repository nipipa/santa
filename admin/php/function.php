<?php
function showZad(){
    include 'connect.php';
    $res = mysqli_query($conn, "SELECT * FROM `zadachy` ORDER BY `id` ASC");
    $out = array();
        while($row = mysqli_fetch_assoc($res)){
            $out[$row["id"]]=$row;
        }
        echo json_encode($out);
}
function showUsers(){
    include 'connect.php';
    $res = mysqli_query($conn, "SELECT * FROM `users_santa`");
    $out = array();
        while($row = mysqli_fetch_assoc($res)){
            $out[$row["id"]]=$row;
        }
        echo json_encode($out);
}
function showRooms(){
    include 'connect.php';
    session_start();
    $res = mysqli_query($conn, "SELECT * FROM `rooms`");
    $out = array();
        while($row = mysqli_fetch_assoc($res)){
            $out[$row["id"]]=$row;
          
        }
        $out["us"] = $_SESSION['name'];
        echo json_encode($out);
}