






var placeTagIn = document.getElementsByClassName('screen3')[0].getElementsByClassName('list')[0];
for (i = 0; i < tagsArray.length; i++) {
    let name = tagsArray[i]['tagName'];
    createElement(placeTagIn, tagsArray);
}


var placeTitleIn = document.getElementsByClassName('screen2')[0].getElementsByClassName('list')[0];
for (i = 0; i < titlessArray.length; i++) {
    let titleName = titlessArray[i]['titleName'];
    createElement(placeTitleIn, titlessArray);
}







function addNewTag() {
    let insideInput = document.querySelector('#tagInput').value;
    createElement(placeTagIn, insideInput);
    document.getElementById('tagInput').value = "";
}

function addNewTitle() {
    let insideInput = document.querySelector('#titleInput').value;
    createElement(placeTitleIn, insideInput);
    document.getElementById('titleInput').value = "";
}





function createElement(spawnLocation, name) {
    if (Array.isArray(name)) {
        console.log("array");
    } else {
        console.log('nope');
        name = [[0, 0, 0], [0, 0, 0], [0, 0, name]];
    }

    console.log(name);



    let className = "tagDiv" + i;
    let tagName = " {[ " + name[i][2] + " ]} ";



    // create containing div
    let newElement = document.createElement('div');
    newElement.style.padding = "10px 30px";
    newElement.style.border = "solid black 1px";
    newElement.className = "centerRow";
    spawnLocation.appendChild(newElement);

    // create text
    let Text = document.createElement('div');
    Text.innerHTML = "Tag: " + tagName;
    newElement.appendChild(Text);

    // create insert button div
    let button = document.createElement('button');
    button.style.padding = "10px 30px";
    button.className = className + " button";
    button.innerHTML = "Insert";
    button.setAttribute("onclick", `insertTextAtCursor(el, "${tagName}")`);
    newElement.appendChild(button);

    // create remove button div
    let remove = document.createElement('button');
    remove.style.padding = "10px 30px";
    remove.className = " button";
    remove.innerHTML = "Delete";
    remove.setAttribute("onclick", `{alert('flag for delete');}`);
    newElement.appendChild(remove);



    let tagId = document.createElement('div');
    tagId.className = "jason";
    tagId.innerHTML = "tagId: " + "mike";
    newElement.appendChild(tagId);




    let parentTemplate = document.createElement('parentTemplate');
    let tagNamedb = document.createElement('tagNamedb');


}


