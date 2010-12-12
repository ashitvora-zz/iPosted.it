<?php

function is_logged_in(){
    return isset( $_SESSION["logged_in_user"] );
}


function logged_in_user(){
    return is_logged_in() ? $_SESSION["logged+in_user"] : null;
}