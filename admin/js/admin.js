$('.zadachi').on("click", selectImg);
$('.usesrs').on("click", showUsers);
$('.rooms').on("click", showRooms);
function selectImg(){
    $('.zadachi').toggleClass('open');
    $.post(
        "php/core.php",{ 
        "action" : "showZad",
    },
    function(data){
        data = JSON.parse(data);
        out='';
        out+='<form action="" method="post">';
        out+='<textarea name="vv" id="" cols="30" rows="10"></textarea><button name="add">Добавить</button>';
        out+='</form>';
        out+='<div class="res">';
        for(var id in data){
            if(data[id].finish == 1){
                out+='<div  style="background-color:#10C95A;border:border: 0.5px solid grey;">';
            }else
            if((data[id].work==1) && (data[id].priority==1)){
                out+='<div style="background-color:#0781D9;border:border: 0.5px solid grey;">';
            }else if(data[id].work==1){
                out+='<div  style="background-color:#0781D9;border:border: 0.5px solid grey;">';
            } else
            if(data[id].priority==1){
                out+='<div  style="background-color:#FAAD01;border:border: 0.5px solid grey;">';
            }
            else{
                out+='<div style="background-color:blanchedalmond;border:border: 0.5px solid grey;">';
            }
            
            if(data[id].finish == 0){
                out+=`<h1>${data[id].text}</h1>`;
                if(data[id].name !== ''){out+=`<h3>Делает: ${data[id].name}</h3>`;}
                out+=`<form action="" method="post"><button name="prio" value="${id}">Приоритет</button></form>`;
                out+=`<form action="" method="post">
                <input type="hidden" name="name" value="${data["us"]}">
                <button name="work" value="${id}">В работу</button></form>`;
                out+=`<form action="" method="post"><button name="finish" value="${id}">Завершить</button></form>`;
            }else if(data[id].finish == 1){
                out+=`<h1 style=" text-decoration: line-through;">${data[id].text}</h1>`;
            }
            out+='</div>';
            
        }
        out+='</div>';
        console.table(data);
        $('.content').html(out);
    });
}
function showUsers(){
    $('.usesrs').toggleClass('open');
    $.post(
        "php/core.php",{ 
        "action" : "showUsers",
    },
    function(data){
        data = JSON.parse(data);
        out='<div class="res">';
        out+='<input type="text" name="search" value=""><button>Найти</button>';
        for(var id in data){
            out+='<div>';
            
                out+=`<h1>${data[id].unic_id}</h1>`;
                out+=`<h1>${data[id].name}</h1>`;
                out+=`<h2>${data[id].email}</h2>`;
                out+=`<h2>${data[id].password}</h2>`;

                out+=`<form method="post"><button name="admin">Сделать админом</button></form>`;
            
            out+='</div>';
        }
        out+='</div>';
        $('.content').html(out);
    });
}
function showRooms(){
    $('.rooms').toggleClass('open');
    $.post(
        "php/core.php",{ 
        "action" : "showRooms",
    },
    function(data){
        data = JSON.parse(data);
        out='<div class="res">';
        for(var id in data){
            out+='<div>';
            
                out+=`<h1>${data[id].unic_id_room}</h1>`;
                out+=`<h1>${data[id].name_room}</h1>`;
                out+=`<h2>${data[id].user0}</h2>`;
            
            out+='</div>';
        }
        out+='</div>';
        $('.content').html(out);
    });
}
document.addEventListener("DOMContentLoaded", function() {
    selectImg
  });