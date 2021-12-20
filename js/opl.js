let xhttp = new XMLHttpRequest();

xhttp.onreadystatechange = function (){
    if(this.readyState == 4 && this.status ==200){
        myFunction(this.responseText)
    }
}

xhttp.open("GET", "https://tuilapps.github.io/EQTI/product.html");
xhttp.send();

function myFunction(data){
    console.log(data);
    $('.oplata').html(data);

}