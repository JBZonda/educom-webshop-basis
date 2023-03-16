<?php

if (get_variable($data,"thanks")) {
    var_dump($data);
    echo '<div class="thanks_message">
    <p>Bedankt</p>
    <p>'; echo get_variable($data,"address"); echo" "; echo get_variable($data,"name"); echo '</p>
    <p>Email:'; echo get_variable($data,"email"); echo'</p>
    <p>Telefoonnummer:'; echo get_variable($data,"phone_number"); echo '</p>
    <p>Bericht: <br>';
    echo get_variable($data,"comment"); 
    echo ' </p>
    <p>Communicatievoorkeur: '; echo get_variable($data, "com_pref"); echo '.</div>';
} else {
    echo '<div class="contact_form">
        <form class="form_contact" method="post" action="\educom-webshop-basis/index.php">
        <div class="form_item">
        <label for="address">Aanhef:</label>
        <select id="address" name="address">
            <option value=""></option>
            <option value="Dhr."';
            if (get_variable($data,"address") == "Dhr."){
                echo ' selected="selected"';}
            echo'>Dhr.</option>
            <option value="Mvr."';
            if (get_variable($data,"address") == "Mvr."){
                echo ' selected="selected"';}
            echo '>Mvr.</option>
            <option value="..."';
            if (get_variable($data,"address") == "..."){
                echo ' selected="selected"';}
                echo '>...</option>
        </select><br>
        </div>
        <div class="form_item">
        <label for="name">Naam:</label>
        <input type="text" id="name" name="name" value="'; echo get_variable($data,"name"); echo '">
        <span class="error">'; echo get_variable($data,"errors","name"); echo '</span><br>
        </div>
        <div class="form_item">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="'; echo get_variable($data,"email"); echo '">
        <span class="error">'; echo get_variable($data,"errors","email"); echo '</span><br>
        </div>
        <div class="form_item">
        <label for="phone_number">Telefoonnummer:</label>
        <input type="text" id="phone_number" name="phone_number" value="'; echo get_variable($data,"phone_number"); echo '">
        <span class="error">'; echo get_variable($data,"errors","phone_number"); echo'</span><br>
        </div>
        <label for="comment">Bericht:</label>
        <textarea id="comment" name="comment">'; echo get_variable($data,"comment"); echo '</textarea>
        <span class="error">'; echo get_variable($data,"errors", "comment"); echo '</span>
        <p>Selecteer communicatievoorkeur:
        <span class="error">'; echo get_variable($data,"errors", "com_pref"); echo '</span></p>
        <input type="radio" id="cm_email" name="com_pref" value="Email"';
        if (get_variable($data, "errors", "com_pref") == "Email") {
            echo 'checked="checked"';
        }
        echo '>
        <label for="">Email</label><br>
        <input type="radio" id="cm_phone" name="com_pref"  value="Telefoon" ';
        
        if (get_variable($data, "errors", "com_pref") == "Telefoon") {
            echo 'checked="checked"';
        }
        echo '>
        <label for="">Telefoon</label>
        <br><br>
        <input type="hidden" name="page" value="contact">
        <input type="submit" value="Submit">
        </form>';

}
?>

