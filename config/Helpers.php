<?php

function dd($param){

    echo '<pre>';
    var_dump($param);
    echo '</pre>';
    die();
}