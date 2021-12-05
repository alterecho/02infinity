<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html class="fullheight">
    <head>
        <title>We are infinity</title>
        <?php require('headers.php'); ?>
        <script src="articles.js"></script>
    </head>
    <body class="fullHeight" onload="currentPage.onLoad()">
        <div id="sideNavBar">

        </div>
        <div id="mainContent">
            <div id="page-title">Learn</div>
            <p>Learn something you may not know, and interests you...</p>
            <!-- <p> -->
            <div id="list-articles">

            </div>
            <!-- </p> -->
        </div>

<script>
    const url = "http://localhost:8000/server.php";
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.onload = () => {
        console.log("onLoad");
        console.log("xhr.response", xhr.response);
    }

    xhr.onerror = () => {
        console.log("error")
    }
    xhr.send();
</script>

    </body>
</html>