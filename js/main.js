$('.img').on("click", selectImg);
function selectImg(){
    $('.selImg').toggleClass('selImg_active');
}

function success_send()
{
alert("Ваши учетные данные обновлены :)");
}
function error_send()
{
alert("Произошла ошибка при обновлении учетных данных :(");
}
function qr(){
    let tp = 3;
    let text = 'https://www.youtube.com/watch?v=Kr6Pn4rr4Kk';
    let errorLevel ='L';
    let qrDiv = document.getElementsByClassName('qr');

    let qr1 = qrcode(tp, errorLevel);

    qr1.addData(text);
    qr1.make();
    qrDiv.innerHTML = qr1.createSvgTag(8, 10);
}
qr();
