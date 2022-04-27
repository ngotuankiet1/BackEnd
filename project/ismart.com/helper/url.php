<?php

use WindowsAzure\ServiceManagement\Models\Location;

function base_url($url = "")
{
    global $config;
    return $config['base_url'] . $url;
}

function redirect_to($url){
    if(!empty($url)){
        header("location: {$url}");
    }
}
