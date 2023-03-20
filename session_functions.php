<?php

function session_initialize(){
    if ($_SESSION == array()){
        $_SESSION["user_name"] = NULL;
        $_SESSION["user_email"] = NULL;
    }
}
function login_user($email,$name){
    $_SESSION["user_email"] = $email;
    $_SESSION["user_name"] = $name;
    
}

function logout_user(){
    session_unset();
    session_initialize();
}

?>