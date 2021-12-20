<meta charset="utf8">
<?php
session_start();
include 'mysql.php';
$id_room = $_GET['unic_id'];
$id_user = $_SESSION['unic_id'];
$email = $_SESSION['email'];
$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `unic_id` FROM `users_santa` WHERE `email` = '$email'"));
$sql = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `user0`,`user1`, `user2`, `user3`, `user4`,`user5`,`kol` FROM `rooms` WHERE `unic_id_room` = '$id_room'"));
// echo $id_room;
$kol = $sql['kol'];
if(!empty($id_user)){
    // echo "id есть и погнали дальше";echo"<br>";
   if($sql['user0']!==$id_user){
    for($i = 1; $i < $kol; $i++){
        $id = "user$i";
        // echo $id;
        if($sql[$id]!==$id_user){
            if($sql[$id]==NULL){
                $user = $check['unic_id'];
               mysqli_query($conn, "UPDATE `rooms` SET `$id` = '$user' WHERE `rooms`.`unic_id_room` = '$id_room';");
            //    echo "Вы добавлены в комнату";
               exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/card_room?id_room=$id_room'>");  
               break;   
            }else{
                // echo "Место занято нет $id";echo"<br>";
                exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/myPage.php'>"); 

            }
        }
       else{
            echo "Вы уже в комнате";echo "<br>";
            $_SESSION['id_room'] = $_GET['unic_id'];
            exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/card_room?id_room=$id_room'>");  
            // header("Location: card_room.php") ;
            break;               
        }
    }
}else{
    exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/card_room?id_room=$id_room'>");  
    // echo "вы создатель";
}
}else{
    // echo "регистрация";
    // header("Location: https://secret-santa.msk.ru/reg.php?id_room=$id_room");
    exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/reg.php?id_room=$id_room'>");  

}



?>