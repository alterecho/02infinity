<?php
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
?>