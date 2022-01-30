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


setInterval(()=>{
    wh = window.innerHeight;
    iosDisplayBox.innerHTML = wh;
    iosDisplayBox.style.height = "100";

    window.scrollTo({ top: 0, behavior: 'smooth' })
    
},100)

