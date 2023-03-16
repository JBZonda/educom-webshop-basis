<?php 
include "html_build_functions.php";
include "form_handle_functins.php";
session_start();
#create session variables on first load
if ($_SESSION == array()){
    $_SESSION["user_name"] = NULL;
    $_SESSION["user_email"] = NULL;
}
#handle the request and return the page to be loaded
$page = getRequestedPage();
$data = process_Request($page);
showResponsePage($data);

function getRequestedPage(){
    #handle each form from the POST request
    if (is_POST()) {
        return $_POST['page'];
    }

    return $_GET["page"];
    
}

function process_Request($page){
    $data = array("page"=>$page,"errors"=>array());
    switch ($page){
        case "home":
            break;
        case "about":
            break;
        case "contact":
            if (is_POST()){
                $data = handle_form_contact($data);
            }
            break;
        case "register":
            if (is_POST()){
                $data = handle_form_register($data);
            } 
            break;
        case "login":
            if (is_POST()){
                $data = handle_form_login($data);
            }
            break;
        case "logout":
            $data = logout_user($data);
            break;
    }
    return $data;
}
function is_POST(){
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        return TRUE;
    } else {
        return FALSE;
    }
}




?>