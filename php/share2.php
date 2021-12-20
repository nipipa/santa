<meta charset="utf8">
<?php
session_start();
include 'mysql.php';
$id_room = $_GET['unic_id'];
$id_user = $_SESSION['unic_id'];
$email = $_SESSION['email'];
$check = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `unic_id` FROM `users_santa` WHERE `email` = '$email'"));
$sql = mysqli_fetch_assoc(mysqli_query($conn,"SELECT `creat`,`kol` FROM `rooms` WHERE `unic_id_room` = '$id_room'"));
// echo $id_room;
$kol = $sql['kol'];
if(!empty($id_user)){
    // echo "id есть и погнали дальше";echo"<br>";
   if($sql['user0']!==$id_user){
       $check = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `rooms_sata` WHERE `id_room` = $id_room AND `id_user` = $id_user"));
       $check_kol = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `rooms_sata` WHERE `id_room` = $id_room"));
       if($check_kol<$kol){
       if($check == 0){
            mysqli_query($conn,"INSERT INTO `rooms_sata` (`id`, `id_room`, `id_user`) VALUES (NULL, '$id_room', '$id_user')");
            exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/card_room?id_room=$id_room'>");  
        }
    }else{
        // echo "Мест нет";
        
        exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/myPage.php'>");
    }
}else{
    exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/card_room?id_room=$id_room'>");  
    // echo "вы создатель";
}
}else{
    //  echo "регистрация";
    // header("Location: https://secret-santa.msk.ru/reg.php?id_room=$id_room");
    exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/reg.php?id_room=$id_room'>");  

}


?>