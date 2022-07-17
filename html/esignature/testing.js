
setInterval(() => {
    let newWinHeight = window.visualViewport.height;

    let container = document.getElementById('container1');
    container.style.height = newWinHeight + "px";
    
    window.scrollTo(0, 0);


}, 10);

document.getElementById('box').addEventListener('click',()=>{alert('you clicked');})