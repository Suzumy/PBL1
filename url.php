<?php
    function url_param_change($par=Array(),$op=0){
        $url = parse_url($_SERVER["REQUEST_URI"]);
        if(isset($url["query"])) parse_str($url["query"],$query);
        else $query = Array();
        foreach($par as $key => $value){
            if($key && is_null($value)) unset($query[$key]);
            else $query[$key] = $value;
        }
        $query = str_replace("=&", "&", http_build_query($query));
        $query = preg_replace("/=$/", "", $query);
        return $query ? (!$op ? "?" : "").htmlspecialchars($query, ENT_QUOTES) : "";
    }
?>