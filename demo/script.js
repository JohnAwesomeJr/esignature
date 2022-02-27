
let visableSpace = 0;
let container = document.getElementById('container');

setInterval(()=>{
    let visableSpace = window.visualViewport.height;
    container.style.height = visableSpace + "px";
    window.scrollTo(0,0);
    
},1);

