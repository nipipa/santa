<?php
   include 'mysql.php';
   $code = $_GET['code'];
   $ne = $_GET['new_email'];
   $id = $_GET['id'];
   $res = mysqli_fetch_assoc(mysqli_query($conn, "SELECT `verification` FROM `users_santa` WHERE `unic_id` = $id"));
   if($res['verification']==$code){
        mysqli_query($conn, "UPDATE `users_santa` SET `email` = '$ne' WHERE `users_santa`.`unic_id` = $id;");
        mysqli_query($conn, "UPDATE `users_santa` SET `verification` = NULL WHERE `users_santa`.`unic_id` = '$id'");
        header("Location: lk");
   }
//    echo $code;echo"<br>";echo$ne;echo"<br>";echo$id;