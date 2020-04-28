<?php

function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}


function nav_active($categoryid){
    return active_class(if_route('categories.show')&&if_route_param('category',$categoryid));
}