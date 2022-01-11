
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
    if (insideInput == "") {
        alert('please input a value');
    } else {
        createElement(placeTagIn, insideInput, "tag");
        document.getElementById('tagInput').value = "";
    }
}

function addNewTitle() {
    let insideInput = document.querySelector('#titleInput').value;
    if (insideInput == "") {
        alert('please input a value');
    } else {
        createElement(placeTitleIn, insideInput, "title");
        document.getElementById('titleInput').value = "";
    }
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
    newElement.className = "centerColumn dbListItem customCard";
    spawnLocation.appendChild(newElement);

    // create text
    let Text = document.createElement('div');
    Text.innerHTML = "Tag: " + tagName;
    newElement.appendChild(Text);




    // button holder
    let buttonHolder = document.createElement('div');
    buttonHolder.className = "centerRow";
    newElement.appendChild(buttonHolder);


    // create insert button div
    let button = document.createElement('div');
    button.style.padding = "10px 30px";
    button.style.margin = "30px";
    button.className = className + " button";
    button.innerHTML = "Insert";
    button.setAttribute("onclick", `insertTextAtCursor(el, "${tagName}")`);
    buttonHolder.appendChild(button);

    // create remove button div
    let remove = document.createElement('div');
    remove.style.padding = "10px 30px";
    remove.style.margin = "30px";
    remove.className = " button";
    remove.innerHTML = "Delete";
    remove.setAttribute("onclick", `{alert('flag for delete');}`);
    buttonHolder.appendChild(remove);




    let jasonHolder = document.createElement('div');
    jasonHolder.className = "jasonHolder";
    jasonHolder.style.border = "solid black 1px";
    newElement.appendChild(jasonHolder);






    let tagId = document.createElement('input');
    tagId.name = listName + "[" + i + "]['tagId']"
    tagId.value = justTagId;
    tagId.readOnly = true;
    jasonHolder.appendChild(tagId);


    let parentTemplate = document.createElement('input');
    parentTemplate.name = listName + "[" + i + "]['parentTemplate']"
    parentTemplate.value = templateNumber;
    parentTemplate.readOnly = true;
    jasonHolder.appendChild(parentTemplate);



    let tagNamedb = document.createElement('input');
    tagNamedb.name = listName + "[" + i + "]['name']"
    tagNamedb.value = justName;
    tagNamedb.readOnly = true;
    jasonHolder.appendChild(tagNamedb);

}




function getTagList() {

    let tagList = document.getElementsByClassName('screen3')[0].getElementsByTagName('input');

    for (i = 0; i < tagList.length; i++) {
        console.log(tagList[i]);
    }
}

getTagList();

