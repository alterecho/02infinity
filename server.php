<?php

$key = "qry";
$key = null;
$qry = get($key);

$data = [ "h", 'e', 'l', ' l', 'o' ];

// $data = [ 'name' => 'God', 'age' => -1 ];

header('Content-type: application/json');
echo json_encode( $data );

function get($key) {
    return array_key_exists($key, $_GET) ? $_GET[$key] : null;
}

?>