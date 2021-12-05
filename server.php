<?php
$db_host = "localhost:3306";
$db_user = "root";
$db_pass = "01234567";
$db_name = "1stdb";

abstract class Response {

}

class ArrayResponse extends Response {
    protected $data = array();

    function __construct($array) {
        $this->data = $array;
    }

    function response() {
        return $this->data;
    }
}

class JSONArrayResponse extends ArrayResponse {
    function response() {
        $json = json_encode($this->data);
        return $json;
    }
}

class ListResponse {
    protected $key_count = "count";
    protected $key_data = "data";

    protected $count = 0;
    protected $data = array();

    function __construct($data_array) {
        $this->count = count($data_array);
        $this->data = $data_array;
    }

    function response() {
        return array(
            $this->key_count => $this->count,
            $this->key_data => $this->data
        );
    }
}

class JSONListResponse extends ListResponse {
    // function __construct($array) {
    //     parent::__construct($array);
    // }
    function response() {
        $response = parent::response();
        return json_encode($response);
    }
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

header('Content-type: application/json');

$key_query = "query";
$query_articles = "articles";
// $qry = get($key);

if (array_key_exists($key_query, $_GET)) {
    if ($_GET[$key_query] == $query_articles) {
        $response = getArticles();
    }
}

echo $response;

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
