<?php
    session_start();
    include 'mysql.php';
    // include 'header.php';
    if(isset($_POST['style'])){
        $_SESSION['style']=$_POST['style'];
       
    }else{
        $_SESSION['style']='style_page.css';
        
    }
    $name = $_SESSION['name'];
    $email = $_SESSION['email'];
    $unic_id = $_SESSION['unic_id'];
    $img = $_SESSION['icon_user'];
    $headers= "MIME-Version: 1.0\r\n";
        $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
        $headers .= "From: Secret Santa\r\n";
        $headers .= "Cc: Secret-santa@msk.ru\r\n";
        $headers .= "Bcc: Secret-santa@msk.ru\r\n";
    // echo $_SESSION['name'];
    if(isset($_POST['simg'])){
        $_SESSION['icon_user']=$_POST['simg'];
        $img = $_SESSION['icon_user'];
        mysqli_query($conn,"UPDATE `users_santa` SET `img` = '$img' WHERE `users_santa`.`unic_id` = $unic_id;");
    }
    $database_user= mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users_santa` WHERE `unic_id` = $unic_id"));
    if (isset($_POST['but_name']))
    {
            $new_name = $_POST['new_name'];
            // echo $new_name;
            mysqli_query($conn,"UPDATE `users_santa` SET `name` = '$new_name' WHERE `users_santa`.`unic_id` = '$unic_id'");
            $_SESSION['name'] = $new_name;
            $message = 'Вашe имя было успешно изменено.';
            $subject = 'Смена учетных данных';
            mail($email, $subject , $message , $headers);
            header("Location: lk");
            
            // echo $_SESSION['name'];
    }
    $row = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users_santa` WHERE `unic_id` = $unic_id"));
    $pass_now = md5($_POST['pass_now']);
    if (isset($_POST['but_pass']) && ($pass_now == $row['password']))
    {
        $new_pass = $_POST['new'];
                $new_pass = md5($_POST['new_pass']);
                $new_pass_1 = md5($_POST['new_pass_1']);

                if ($new_pass == $new_pass_1)
                {
                    $_SESSION['email'] = $email;
                    mysqli_query($conn,"UPDATE `users_santa` SET `password` = '$new_pass' WHERE `users_santa`.`unic_id` = '$unic_id'");
                    $message = 'Ваш пароль был успешно изменен.';
                    $subject = 'Смена учетных данных';
                    mail($email, $subject , $message , $headers);
                    echo 'Ваш пароль был успешно изменен.';
                    header("Location: lk");
                }
    }

    if ((isset($_POST['but_kode_send']))&&(!empty($_POST['email_new'])))
    {
        $rand = md5(rand(1000,9999));
        $ne = $_POST['email_new'];
        mysqli_query($conn, "UPDATE `users_santa` SET `verification` = '$rand' WHERE `users_santa`.`unic_id` = '$unic_id'");
        // echo $rand;echo"<br>";
        $rand = "https://secret-santa.msk.ru/php/change_email.php?code=$rand&&new_email=$ne&&id=$unic_id";
        // echo $rand;
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= "From: secret-santa@secret-santa.msk.ru\r\n";
        $headers .= "Reply-To: secret-santa@secret-santa.msk.ru\r\n";
        $headers .= "X-Mailru-Dmarc-Auth: dmarc=pass header.from=secret-santa@secret-santa.msk.ru";
        $message = "<style>
            body{
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
                background: url('https://image.freepik.com/free-vector/snowflakes-seamless-pattern_24877-53365.jpg');
            }
        </style>";
        $message .= "<div style=\"background-color: #c8def47a;width:60%;margin: 0 auto;padding:2%;;border-radius: 15px;\">";
        $message .= "<div style=\"display: flex;\"><img style=\"margin: 1%;\" src=\"https://cdn4.iconfinder.com/data/icons/avatars-xmas-giveaway/128/santa_clous_christmas-128.png\"><h1 style=\"margin-top:2%;\">Тайный Сантa</h1></div>";
        $message .= "перейдите по ссылке для смены почты - <a href=\"$rand\" target=\"_blank\">Ссылка</a>";
        $message .="<h4>Спасибо что вы с нами</h4>";
        $message .="</div>";
        mail($ne, "Смена почты", $message, $headers);
    }

    if (isset($_POST['but_feature']))
    {
            $feature = $_POST['feature'];
            mysqli_query($conn,"UPDATE `users_santa` SET `feature` = '$feature' WHERE `users_santa`.`unic_id` = '$unic_id'");
            $_SESSION['feature'] = $feature;
            echo 'Ваше пожелание было сохранено.';
            $message = "Ваше пожелание - $feature - было сохранено";
            $subject = 'Смена пожелания';
            mail($_SESSION['email'], $subject , $message , $headers);
            header("Location: lk");
    }

    $check_user = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM `users_santa` WHERE `unic_id` = $unic_id"));
    if($check_user == 0){
        header("Location: ../logout.php");
    }
    // var_dump($_SESSION);
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-0H52CVQETV"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-0H52CVQETV');
</script>
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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../img/icon2.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/style_lk.css?14">
    <title>Document</title>
