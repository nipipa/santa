<?php
    include 'mysql.php';
    session_start();
    $id = $_SESSION['id_room'];
    $_SESSION['id_rr']= $_POST['id_rr'];
    $id = $_SESSION['id_rr'];
    $creat = $_SESSION['unic_id'];
    if(empty($_GET['id_room'])){
        $id = $_POST['id_room'];
        $_SESSION['id_rr']=$_POST['id_rr'];
    }else{
        $id = $_GET['id_room'];
        $_SESSION['id_rr']=$id;
    }
    $res = mysqli_fetch_assoc( mysqli_query($conn, "SELECT * FROM `rooms` WHERE `unic_id_room` = $id"));
    $users = mysqli_fetch_assoc( mysqli_query($conn, "SELECT `id_user` FROM `rooms_sata` WHERE `id_room` = $id"));
    $kol_users = mysqli_num_rows(mysqli_query($conn, "SELECT `id_user` FROM `rooms_sata` WHERE `id_room` = $id"));
    $kol = $res['kol'];
    if($res['play']==1){
        $ss = $res['id'];
        header("Location: res?id=$ss");
    }
    if($_POST['but_del']){
        $user = $_POST['but_del'];
        mysqli_query($conn, "DELETE FROM `rooms_sata` WHERE `rooms_sata`.`id_user` = $user");
    }
    if($res == NULL){
        header("Location: myPage");
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style_card.css?22">
    <link rel="shortcut icon" href="../img/icon.ico" type="image/x-icon">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Comfortaa&display=swap" rel="stylesheet">
    <title><?=$res['name_room']?></title>
</head>
<body>
    <script src="../js/qrcode.js"></script>
    <script src="../js/main.js"></script>
<script>
    function p(){
        document.location.href="https://secret-santa.msk.ru/php/myPage";
    }
</script>
    

    <!-- new header -->

            <div class="header">
                <div class="ogr_header">
                    <a href="myPage"><img  src="../img/icon_rooms/<?=$res['img']?>" alt=""></a>
                    <h1 class="text_gl" style="margin: 1%;"><?=$res['name_room']?></h1>
                    <?php 
                    if($res['creat']==$_SESSION['unic_id']){
                    ?>
                    <p style="text-align: center;"><form style="margin-left :auto;" action="del_room.php" method="post">
                        <input type="hidden" name="room_id" value="<?=$res['id']?>"> <input type="hidden" name="room_uid" value="<?= $res['unic_id_room']?>" ><button style="margin-top:40%;vertical-align: middle;border: 2px solid orange;border-radius: 10px;background: none;color: black;font-weight: bold;">Удалить</button>
                    </form></p><br>
                    <?php }?>
                </div>
            </div>

    <!-- end new header -->
    <div class="content">
       <?php if($res['creat']==$creat){ ?> <div class="info_room">
           <?php if($res['creat']==$creat&&$a <6){?><h4>Ссылка для приглашения</h4><h2 class="ssilka">https://secret-santa.msk.ru/add_user_to_room?unic_id=<?=$id?></h2>
            <div id="qrcode"></div>
                <script type="text/javascript">

                    // new QRCode(document.getElementById("qrcode"), "https://secret-santa.msk.ru/add_user_to_room?unic_id=<?=$id?>");
                    var qrcode = new QRCode("qrcode", {
                        text: "https://secret-santa.msk.ru/add_user_to_room?unic_id=<?=$id?>",
                        width: 256,
                        height: 256,
                        colorDark : "#6784a1",
                        colorLight : "#c8def47a",
                        correctLevel : QRCode.CorrectLevel.H,
                        logo: 'fon.jpg',
                        logoWidth: undefined,
    logoHeight: undefined,
    logoBackgroundColor: '#ffffff',
    logoBackgroundTransparent: false
                    });

              </script><?php }?>
        </div><?php }?>
        <div class="list_user">
            <h1 style="text-align: center;">Список участников <?=$kol_users?>/<?=$kol?></h1>
            <?php if(($res['creat']==$_SESSION['unic_id'])&&($kol == $kol_users)){ ?><p style="text-align: center;"><form action="res"><input type="hidden" name="kol" value="<?=$kol_users?>"><input type="hidden" name="id_room" value="<?=$id?>"><p style="text-align: center;"><button class="start_play" name="play">Начать игру</button></p></form></p><?php }?>
            <h2 class="sum">Максимальная стоимость подарка: <?=$res['sum']?></h2>
            <?php 
                $cod = mysqli_query($conn, "SELECT `id_user` FROM `rooms_sata` WHERE `id_room` = $id");
                while($info_users = mysqli_fetch_assoc($cod)){
                    $info_users = $info_users['id_user'];
                    $u = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM `users_santa` WHERE `unic_id` = $info_users"))
            ?>
            <div class="us">
                <img width="64px" height="64px" class="nimg" src="../img/icon_user/<?=$u['img']?>" alt="">
                <h1 style="margin: 0;margin-top: 0.5%;"><?php if($res['creat']==$_SESSION['unic_id']){if($res['creat']==$u['unic_id']){echo $u['name'];echo'     ';echo $u['surname'];echo' -    ';echo 'создатель';}else{echo $u['name'];echo'     ';echo $u['surname'];echo' -    ';echo $u['email'];}}else{echo$u['name'];echo ' ';$u['surname'];}?></h1>
                <?php if(($res['creat']==$_SESSION['unic_id'])&&($u['unic_id']!==$_SESSION['unic_id'])){?><form style="margin-left: auto;margin-right:2%;" action="" method="post"><button name="but_del" value="<?=$u['unic_id']?>" class="but_delet">Удалить</button></form><?php }?>
            </div>
            <?}?>
        </div>
    </div>
</body>
</html>