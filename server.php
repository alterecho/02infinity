<?php
require_once("response.php");

$db_host = "localhost:3306";
$db_user = "root";
$db_pass = "01234567";
$db_name = "1stdb";

function printConsole($op) {
    if (is_array($op)) {
        $op = implode(", ", $op);
    }
    echo "<script>console.log('$op')</script>";
}



class Article extends JSONArrayResponse {
    private $key_title = "title";
    private $key_url = "url";
    private $key_date = "date";

    function __construct($fetchResult)
    {
        $this->title = $fetchResult[$this->key_title];
        $this->url = $fetchResult[$this->key_url];
        $this->date = $fetchResult[$this->key_date];
        $array = $this->json();
        parent::__construct($array);
    }

    function __toString()
    {
        $string = "Article: \n";
        $string .= "title: $this->title\nurl: $this->url\ndate: $this->date";
        return $string;
    }

    function json()
    {
        $array = array(
            $this->key_title => $this->title,
            $this->key_url => $this->key_url,
            $this->key_date => $this->key_date
        );
        return json_encode($array);
    }
}

// header('Content-type: application/json');

class KEY {
    public static $isDebugging = "isDebugging";
    public static $query = "query";
    public static $query_articles = "articles";         
}

// $qry = get($key);
$isDebugging = false;

if (array_key_exists(KEY::$isDebugging, $_GET)) {
    $isDebugging = true;
}

if (array_key_exists(KEY::$query, $_GET)) {    
    if ($_GET[KEY::$query] == KEY::$query_articles) {
        if ($isDebugging) {
            $response = getArticles_STUB();
        } else {
            $response = getArticles();
        }
    }
}

if (isset($response)) {
    echo $response;
}


function get($key)
{
    print('getting ' . $key);
    if (array_key_exists($key, $_GET)) {
        echo "exists";
        print("exists p:");
        return $_GET[$key];
    } else {
        echo "return null";
        return  null;
    }
}

function printAllGET()
{
    echo "\nALL GET:";
    foreach ($_GET as $key => $value) {

        echo "key: " . $key . ", value: " . $value;
    }
}

function printAllPOST()
{
    foreach ($_POST as $key => $value) {
        echo "\nALL POST:";
        print "key: " . $key . ", value: " . $value;
    }
}

// $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

// if (!$conn) {
//     die("CONN ERROR $conn");
// } else {
//     echo("conn success!");
// }

// $query = "select * from articles";
// $res = mysqli_query($conn, $query);
// $numberOfRows = mysqli_num_rows($res);
// echo("number of Rows: $numberOfRows");
// if ($numberOfRows > 0) {
//     while ($fetch_res = mysqli_fetch_assoc($res)) {
//         $article = new Article($fetch_res);
//         foreach ($fetch_res as $key => $value) {
//             // echo "\n$key => $value";
//         }
//         echo "\narticle: $article: ";
//     }
// }
// mysqli_close(($conn));

function getArticles_STUB() {
    $articles = array();

    for ($i = 0; $i < 10; $i++) {
        $article = new Article(array(
            "title" => "article $i", "url" => "google.com/$i", "date" => "sdd/$i"
        ));
        array_push($articles, $article);
    }
    $jsonsArrayResponse = new JSONListResponse($articles);
    return $jsonsArrayResponse->response();
}

function getArticles()
{
    global $db_host, $db_user, $db_pass, $db_name;
    $conn = new mysqli($db_host, $db_user, $db_pass, $db_name);
    if ($conn->connect_error) {
        die("Error connecting to db\n" . $conn->connect_error);
    }

    // print $conn->host_info;


    $articles = array();
    $query = "SELECT * FROM ARTICLES";
    $result = $conn->query($query);
    while ($row = $result->fetch_assoc()) {
        $article =  new Article($row);
        array_push($articles, $article);
    }

    foreach ($articles as $article) {
        // print("$article");
    }

    $conn->close();

    $jsonsArrayResponse = new JSONListResponse($articles);
    return $jsonsArrayResponse->response();
}
