
const urlSearchParams = new URLSearchParams(window.location.search);
const params = Object.fromEntries(urlSearchParams.entries());
const templateNumber = params['templateNumber'];





var placeTagIn = document.getElementsByClassName('screen3')[0].getElementsByClassName('list')[0];
for (i = 0; i < tagsArray.length; i++) {
    let name = tagsArray[i]['tagName'];
    createElement(placeTagIn, tagsArray, "tag");
}


var placeTitleIn = document.getElementsByClassName('screen2')[0].getElementsByClassName('list')[0];
for (i = 0; i < titlessArray.length; i++) {
    let titleName = titlessArray[i]['titleName'];
    createElement(placeTitleIn, titlessArray, "title");
}







function addNewTag() {
    let insideInput = document.querySelector('#tagInput').value;
    createElement(placeTagIn, insideInput, "tag");
    document.getElementById('tagInput').value = "";
}

function addNewTitle() {
    let insideInput = document.querySelector('#titleInput').value;
    createElement(placeTitleIn, insideInput, "title");
    document.getElementById('titleInput').value = "";
}





function createElement(spawnLocation, name, listName) {
    let justName = "";
    let justTagId = "";
    let justParentTemplateNumber = "";

    if (Array.isArray(name)) {
        console.log('yoink');
        justName = name[i][2];
        justTagId = name[i][0];
        justParentTemplateNumber = name[i][1];

    } else {
        name = [[0, 0, 0], [0, 0, 0], [0, 0, name]];
        justName = name[2][2];
        justTagId = "none";
        justParentTemplateNumber = name[0][1];
        i = spawnLocation.getElementsByClassName('dbListItem').length;


    }




    let className = "tagDiv" + i;
    let tagName = " {[ " + justName + " ]} ";



    // create containing div
    let newElement = document.createElement('div');
    newElement.style.padding = "10px 30px";
    newElement.style.border = "solid black 1px";
    newElement.className = "centerRow dbListItem";
    spawnLocation.appendChild(newElement);

    // create text
    let Text = document.createElement('div');
    Text.innerHTML = "Tag: " + tagName;
    newElement.appendChild(Text);

    // create insert button div
    let button = document.createElement('div');
    button.style.padding = "10px 30px";
    button.className = className + " button";
    button.innerHTML = "Insert";
    button.setAttribute("onclick", `insertTextAtCursor(el, "${tagName}")`);
    newElement.appendChild(button);

    // create remove button div
    let remove = document.createElement('div');
    remove.style.padding = "10px 30px";
    remove.className = " button";
    remove.innerHTML = "Delete";
    remove.setAttribute("onclick", `{alert('flag for delete');}`);
    newElement.appendChild(remove);




    let jasonHolder = document.createElement('div');
    jasonHolder.className = "jasonHolder";
    jasonHolder.style.border = "solid black 1px";
    newElement.appendChild(jasonHolder);






    let tagId = document.createElement('input');
    tagId.name = listName + "[" + i + "]['tagId']"
    tagId.value = justTagId;
    jasonHolder.appendChild(tagId);


    let parentTemplate = document.createElement('input');
    parentTemplate.name = listName + "[" + i + "]['parentTemplate']"
    parentTemplate.value = templateNumber;
    jasonHolder.appendChild(parentTemplate);



    let tagNamedb = document.createElement('input');
    tagNamedb.name = listName + "[" + i + "]['name']"
    tagNamedb.value = justName;
    jasonHolder.appendChild(tagNamedb);

}




function getTagList() {

    let tagList = document.getElementsByClassName('screen3')[0].getElementsByTagName('input');

    for (i = 0; i < tagList.length; i++) {
        console.log(tagList[i]);
    }
}

getTagList();

