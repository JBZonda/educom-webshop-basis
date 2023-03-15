<?php 

function getRequestedPage(){
    # make variables and their errors in an array
    global $errors;
    global $name;
    global $email;
    global $phone_number;
    global $comment;
    global $address;
    global $thanks;
    global $errors;
    global $com_pref;
    $address = $name = $email = $phone_number = $comment = $com_pref= "";
    $errors = array("address" =>"","name" =>"", "email"=>"", "phone_number" =>"", "comment" =>"", "com_pref" =>"", "password"=>"", "login" =>"");
    $valid = False;
    $thanks = False;
    #handle each form from the POST request
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST["form_name"] == "contact"){
            return handle_form_contact();
        } elseif ($_POST["form_name"] == "register"){
            return handle_form_register();
        } elseif ($_POST["form_name"] == "login"){
            return handle_form_login();
        } elseif ($_POST["form_name"] == "logout"){
            return handle_form_logout();
        } else {
            return "home";
        }

    } elseif ($_SERVER["REQUEST_METHOD"] == "GET") {
        return $_GET["page"];
    }
}

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
showResponsePage($page)

?>