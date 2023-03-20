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

function showBodyStart(){
    echo '<body class="standard_body">';

}

function showNavbar($data){
    echo '<div id="nav_bar">
    <ul>
        <li> <a href="\educom-webshop-basis/index.php?page=home">Home</a></li>
        <li> <a href="\educom-webshop-basis/index.php?page=about">About</a></li>
        <li> <a href="\educom-webshop-basis/index.php?page=contact">Contact</a></li>';

    #show a register and login or a loguit option depending on if the user is loged in
    if ($_SESSION["user_name"] == NULL){
        echo '<li> <a href="\educom-webshop-basis/index.php?page=register">Registeer</a></li>
        <li> <a href="\educom-webshop-basis/index.php?page=login">Login</a></li>';
    } else {
        echo
        '<li><a href="\educom-webshop-basis/index.php?page=logout">Loguit '; echo $_SESSION["user_name"]; echo'</a></li>';
    }
    echo '</ul>
    </div>';
}
function showcontent($data){
    $page = $data["page"];
    if (file_exists( $page . ".php")){
        include $page . ".php";
    }
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

function get_variable($data, $key, $key_array_in_array=NULL){
    if ($key_array_in_array != NULL){
        $value = isset($data[$key][$key_array_in_array]) ? $data[$key][$key_array_in_array] : "";
    } else {
        $value = isset($data[$key]) ? $data[$key] : "";
    }
    return $value;
}

function showBodySection($data){
    showBodyStart();
    showNavbar($data);
    showcontent($data);
    showFooter();
    showBodyEnd();
}

function showResponsePage($data){
    showHTMLstart();
    showHeadSection();
    showBodySection($data);
    showHTMLend();
}
?>