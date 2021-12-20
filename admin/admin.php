<?php
include '../php/mysql.php';
session_start();
$i = 1;
$name_p = $_SESSION['name'];
$sql1 = mysqli_query($conn, "SELECT * FROM `zadachy`");
while($sql = mysqli_fetch_assoc($sql1)){
    $all++;
    if($sql['finish']==1){
        $finish++;
    }
}
if(isset($_POST['add'])){
    $text = $_POST['vv'];
    mysqli_query($conn, "INSERT INTO `zadachy` (`id`, `text`, `finish`) VALUES (NULL, '$text', '0')");
    $text = NULL;
    header("Location: admin.php");
}
if(isset($_POST['finish'])){
    $id = $_POST['finish'];
    mysqli_query($conn, "UPDATE `zadachy` SET `finish` = '1' WHERE `zadachy`.`id` = $id;");
    $id =NULL;
}
$res = mysqli_query($conn, "SELECT * FROM `zadachy` ORDER BY `id` DESC");
if(($_SESSION['unic_id']!==3672039)||($_SESSION['unic_id']!==9090680)){

}else{
    header("Location: ../php/myPage");
}
if(isset($_POST['prio'])){
    $id = $_POST['prio'];
    mysqli_query($conn,"UPDATE `zadachy` SET `priority` = '1' WHERE `zadachy`.`id` = $id;");
}
if(isset($_POST['work'])){
    $id = $_POST['work'];
    $name =$_SESSION['name'];
    mysqli_query($conn,"UPDATE `zadachy` SET `work` = '1' WHERE `zadachy`.`id` = $id;");
    mysqli_query($conn,"UPDATE `zadachy` SET `name` = '$name' WHERE `zadachy`.`id` = $id;");
}
if(isset($_POST['admin'])){
    mysqli_query($conn,"UPDATE `users_santa` SET `stutus` = 'admin' WHERE `users_santa`.`unic_id` = $unic_id;");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?11">
    <title>Админка</title>
</head>
<body>
<script src="js/lib.js"></script>
    
    <div class="header">
        <div class="block_ogr">
            <div class="flex">
            <h1 class="none">Панель администратора</h1>
            <div style="flex: 1; "></div>
            <ul class="list_bitton">
                <a  href="../php/lk">Личный кабинет</a>
                <a  href="">Статистика</a>
                <a  class="zadachi" style="cursor: pointer;">Задачи <?=$finish?>/<?=$all?></a>
                <a  class="usesrs" style="cursor: pointer;">Пользователи</a>
                <a  class="rooms" style="cursor: pointer;">Комнаты</a>
                <a  class="tech" style="cursor: pointer;">Чат</a>
            </ul>
            </div>
        </div>
    </div>
    <div class="content">

    </div>
    <script src="js/admin.js?3"> selectImg(); </script>
</body>
</html>