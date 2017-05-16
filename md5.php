<?php
        //$salt='pigcmso2oCashier';
        //$str=md5(md5('123456'.'_'.$salt).$salt);
        //echo $str;
        $url = "https://yunbi.com/api/v2/tickers.json";
        $data = file_get_contents($url);
       // $data = json_decode($data, true);
        var_dump($data);
?>