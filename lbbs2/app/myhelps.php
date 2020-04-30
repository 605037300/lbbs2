<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


function nav_active($categoryid){
    return active_class(if_route('categories.show')&&if_route_param('category',$categoryid));
}


function make_excerpt($text,$len=200){
    $excerpt=preg_replace('/\r\n|\r|\n+/',' ',strip_tags($text));
    return Str::limit($excerpt,$len);
}