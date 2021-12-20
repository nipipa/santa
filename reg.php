<?php
    include 'php/mysql.php';
    $id_room = $_GET['id_room'];
    // echo $id_room;
    $room = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms` WHERE `unic_id_room` = $id_room"));
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?18">
    <link rel="shortcut icon" href="img/icon.ico" type="image/x-icon">
    <title>Тайный Сантa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
</head>
<body>
    <div class="header">
    <div class="ogr_header"> 
       <a style="text-decoration: none;color: black;padding-top: 1%;width: auto;border-radius: 5px;" href="index.php"><section style="display: inline-flex;">
            <img width="64px" height="64px" src="img/4043276_christmas_clous_santa_icon.png" alt="">
            <h1 class="text_gl">Тайный Сантa</h1>
        </section></a>
    </div>
    </div>  
    <div class="content">
        <div class="auth_back back4">
        <div class="auth" style="margin-bottom: 0.2%;">
        <?php if(empty($id_room)){?>
        <form action="php/reg.php" method="post">
            <h1 style="text-align:center;color:white;">Регистрация</h1>
            <p style="margin-bottom: 0;text-align:center;">Имя: <input type="text" name="name"> </p>
            <p style="margin-bottom: 0;text-align:center;">Фамилия: <input type="text" name="surname"> </p>
            <p style="margin-bottom: 0;text-align:center;">Почта:<input type="email" name="email" id=""> </p>
            <p style="margin-bottom: 0;text-align:center;">Пароль: <input type="password" name="password" id=""></p>
            <!-- <p style="margin-bottom: 0;text-align:center;">Желание: <textarea style=" resize: none;height:60px;width:90%;border-radius:8px;padding:0;background:none;border: 2px solid white;text-align:center;color:white;" name="feature" id="" cols="30" rows="10"></textarea></p> -->
            <p><button class="game">Начать игру</button></p>
        </form>
    <?php }else{?>    
        <form action="php/reg.php" method="post">
            <h1 style="text-align:center;color:white;font-size:22px;">Зарегистрируйтесь для того чтоб войти в комнату</h1>
            <input type="hidden" name="id_room" value="<?=$id_room?>">
            <p style="margin-bottom: 0;text-align:center;">Имя: <input type="text" name="name"></p>
            <p style="margin-bottom: 0;text-align:center;">Фамилия: <input type="text" name="surname"> </p>
            <p style="margin-bottom: 0;text-align:center;">Почта: <input type="email" name="email" id=""></p>
            <p style="margin-bottom: 0;text-align:center;">Пароль: <input type="password" name="password" id=""></p>
            <p style="margin-bottom: 0;text-align:center;">Желание: <textarea style=" resize: none;height:60px;width:90%;border-radius:8px;padding:0;background:none;border-radius: 5px;border: 2px solid white;text-align:center;color:white;" name="feature" id="" cols="30" rows="10"></textarea></p>
            <p><button class="game">Начать игру</button></p>
        </form>
        <h6 style="margin-bottom: 0;text-align:center;color:white;">Если вы зарегистрированы, нажмите <a href="index">Войти</a> после перейдите по ссылке приглашения &#128512;</h6>
    <?php }?>  
        </div>
        <?php if(!empty($id_room)){?>
        <div class="room" style="width: 100px;border:2px solid white;border-radius: 15px;padding:1%;margin:0 auto;">
            <img src="img/icon_rooms/<?=$room['img']?>" alt=""><h1 style="color: white;text-align:center;"><?=$room['name_room']?></h1>
        </div>
        <?php }?> 
        <div class="info">
           <h1 style="text-align: center;margin: 0.2%;">Что такое «Тайный Санта?»</h1><br>
           <h2>«Тайный Сантa» — популярная церемония анонимного обмена подарками. Это новогодняя игра с простыми правилами: каждый участник является Тайным Сантой для одного из остальных участников и втайне готовит для него подарок. В результате всем достаётся и радость подготовки сюрприза, и подарок.
            Данный сайт — сервис, который помогает огранизовать эту игру онлайн.</h2>
        </div>
       
    </div>
    <div class="blocks">
    <div class="bloc_w">
        <div><h3 class="namber">1</h3>
            <img style="float: right;" src="img/icon_rooms/icon1.png" alt="">
            <h4 style="font-size: 20px;">Создайте коробку для жеребьевки, указав её название, ограничение на стоимость подарков и другие опции по желанию. Пригласите своих друзей, отправив им ссылку на коробку или через ввод их email адресов вручную.</h4>
            
        </div>
        <div><h3 class="namber  two">2</h3>
            <img class="img_two" src="img/icon_rooms/icon3.png" alt="">
            <h4 style="font-size: 20px;">Участники могут добавить в карточку свои пожелания по подарку и почтовый адрес. Следите за пополнением карточек участников, и, как только все игроки зарегистрировались, проведите тайную жеребьевку.</h4>
        </div>
        <div><h3 class="namber">3</h3>
            <img style="float: right;" src="img/icon_rooms/icon6.png" alt="">
            <h4 style="font-size: 20px;">Сразу после проведения жеребьевки всем участникам на почту придёт уведомление, и они узнают, кому нужно подготовить подарок.</h4>
        </div>
    </div>
    </div>
    </div>
</body>
</html>