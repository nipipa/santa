imgs = [
    'back1',
    'back2',
    'back3', 
    ];
    setInterval(function(){
        img = 'back1';
        img = imgs[Math.floor(Math.random()*imgs.length)];

        // $('.img').attr('src', img);
        $('.auth_back').toggleClass(img);
    }, 10000);

    $('.list1').on("click", help1);
    function help1(){
            $('.down_list1').toggleClass('down_list1_act');
            $('.g1').toggleClass('active_g');
            window.scrollTo(0, -100);
    }

    $('.list2').on("click", help2);
    function help2(){
            $('.down_list2').toggleClass('down_list2_act');
            $('.g2').toggleClass('active_g');
    }

    $('.list3').on("click", help3);
    function help3(){
            $('.down_list3').toggleClass('down_list3_act');
            $('.g3').toggleClass('active_g');
    }

    $('.list4').on("click", help4);
    function help4(){
            $('.down_list4').toggleClass('down_list4_act');
            $('.g4').toggleClass('active_g');
    }
    