<?php
session_start();
// include 'header.php';
if(isset($_POST['icon'])){
    $_SESSION['icon'] = $_POST['icon'];
}
if(empty($_SESSION['icon'])){$_SESSION['icon']="icon1.png";}
if(empty($_SESSION['unic_id'])){
    header("Location: ../index");
}
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="seo" href="../seo/tags.html">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0H52CVQETV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0H52CVQETV');
</script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_ss.css?17">
    <link rel="shortcut icon" href="../img/icon.ico" type="image/x-icon">
    <title>Тайный Сантa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
    <div class="ogr_header">  
        <section style="display: inline-flex;">
        <a href="myPage"><img width="64px" height="64px" src="../img/4043276_christmas_clous_santa_icon.png" alt=""></a>
            <h1 class="text_gl">Тайный Сантa | Создание комнаты</h1>
        </section>
        </div>
    </div>
    <div class="content">
        <div class="rigthbar">
            <h1 style="text-align: center;">Выберите картинку</h1>
            <form action="" method="post">
            <div class="icon_img_room">
                <button name="icon" value="icon1.png"><div><img src="../img/icon_rooms/icon1.png" alt=""></div></button>
                <button name="icon" value="icon2.png"><div><img src="../img/icon_rooms/icon2.png" alt=""></div></button>
                <button name="icon" value="icon3.png"><div><img src="../img/icon_rooms/icon3.png" alt=""></div></button>
                <button name="icon" value="icon4.png"><div><img src="../img/icon_rooms/icon4.png" alt=""></div></button>
                <button name="icon" value="icon5.png"><div><img src="../img/icon_rooms/icon5.png" alt=""></div></button>
                <button name="icon" value="icon6.png"><div><img src="../img/icon_rooms/icon6.png" alt=""></div></button>
                <button name="icon" value="icon7.png"><div><img src="../img/icon_rooms/icon7.png" alt=""></div></button>
                <button name="icon" value="icon8.png"><div><img src="../img/icon_rooms/icon8.png" alt=""></div></button>
                <button name="icon" value="icon9.png"><div><img src="../img/icon_rooms/icon9.png" alt=""></div></button>
                <button name="icon" value="icon10.png"><div><img src="../img/icon_rooms/icon10.png" alt=""></div></button>
                <button name="icon" value="icon11.png"><div><img src="../img/icon_rooms/icon11.png" alt=""></div></button>
                <button name="icon" value="icon12.png"><div><img src="../img/icon_rooms/icon12.png" alt=""></div></button>
            </div>
        </form>
        </div>
        <div class="leftbar">
            <h1 style="text-align: center;">Создание комнаты</h1>
            <form action="new_room" method="post">
                <p style="text-align: center;"><img src="../img/icon_rooms/<?=$_SESSION['icon']?>" alt=""></p>
                <p style="text-align: center;">Имя комнаты<input style="border-radius: 5px;background: none;border:2px solid black;width: 90%;height: 30px;" type="text" name="name_room" required ></p><br>
                <p style="text-align: center;">Количество людей<input style="border-radius: 5px;background: none;border:2px solid black;width: 90%;height: 30px;" type="text" name="kol" placeholder="Мин. 2 Макс. 20" required ></p><br>
                <p style="text-align: center;">Ваше желание<input style="border-radius: 5px;background: none;border:2px solid black;width: 90%;height: 30px;" type="text" name="feature" required ></p><br>
                <p style="text-align: center;">Максимальная стоимость подарка:<input style="border-radius: 5px;background: none;border:2px solid black;width: 90%;height: 30px;" type="text" name="sum" required ></p><br>
                <p style="text-align: center;"><button style="border-radius: 5px;background: none;border:2px solid #F2B441;width: 90%;height: 30px;">Создать</button></p>
            </form>
            
        </div>
    </div>
</body>
</html>