<?php
session_start();
if(empty( $_SESSION['style'])){
    $_SESSION['style']="style_page.css";

}
$_SESSION['err']="";
include ('mysql.php');
// include 'header.php';
$user = $_SESSION['unic_id'];
$sql = "SELECT * FROM rooms WHERE creat = '$user'";
$row = mysqli_query($conn,$sql);
$user_c = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users_santa` WHERE `unic_id` = $user"));

if(empty($_SESSION['unic_id'])){
    header("Location: ../index");
}
if($user_c['img']==NULL){
    $_SESSION['icon_user']="user_icon.png";
}else{
    $_SESSION['icon_user']=$user_c['img'];
}

$check_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users_santa` WHERE `unic_id` = $user"));
    if($check_user == 0){
        header("Location: ../logout.php");
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf8">
    <link rel="tags" href="seo/tags.html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/<?=$_SESSION['style']?>?1.12">
    <link rel="shortcut icon" href="../img/icon.ico" type="image/x-icon">
    <title>Комнаты</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
<body>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-0H52CVQETV"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
    gtag('config', 'G-0H52CVQETV');
    </script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
    m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(86902766, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
    });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/86902766" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
        <!-- /Yandex.Metrika counter -->


    <div class="header">
    <div class="ogr_header"> 
        <section style="display: inline-flex;">
            <a href = "logout"><img width="64px" height="64px" src="../img/4043276_christmas_clous_santa_icon.png" alt="Выход"></a>
            <h1 class="text_gl">Ваши комнаты <?=$_SESSION['name']?></h1>
            <a href = "lk"><img style="float: right;position:absolute;top:0.5%;right:0.5%;" width="64px" height="64px" src="../img/icon_user/<?=$_SESSION['icon_user']?>" alt="Личный кабинет"></a>
        </section>
        </div>
    </div>
    <div class="content">
        <div class="you_room">
            <h1>Ваши комнаты</h1>
            <a href="new_rooms"><button>Создать комнату</button></a>
        </div>
        
        <div>
        <div class="list_room">
            <?php
                while ($res = mysqli_fetch_assoc($row))
                {
                    
            ?>
            <div>
                <form action = "card_room" method="post">
                <?php if($res['play'] == 1){ $cl = 'class="play" style="color: white;font-size: 27px;"';?><?= "<h5 $cl>✓</h5>"?><?php }?>
                    <input type="hidden" name="id_room" value="<?= $res['unic_id_room']?>"> 
                    <input type="hidden" name="id_rr" value="<?= $res['id']?>">               
                    <p><img src="../img/icon_rooms/<?= $res['img']?>" alt=""></p>
                    <h2><?= $res['name_room']?></h2>
                    <button class="but_open" style="margin-top: 2px;">Открыть</button>   
                </form>
                <?php if($res['play'] == 1){?>
                <form action="del_room.php" method="post">
                <input type="hidden" name="room_id" value="<?= $res['id']?>" >
                <input type="hidden" name="room_uid" value="<?= $res['unic_id_room']?>" >
                <button name="del_but" style="margin-top:1%;">Удалить комнату</button>
                </form>
                  <?php }?>
            </div>
            <?php
                }                    
            ?>
        </div></div>
        <div class="you_room">
            <h1>Комнаты других сант</h1>
        </div>
        <div class="list_room">
                <?php 
                    $cod =mysqli_query($conn, "SELECT `id_room` FROM `rooms_sata` WHERE `id_user` = $user");
                    while($ro = mysqli_fetch_assoc($cod)){
                        $room =  $ro['id_room'];
                        $check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms` WHERE `unic_id_room` = $room"));
                        if($user !== $check['creat']){
                ?>
                         <div>
                            <form action = "card_room" method="post">
                            <?php if($check['play'] == 1){ $cl = 'class="play" style="color: white;font-size: 30px;"';?><?= "<h5 $cl>✓</h5>"?><?php }?>
                                <input type="hidden" name="id_room" value="<?= $check['unic_id_room']?>" > 
                                <input type="hidden" name="id_rr" value="<?= $check['id']?>">                 
                                <p><img src="../img/icon_rooms/<?= $check['img']?>" alt=""></p>
                                <h2><?= $check['name_room']?></h2>
                                <button class="but_open" style="margin-top: 2px;">Открыть</button>
                            </form>
                         </div>
                        <?php }}?>
        </div>
    </div>
    <script src="../js/jq.js"></script>
    <script src="../js/techhelp.js"></script>
</body>
</html>