</head>
<body style="background-color: black;">
<div class="header">
    <div class="ogr_header"> 
        <section style="display: inline-flex;">
            <a href = "myPage"><img width="64px" height="64px" src="../img/4043276_christmas_clous_santa_icon.png" alt="Выход"></a>
            <h1 class="text_gl">Личный кабинет <?=$_SESSION['name']?></h1>
        </section>
        </div>
    </div>
<?php
if($database_user['stutus'] == 'admin'){?>
    <a class="gradient-button" href="../admin/admin.php">Панель администратора</a>
<?php } ?>

<div class="selImg">
        <form action="" method="post">
    <?php 
        for($i=1;$i<=16;$i++){
    ?>
        <button class="icon_user" value="icon<?=$i?>.png" name="simg"><img src="../img/icon_user/icon<?=$i?>.png" alt=""></button>
    <?php }?>
    </form>
</div>  
                    <div class="my_info">
                          <p style="text-align: center;"><button class="img"><img  src="../img/icon_user/<?=$img?>" alt=""></button></p>
                          <p style="text-align: center;">Ваше имя <samp style="font-size: 1.5em;font-weight: bold;"><?= $database_user['name']?></samp></p>
                          <p style="text-align: center;">Ваша почта <samp style="font-size: 1.5em;font-weight: bold;"><?= $database_user['email']?></samp></p>
                          <p style="text-align: center;">Ваше желание <samp style="font-size: 1.5em;font-weight: bold;"><?= $database_user['feature']?></samp></p>
                          <p style="text-align: center;">Ваш id <samp style="font-size: 1.5em;font-weight: bold;"><?= $_SESSION['unic_id']?></samp></p>
                          <!-- <button style="padding:0;" value="&#128512;">&#128512;</button>
                          <button style="padding:0;" value="&#128515;">&#128515;</button>
                          <button style="padding:0;" value="&#128516;">&#128516;</button>
                          <button style="padding:0;" value="&#128513;">&#128513;</button>
                          <button style="padding:0;" value="&#128518;">&#128518;</button>
                          <button style="padding:0;" value="&#128517;">&#128517;</button>
                          <button style="padding:0;" value="&#128514;">&#128514;</button>
                          <button style="padding:0;" value="&#128578;">&#128578;</button>
                          <button style="padding:0;" value="&#128579;">&#128579;</button>
                          <button style="padding:0;" value="&#128521;">&#128521;</button> -->
                        <form style="margin: 0 auto;" action="" method="post"><button style="background-image: linear-gradient(to right, #9796d87d 0%, #c8def47a 130%, #c8def47a 100%);border: none;width: 64px;height: 64px;border-radius: 50%;border: 2px solid white;" name="style" value="page.css">Новый</button><button style="background-image: linear-gradient(to right, #4789c97d 0%, #c8def47a 130%, #c8def47a 100%);border: none;width: 64px;height: 64px;border-radius: 50%;margin-left: 2%;border: 2px solid white;" name="style" value="style_page.css">Старый</button></form>
                    </div>
           <div class="data">
                    <div class="div_name_change">
                    <p style="text-align: center;font-size: 20px;"><b>Сменить имя пользователя:</b></p>
                    <form style="text-align: left" action="" method="post"><p >Введите новое имя:<br><input type="text" class="inputs" name="new_name" required></p>
                    <p><button name="but_name">Сменить имя</button></p>
                    </form>
                    </div>
             
            
            <div class="div_pass_change">
                <form  style="text-align: left" method="post">
                    <p style="text-align: center;font-size: 20px;"><b>Сменить Пароль:</b></p>
                    <p >Введите действующий пароль:<br><input type="password" class="inputs" name="pass_now" required id="1"></p>
                    <p >Введите новый пароль:<br><input type="password" class="inputs" name="new_pass" required id="2"></p>
                    <p >Подтвердите новый пароль:<br><input type="password" class="inputs" name="new_pass_1" required id="3"></p>
                    <input class="chekbox_pas" type="checkbox" onclick="myFunction()">Показать пароль
                            <script>
                            function myFunction() {
                                var x = document.getElementById("1");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                                var x = document.getElementById("2");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                                var x = document.getElementById("3");
                                if (x.type === "password") {
                                    x.type = "text";
                                } else {
                                    x.type = "password";
                                }
                            }
                            </script></input>
                        <p><button name="but_pass">Сменить пароль</button></p>

                </form>
            </div> 

            <div class="div_email_change">
                <form  style="text-align: left;font-size: 20px;" action="" method="post">
                    <p style="text-align: center;"><b>Сменить адрес электронной почты:</b></p>
                    <p >Введите новый email:<br><input type="email" class="inputs" name="email_new" required></p>
                    <p><button name="but_kode_send">Подтвердить email</button></p>
                    </form>        
            </div>                     
        
            <div class="div_feature">
                <form style="text-align: left;font-size: 20px;" action="lk.php" method="post">
                    <p style="text-align: center;"><b>Изменить желание:</b></p>
                    <p >Введите его:<br><input type="text"  class="inputs" name="feature" required></p>
                    <p><button name="but_feature">Записать желание</button></p>
                </form>
            </div> 
            <br>
        </div>
    <script src="../js/jq.js"></script>
    <script src="../js/jSnow.js"></script>
    <script src="../js/main.js?1"></script>
    <script src="../js/metrika.js"></script>
    <!-- <script src="../js/opl.js"></script> -->
</body>
</html>