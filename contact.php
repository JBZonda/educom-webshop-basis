<?php


global $errors;
global $name;
global $email;
global $phone_number;
global $comment;
global $address;

echo '<div class="contact_form">
    <form class="form_contact" method="post" action="\educom-webshop-basis/index.php">
    <div class="form_item">
    <label for="address">Aanhef:</label>
    <select id="address" name="address">
        <option value=""></option>
        <option value="Dhr.">Dhr.</option>
        <option value="Mvr.">Mvr.</option>
        <option value="Mvr.">...</option>
    </select><br>
    </div>
    <div class="form_item">
    <label for="name">Naam:</label>
    <input type="text" id="name" name="name" value="' . $name . '">
    <span class="error">' . $errors["name"] . '</span><br>
    </div>
    <div class="form_item">
    <label for="email">Email:</label>
    <input type="email" id="email" name="email" value="'. $email . '">
    <span class="error">' . $errors["email"] . '</span><br>
    </div>
    <div class="form_item">
    <label for="phone_number">Telefoonnummer:</label>
    <input type="text" id="phone_number" name="phone_number" value="'. $phone_number . '">
    <span class="error">' . $errors["phone_number"] . '</span><br>
    </div>
    <label for="comment">Bericht:</label>
    <textarea id="comment" name="comment">'. $comment .'</textarea>
    <span class="error">'. $errors["comment"] . '</span>
    <p>Selecteer communicatievoorkeur:
    <span class="error">'. $errors["com_pref"] . '</span></p>
    <input type="radio" id="cm_email" name="com_pref" value="Email">
    <label for="">Email</label><br>
    <input type="radio" id="cm_phone" name="com_pref"  value="Telefoon">
    <label for="">Telefoon</label>
    <br><br>
    <input type="submit" value="Submit">
    </form>';

?>

