let arr = ['a', 'e', 'i', 'o', 'u', 1, 2, 3, 4, 5, 6, 7, 8, 9, 0];
            const arrLen = arr.length;
            
let validation = document.getElementById('validation');
let submit = document.getElementById('submit');
let captcha = document.getElementById('captcha');
let ctx = captcha.getContext("2d");
ctx.font = "4rem sans-serif";
ctx.fillStyle = "#fff"; // "#08e5ff"; //

let buttonVal = document.getElementById('buttonVal');

function stringGenerator(){
    let test = "";
    let len = 6;
    while(len){
        let index = Math.floor(Math.random()*arrLen);
        test += arr[index];
        len--;
    }
    return test;
}
let captchaText = stringGenerator();
ctx.clearRect(0, 0, captcha.width, captcha.height);
ctx.fillText(captchaText, captcha.width/6, captcha.height/1.6);

buttonVal.addEventListener('click', function() {
    let temp = validation.value;
    // console.log(temp);
    if( temp === captchaText){
        submit.removeAttribute('disabled');
    } else {
        submit.setAttribute('disabled', true);
        captchaText = stringGenerator();
        ctx.clearRect(0, 0, captcha.width, captcha.height);
        ctx.fillText(captchaText, captcha.width/6, captcha.height/1.6);
    }
});