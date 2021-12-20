<html>
    <head>
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
    </head>
</html>
<?php
    include 'mysql.php';
    session_start();
    $name = trim($_POST['name']);
    $email= $_POST['email']; 
    $pass =  md5($_POST['password']);

        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {    
            $result=mysqli_query($conn,"SELECT * FROM users_santa WHERE  `email` = '$email' AND `password` = '$pass'");
            $row = mysqli_fetch_array($result);
                if ($row['email'] == $email && $row['password'] == $pass)
                    {
                                $_SESSION['name'] = $row['name'];
                                $_SESSION['email'] = $row['email'];
                                $_SESSION['password'] = $row['password'];
                                $_SESSION['unic_id'] = $row['unic_id'];
                               exit("<meta http-equiv='refresh' content='0; url= myPage'>");
                        
                    }
    }
?> 