<!DOCTYPE html>
<html lang="en">

<?php

function test_input($variable_name) {

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
# make variables and their errors in an array
$address = $name = $email = $phone_number = $comment = $com_pref= "";
$errors = array("address" =>"","name" =>"", "email"=>"", "phone_number" =>"", "comment" =>"", "com_pref" =>"");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach($_POST as $key => $value) {
        echo $key . " content " . $value;
    }
    
    $address = test_input("address");
    $name = test_input("name");
    $email = test_input("email");
    $phone_number = test_input("phone_number");
    $comment = test_input("comment");
    $com_pref = test_input("com_pref");
    echo "errors:";
    foreach($errors as $key => $error) {
        echo $key . " content " . $error;
    }
    
}


?>


<head>
    <title>Contact</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>

<body class="standard_body">
    <div id="nav_bar">
        <ul>
            <li> <a href="\educom-webshop-basis/index.html">Home</a>  </li>
            <li> <a href="\educom-webshop-basis/about.html">About</a></li>
            <li> <a href="\educom-webshop-basis/contact.php">Contact</a></li>
        </ul>
    </div>

    <div class="contact_form">
    <form class="form_contact" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <div class="form_item">
        <label for="address">Aanhef</label>
        <select id="address" name="address">
            <option value="Dhr.">Dhr.</option>
            <option value="Mvr.">Mvr.</option>
            <option value="...">...</option>
        </select><br>
        </div>
        <div class="form_item">
        <label for="name">Naam</label>
        <input type="text" id="name" name="name"><br>
        </div>
        <div class="form_item">
        <label for="email">Email</label>
        <input type="email" id="email" name="email"><br>
        </div>
        <div class="form_item">
        <label for="phone_number">Telefoonnumer</label>
        <input type="text" id="phone_number" name="phone_number"><br>
        </div>
        <label for="comment">Bericht</label>
        <textarea id="comment" name="comment"></textarea>

        <p>Selecteer communicatievoorkeur:</p>
        <input type="radio" id="cm_email" name="com_pref" value="Email">
        <label for="">Email</label><br>
        <input type="radio" id="cm_phone" name="com_pref"  value="Telefoon">
        <label for="">Telefoon</label><br>

        <input type="submit" value="Submit">
    </form>
    </div>

</body>

<footer class="standard_footer">
    <p>&copy;2023 Author: Jeroen van der Borgh</p>
</footer>



</html>