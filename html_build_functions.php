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

function showNavbar(){
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

function showBodySection($page){
    showBodyStart();
    showNavbar();
    showcontent($page);
    showFooter();
    showBodyEnd();
}

function showResponsePage($page){
    showHTMLstart();
    showHeadSection();
    showBodySection($page);
    showHTMLend();
}
?>