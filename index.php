<?php 

function showHTMLstart(){
    echo '<!DOCTYPE html>
    <html lang="en">';
}

function showHTMLend(){
    echo "</html>";
}
function showHeadSection(){
    echo '<head>
    <title>Home</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
    </head>';
}

function showBodySection($page){
    showBodyStart();
    showNavbar();
    showcontent($page);
    showFooter();
    showBodyEnd();
}

function showBodyStart(){
    echo '<body class="standard_body">';

}

function showNavbar(){
    echo '<div id="nav_bar">
    <ul>
        <li> <a href="\educom-webshop-basis/index.php?page=home">Home</a>  </li>
        <li> <a href="\educom-webshop-basis/index.php?page=about">About</a></li>
        <li> <a href="\educom-webshop-basis/index.php?page=contact">Contact</a></li>';

    if ($_SESSION["user_name"] == NULL){
        echo '<li> <a href="\educom-webshop-basis/index.php?page=register">Registeer</a></li>
        <li> <a href="\educom-webshop-basis/index.php?page=login">Login</a></li>';
    } else {
        echo
        '<li><form method="post" action="\educom-webshop-basis/index.php">
        <input type="hidden" name="form_name" value="logout">
        <button type="submit" formmethod="post">Loguit: '.$_SESSION["user_name"] .'</button>
        </form></li>';
    }
    echo '</ul>
    </div>';
}
function showcontent($page){
    if (file_exists($page . ".php"))
        include $page . ".php";
    else {
        echo "<h1> deze pagina bestaat niet </h1>";
    }
}


function showFooter(){
    echo '<footer  class="standard_footer"> 
    <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
    </footer>';
}

function showBodyEnd(){
    echo "</body>";
}

function showResponsePage($page){
    showHTMLstart();
    showHeadSection();
    showBodySection($page);
    showHTMLend();
}

function error_check(){
    global $errors;
    $valid = True;
    foreach($errors as $key => $error) {
        if ($error != ""){
            $valid = False;
            break;
        }
    }
    return $valid;
}

function handle_form_contact(){
    global $errors;
    global $name;
    global $email;
    global $phone_number;
    global $comment;
    global $address;
    global $thanks;
    global $errors;
    global $com_pref;
    $address = validate_specific_response("address", clean_and_check_input("address"));
    $name = validate_specific_response("name", clean_and_check_input("name"));
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $phone_number = validate_specific_response("phone_number", clean_and_check_input("phone_number"));
    $comment = validate_specific_response("comment", clean_and_check_input("comment"));
    $com_pref = validate_specific_response("com_pref", clean_and_check_input("com_pref"));
    
    if (error_check()) {
        $thanks = True;
        return "contact";
    } else {
        return "contact";
    }
}

function handle_form_register(){
    global $name;
    global $email;
    global $errors;
    global $password;
    $name = validate_specific_response("name", clean_and_check_input("name"));
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $password = validate_specific_response("password", clean_and_check_input("password"));
    $password_re = clean_and_check_input("password_re");
    
    if ($password != $password_re) {
        $errors["password"] = "Herhaalde wachtwoord komt niet over een.";
    }

    #check if email is already in use
    $login_file = fopen("data_text_files/logins.txt","r");
    fgets($login_file);
    while(!feof($login_file)) {
        $line = fgets($login_file);
        $line_seperated = explode("|",$line);
        if ($email == $line_seperated[0]){
            $errors["email"] = "Email is al in gebruik.";
        }
             
    }
    fclose($login_file);

    if (error_check()) {
        $login_file = fopen("data_text_files/logins.txt","a");
        fwrite($login_file,implode("|",array("\n" . $email, $name, $password)));
        fclose($login_file);

        return "login";
    } else {
        return "register";
    }


    return "register";
}

function handle_form_login(){
    global $email;
    global $errors;
    global $password;
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $password = validate_specific_response("password", clean_and_check_input("password"));

    
    if (error_check()) {
        $login_file = fopen("data_text_files/logins.txt","r");
        fgets($login_file);
        while(!feof($login_file)) {
        $line = fgets($login_file);
        $line = rtrim($line,"\n");
        $line_seperated = explode("|",$line);
        if ($email == $line_seperated[0]){
            if ($password == $line_seperated[2]){
                $_SESSION["user_name"] = $line_seperated[1];
                break;
            }
        }
        }
        fclose($login_file);
        return "home";
    } else {
        return "login";
    }
}
function handle_form_logout(){
    session_unset();
    $_SESSION["user_name"] = NULL;
    return "home";
}

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

function clean_and_check_input($variable_name) {
    # give errors to the missing variables
    if (empty($_POST[$variable_name])){
        $emty_error = "is verplicht";
        global $errors;
        $errors[$variable_name] = $emty_error;
        return "";
    } else {
        $data = $_POST[$variable_name];
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    
    return $data;
}

function validate_specific_response($variable_name, $data) {
    if ($variable_name == "phone_number") {
        #check if the input is a correct phonenumber by checking for letters, special signs are allowed
        if (preg_match("/[a-z]/i", $data)){
            global $errors;
            $errors[$variable_name] = "Incorrect telefoonnummer";
            return $data;
        }
    }
    return $data;
}
session_start();
$page = getRequestedPage();
showResponsePage($page)

?>