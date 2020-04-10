<?php
function hehe(){
    return "help";
}
function route_class()
{
    return str_replace('.', '-', Route::currentRouteName());
}