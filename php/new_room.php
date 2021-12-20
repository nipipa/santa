<html>
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
</html>
<?php
    include 'mysql.php';
    session_start();
    $icon = $_SESSION['icon'];
    $name = $_POST['name_room'];
    $kol =$_POST['kol'];
    $sum =$_POST['sum'];
    $feature = $_POST['feature'];
    if($kol == 1){
        $kol = 2;
    }
    if(($kol >20 )){
        $kol = 20;
    }
    // if(($kol % 2)>0){
    //     $kol++;
    // }
    $unic_id_user = $_SESSION['unic_id'];
    $uinic_id_room = rand(100000,999999);

    $check_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users_santa` WHERE `unic_id` = $unic_id_user"));
    if($check_user == 0){
        header("Location: ../logout.php");
    }
    
    $check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `rooms` WHERE `unic_id_room` = $unic_id_room"));
    
    if($check['unic_id_room']==''){
        $sql ="INSERT INTO `rooms` (`id`, `unic_id_room`, `creat`, `img`, `name_room`,`kol`,`sum`) VALUES (NULL, '$uinic_id_room', '$unic_id_user', '$icon', '$name','$kol','$sum')";
        $sql_room = "INSERT INTO `rooms_sata` (`id`, `id_room`, `id_user`,`feature`) VALUES (NULL, '$uinic_id_room', '$unic_id_user', '$feature')";
        mysqli_query($conn, $sql);
        mysqli_query($conn, $sql_room);
        mysqli_close($conn);
        exit("<meta http-equiv='refresh' content='0; url= myPage'>");
    }
    



