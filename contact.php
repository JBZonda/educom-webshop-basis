<!DOCTYPE html>
<html lang="en">

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

<?php

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
$address = $name = $email = $phone_number = $comment = $com_pref= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $address = test_input($_POST["address"]);
  $name = test_input($_POST["name"]);
  $email = test_input($_POST["email"]);
  $phone_number = test_input($_POST["phone_number"]);
  $comment = test_input($_POST["comment"]);
  $com_pref = test_input($_POST["com_pref"]);
  
}


?>

</html>