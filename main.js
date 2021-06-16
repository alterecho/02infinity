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
    contentDiv.innerHTML = 'Hello';
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
    const pagesDir = "."
    sideBarDiv.innerHTML = "<ul>\
        <li><a href='' onclick='loadMainPage()'>Home</a></li>\
        <li><a href=" + pagesDir + "/home.php" + ">Games</a></li>\
        <li><a href=" + pagesDir + "/articles.php" + ">Articles</a></li>\
        <li><a href=" + pagesDir + "/games.php" + ">Games</a></li>\
        <li><a href=" + pagesDir + "/apps.php" + ">Apps</a></li>\
        <li><a href=" + pagesDir + "/about.php" + ">About</a> (And get in touch)</li>\
    </ul>";
}

function onLoadBody() {
    addSideBar()
}