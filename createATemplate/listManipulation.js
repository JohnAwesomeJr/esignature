
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
    newElement.id = listName + i;
    newElement.className = " margin dbListItem shadow flexColumn xFlexCenter yFlexSpaceBetweenY";
    newElement.style = "width:500px; max-width:400px; height:200px; border-radius:15px; padding:30px; background:#ffffff;"
    spawnLocation.appendChild(newElement);

    // create text
    let Text = document.createElement('div');
    Text.innerHTML = "Tag: " + tagName;
    Text.className = ""
    Text.style = "font-size:20px; width:fit-content;";
    newElement.appendChild(Text);




    // button holder
    let buttonHolder = document.createElement('div');
    buttonHolder.className = " flexRow xFlexCenter yFlexSpaceEvenlyY";
    newElement.appendChild(buttonHolder);


    // create insert button div
    let button = document.createElement('div');
    button.style.padding = "10px 30px";
    button.className = className + " button";
    button.innerHTML = "Insert";
    button.setAttribute("onclick", `insertTags("${tagName}")`);
    buttonHolder.appendChild(button);





    // create remove button div
    let remove = document.createElement('div');
    remove.style.padding = "10px 30px";
    remove.className = " button";
    remove.innerHTML = "Delete";
    if (justTagId == "none") {
        remove.setAttribute("onclick", `{deleteFlagNewItem("` + listName + i + `");}`);
    } else {
        remove.setAttribute("onclick", `{deleteFlag("` + listName + i + `");}`);
    }
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


    let deleteFlag = document.createElement('input');
    deleteFlag.name = listName + "[" + i + "]['deleteFlag']"
    deleteFlag.id = "deleteing" + listName + i;
    deleteFlag.value = "0";
    // deleteFlag.readOnly = true;
    jasonHolder.appendChild(deleteFlag);

}




function getTagList() {
    let tagList = document.getElementsByClassName('screen3')[0].getElementsByTagName('input');

    for (i = 0; i < tagList.length; i++) {
    }
}

function deleteFlag(flagNumber) {
    deleteFlagId = "deleteing" + flagNumber;
    document.getElementById(deleteFlagId).value = 1;
    document.getElementById(deleteFlagId).setAttribute("value", 1);
    document.getElementById(flagNumber).style.display = "none";


}

function deleteFlagNewItem(flagNumber) {
    // alert('still working on this feature');
    removeElement = document.getElementById(flagNumber);
    deleteFlagId = removeElement.parentNode.removeChild(removeElement);
}


getTagList();





function slideOutTags() {
    let tagsScreen = document.getElementsByClassName('screen3')[0];

    tagsScreen.style.right = "-500px";
    tagsScreen.style.width = "100px";
}

function slideInTags() {
    let tagsScreen = document.getElementsByClassName('screen3')[0];

    tagsScreen.style.right = "0";
    tagsScreen.style.width = "500px";
}




function slideOutTitles() {
    let titlesScreen = document.getElementsByClassName('screen2')[0];

    titlesScreen.style.right = "-500px";
    titlesScreen.style.width = "100px";
}

function slideInTitles() {
    let titlesScreen = document.getElementsByClassName('screen2')[0];

    titlesScreen.style.right = "0";
    titlesScreen.style.width = "500px";
}



let curserPosition = 0;
let textArea = document.querySelector('.pell-content');
let focuseStatus = 1;

textArea.focus();
function getFocusPosition() {
    curserPosition = getCaretIndex(textArea);
    console.log(curserPosition);

}
setInterval(() => {
    if (focuseStatus == 1) {
        getFocusPosition();
    }
}, 300);



// find the caret position
function getCaretIndex(element) {
    let position = 0;
    const isSupported = typeof window.getSelection !== "undefined";
    if (isSupported) {
        const selection = window.getSelection();
        if (selection.rangeCount !== 0) {
            const range = window.getSelection().getRangeAt(0);
            const preCaretRange = range.cloneRange();
            preCaretRange.selectNodeContents(element);
            preCaretRange.setEnd(range.endContainer, range.endOffset);
            position = preCaretRange.toString().length;
        }
    }
    return position;
}
// find the caret position




// Check if the text edit window is in focus
textArea.addEventListener('focus', function () {
    this.classList.add('is-focused');
    focuseStatus = 1;
    console.log("focus status: " + focuseStatus);

});

textArea.addEventListener('blur', function () {
    this.classList.remove('is-focused');
    focuseStatus = 0;
    console.log("focus status: " + focuseStatus);
});
// Check if the text edit window is in focus




// inser the tag at the cursur position
function insertTags(tagName) {
    // textArea.focus();
    setCursor(1);
    insertTextAtCursor(el, tagName)
}
// inser the tag at the cursur position






function setCursor(pos) {
    var myEl = document.getElementsByClassName("pell-content")[0];


    myEl.onfocus = e => {
        var sel = window.getSelection()
        var selected_node = sel.anchorNode
        // selected_node is the text node
        // that is inside the div
        sel.collapse(selected_node, 3)
    }
}








