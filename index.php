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
        <li> <a href="\educom-webshop-basis/index.php?page=contact">Contact</a></li>
    </ul>
    </div>';
}
function showcontent($page){
    if ($page == "home") {
        include 'home.php';
    } elseif ($page == "about") {
        include 'about.php';
    } elseif ($page == "contact"){
        include 'contact.php';
    } else {
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
    $errors = array("address" =>"","name" =>"", "email"=>"", "phone_number" =>"", "comment" =>"", "com_pref" =>"");
    $valid = False;
    $thanks = False;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $address = clean_and_check_input("address");
        $name = clean_and_check_input("name");
        $email = clean_and_check_input("email");
        $phone_number = clean_and_check_input("phone_number");
        $comment = clean_and_check_input("comment");
        $com_pref = clean_and_check_input("com_pref");
        
        $valid = True;
        foreach($errors as $key => $error) {
            if ($error != ""){
                $valid = False;
                break;
            }
        }
        
        if ($valid) {
            $thanks = True;
            return "contact";
        } else {
            return "contact";
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
    $data = validate_specific_response($variable_name, $data);
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

$page = getRequestedPage();
showResponsePage($page)

?>