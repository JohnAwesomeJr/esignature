let iosDisplayBox = document.createElement('div');
iosDisplayBox.style.width = "100px";
iosDisplayBox.style.height = "100px";
iosDisplayBox.style.background = "red";
iosDisplayBox.style.position = "fixed";
iosDisplayBox.style.top = "0px";
iosDisplayBox.style.left = "50vw";
iosDisplayBox.style.border = "solid 5px black";





let base = document.body;
base.appendChild(iosDisplayBox);

let wh = "";
window.onload = function(){
wh = window.innerHeight;
iosDisplayBox.innerHTML = wh;

}

const all = document.getElementsByClassName('all')[0];
// all.style.height = "100vh";
const content = document.getElementsByClassName('pell-content')[0];
let heyboardHeight = 0;




windowHeight = window.innerHeight;
// iosDisplayBox.style.height = windowHeight + "px";

content.addEventListener('focus', (event) => {
    setTimeout(()=>{
        // window.scrollTo(0,document.body.scrollHeight);
        window.scrollTo(0,document.body.scrollHeight);
        let scrollPosition = window.scrollY;
        iosDisplayBox.innerHTML = scrollPosition;
        iosDisplayBox.style.height = scrollPosition + "px";
        iosDisplayBox.style.removeProperty('top');
        iosDisplayBox.style.bottom = "0px"
        window.scrollTo(0,0);
    },1000)




        // event.target.style.background = 'pink';
        // setTimeout(()=>{
        //     heyboardHeight = wh - y;
        //     windowHeight - y;
        //     keyheight = windowHeight - y ;
        //     negitiveTrueKeyHeight = keyheight - windowHeight;
        //     trueKeyHeight =  negitiveTrueKeyHeight *= -1;
        //     iosDisplayBox.innerHTML = trueKeyHeight;
        //     setTimeout(()=>{
        //         setTimeout(() => {
        //             iosDisplayBox.style.height = trueKeyHeight + "px";
        //         }, 500);
        //     },500)
        // },500)



  });