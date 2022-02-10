
setInterval(() => {
    let newWinHeight = window.visualViewport.height;
    
    let container = document.getElementById('container1');
    container.style.height = newWinHeight + "px";
    container.style.position = "fixed";
    container.style.top = "0px";
    container.style.left = "0px";
    
    
    let input = document.getElementById('formBox');
    input.style.removeProperty('top');
    input.style.removeProperty('bottom');
    input.style.position = "absolute";
    input.style.bottom = "0px";
    input.style.right = "0px";


    window.scrollTo(0, 0);


}, 1100);