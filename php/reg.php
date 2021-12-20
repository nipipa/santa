<meta charset="utf8">
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
        <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0H52CVQETV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0H52CVQETV');
</script>
<?php
session_start();
include 'mysql.php';
$id_room = $_POST['id_room'];
$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$pas1 =  $_POST['password'];
if(!empty($_POST['feature'])){
    $feature = $_POST['feature'];
}else{
    $feature = 'На усмотрение дарителя';
}
$pas = md5($pas1);
var_dump($_POST);
echo "<br>";echo $pas; 
$check = mysqli_query($conn, "SELECT * FROM `users_santa` WHERE `email` = '$email'");
if(mysqli_num_rows($check)==0){
    $unic_id = rand(100000,9999999);
    $sql = "INSERT INTO users_santa (id, unic_id,surname, name, email, password, feature, img) VALUES (NULL, '$unic_id', '$surname','$name', '$email','$pas','$feature','user_icon.png')";
    $sql_room = "INSERT INTO `rooms_sata` (`id`, `id_room`, `id_user`,`feature`) VALUES (NULL, '$id_room', '$unic_id', '$feature')";
    mysqli_query($conn ,$sql);
    mysqli_query($conn ,$sql_room);
    mysqli_close($conn);
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['password'] = $pass;
    $_SESSION['unic_id'] = $unic_id;
    if(empty($id_room)){
        exit("<meta http-equiv='refresh' content='0; url= myPage'>");
    }else{
        exit("<meta http-equiv='refresh' content='0; url= https://secret-santa.msk.ru/php/session_reg.php?unic_id=$id_room'>");
    }
    
}else{
    echo "Эта почта уже занята";
}
?>