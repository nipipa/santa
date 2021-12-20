<?php
session_start();
include "mysql.php";
include "header.php";
if(empty($_GET['id'])){
    $id = $_SESSION['id_rr'];
}else{
    $id = $_GET['id'];
}
$user = $_SESSION['unic_id'];
$name = $_SESSION['name'];
$email = $_SESSION['email'];
$kol  = $_POST['kol'];




// определяем количество пользователей
$j = mysqli_fetch_assoc(mysqli_query($conn , "SELECT `unic_id_room`,`kol`,`play`,`sum` FROM `rooms` WHERE `id` = $id"));
$kol = $j['kol'];
$id_room = $j['unic_id_room'];
$sum = $j['sum'];
// определяем количество пользователей



if(($j['play']==0)&&(!empty($user))){
    $end_index = $kol;
    $sql = mysqli_query($conn,"SELECT `id_user` FROM `rooms_sata` WHERE `id_room` = $id_room");
    $array = array();
    while($rows = mysqli_fetch_assoc($sql)) {
        $array[] = $rows;
      }
    shuffle($array);
    for($i=$kol-1;$i>0;$i--){
       $a =  $array[$i]['id_user'];
       $b =  $array[$i-1]['id_user'];
       $sql_code ="INSERT INTO `win` (`id`, `id_room`, `id_user`, `comn`) VALUES (NULL, '$id_room', '$a', '$b')";
        mysqli_query($conn, $sql_code);

    }
    $a =  $array[0]['id_user'];
    $b =  $array[$end_index-1]['id_user'];
    $sql_code ="INSERT INTO `win` (`id`, `id_room`, `id_user`, `comn`) VALUES (NULL, '$id_room', '$a', '$b')";
    mysqli_query($conn, $sql_code);
    mysqli_query($conn, "UPDATE `rooms` SET `play` = '1' WHERE `rooms`.`id` = $id;");

}

$u_us = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `comn` FROM `win` WHERE `id_room` = $id_room AND `id_user` = $user"));
$re = $u_us['comn'];
$u= mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users_santa` WHERE `unic_id` = $re"));
$g= mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms_sata` WHERE `id_room` = '$id_room' AND `id_user` = '$re'"));

$u_name = $u['name'];
$u_email = $u['email'];
$u_feature = $u['feature'];
// email
    function send_mass($name, $u_name,$u_feature, $email){
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: secret-santa@secret-santa.msk.ru\r\n";
        $headers .= "Reply-To: secret-santa@secret-santa.msk.ru\r\n";
        $headers .= "X-Mailru-Dmarc-Auth: dmarc=pass header.from=secret-santa@secret-santa.msk.ru";
        $message = "<style>
            body{
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: url('https://image.freepik.com/free-vector/snowflakes-seamless-pattern_24877-53365.jpg');
            }
        </style>";
        $message .= "<div style=\"background-color: #c8def47a;width:60%;margin: 0 auto;padding:2%;;border-radius: 15px;\">";
        $message .= "<div style=\"display: flex;\"><img style=\"margin: 1%;\" src=\"https://cdn4.iconfinder.com/data/icons/avatars-xmas-giveaway/128/santa_clous_christmas-128.png\"><h1 style=\"margin-top:2%;\">Тайный Сантa</h1></div>";
        $message .= "Результаты игры - $name";
        $message .="<p >Вы отправляете подарок - $u_name";
        $message .="<p >Email адрес для отправки - $u_name";
        $message .="<p >Желание- $u_feature";
        $message .="</div>";
        mail($email, "Secret Santa", $message, $headers);
    }
// email
if($j['win']==0){
    // send_mass($name, $u_name, $u_feature, $email);
}
mysqli_query($conn, "UPDATE `rooms` SET `play` = '1' WHERE `rooms`.`id` = $id;
");
if($check_user == 0){
    header("Location: ../logout.php");
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="../img/icon.ico" type="image/x-icon">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_res.css?4">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <title>Комнаты</title>
</head>
<body>
    <div class="header">
    <div class="ogr_header"> 
        <section style="display: inline-flex;">
            <a href = "myPage.php"><img width="64px" height="64px" src="../img/4043276_christmas_clous_santa_icon.png" alt=""></a>
            <h1 class="text_gl">Тайный Сантa</h1>
            
        </section>
        </div>
    </div>
    <div class="content">
        <div class="result">
            <h1 class="res_user">Результаты игры, <?=$name?></h1></br>
            <div class="list">
            <p >Вы отправляете подарок -  <?=$u['name'] . " " . $u['surname']?></p></br> 
            <p>Email адрес для отправки - <?=$u['email']?></p></br>
            <p >Желание  -  <?=$g['feature']?></p></br>
            <p> Лимит подарка - <?=$sum ?> руб<p> </br>
            </div>
        </div>
</body>
</html>