function loadMain() {
    console.log("llogging oadMain")
}

function loadPage(page, divID){
    console.log("loadPage ", page, divID);
    var contentDiv = document.getElementById(divID)
    // var xhr = new XMLHttpRequest();
    // 
    // xhr.onreadystatechange = function() {
    //     if (xhr.readyState == 4 && xhr.status == 200) {
    //         contentDiv.innerHTML = xhr.responseText
    //     }
    // }
    // // xhr.open("GET", "../html/pages/HTMLModElement.html", true)
    // xhr.open("GET", page, true)
    // xhr.send(null);
    contentDiv.innerHTML = '<object type="text/html" data=' + page +'></object>';
    // contentDiv.innerHTML = '<object type="text/html" data="html/pages/home.html"></object>';
    // contentDiv.innerHTML = 'Hello';
    console.log(contentDiv)
}

function loadMainPage() {
    loadPage("html/pages/home.html", "content")
}

function loadGamesPage() {

}

function loadAppsPage() {

}

function loadArticlesPage() {

}

function loadAboutPage() {

}

function addSideBar() {
    console.log("addSideBar")
    const sideBarDiv = document.getElementById("sideNavBar");
    const htmlDir = "html"
    const pagesDir = htmlDir + "/pages"
    sideBarDiv.innerHTML = "<ul>\
        <li><a href=" + pagesDir + "/home.php" + " onclick='loadMainPage()'>Home</a></li>\
        <li><a href=" + pagesDir + "/home.php" + " onclick='loadGamesPage()'>Games</a></li>\
        <li><a href=" + pagesDir + "/home.php" + " onclick='loadAppsPage()'>Apps</a></li>\
        <li><a href=" + pagesDir + "/home.php" + " onclick='loadArticlesPage()'>Articles</a></li>\
        <li><a href=" + pagesDir + "/home.php" + " onclick='loadAboutPage()'>About</a> (And get in touch)</li>\
    </ul>";
}

function onLoadBody() {
    addSideBar()
}