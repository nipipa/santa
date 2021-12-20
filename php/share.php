<head><meta charset="utf-8"></head>
<?php
session_start();
include 'mysql.php';
$id_room = $_GET['unic_id'];
$email = $_SESSION['email'];
$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `unic_id` FROM `users_santa` WHERE `email` = '$email'"));
$sql = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `user0`,`user1`, `user2`, `user3`, `user4`,`user5` FROM `rooms` WHERE `unic_id_room` = '$id_room'"));

if($check['unic_id']!==$sql['user0']){
    if(!empty($_SESSION['email'])){
        for($i = 1; $i < 6; $i++){
            $id = "user$i";
            if($sql[$id]!==$check['unic_id']){
                if($sql[$id]==NULL){
                    $user = $check['unic_id'];
                   mysqli_query($conn, "UPDATE `rooms` SET `$id` = '$user' WHERE `rooms`.`unic_id_room` = '$id_room';");
                   echo "Вы добавлены в комнату";
                   exit("<meta http-equiv='refresh' content='0; url= myPage'>");  
                   break;   
                }else{
                    echo 'Мест нет';
                }
            }
           else{
                echo "Вы уже в комнате";echo "<br>";
                $_SESSION['id_room'] = $_GET['unic_id'];
                // exit("<meta http-equiv='refresh' content='0; url= card_room'>"); 
                // header("Location: card_room.php") ;
                break;               
            }
        }
    }else{
        // exit("<meta http-equiv='refresh' content='0; url= registration'>"); 
        // $_SESSION['id_room']=$id_room ;
        $id_room = $_GET['unic_id'];
        echo "Почты нет";
        // header("Location:  https://secret-santa.msk.ru/reg.php?id_room=$id_room");
        // exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/reg.php?id_room=$id_room'>"); 
        
    }
    
}else{
    $_SESSION['id_room'] = $_GET['unic_id'];
    // exit("<meta http-equiv='refresh' content='0; url= card_room?$id_room'>"); 
    echo "ты создатель";
}