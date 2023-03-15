<?php
global $errors;
global $name;
global $email;
echo '<div class="register-login">
<form class="form_register" method="post" action="\educom-webshop-basis/index.php">


<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="'. $email . '">
<span class="error">' . $errors["email"] . '</span><br>
<label for="name">Naam:</label><br>
<input type="text" id="name" name="name" value="' . $name . '">
<span class="error">' . $errors["name"] . '</span><br>


<label for="name">Wachtwoord:</label><br>
<input type="password" id="name" name="password" >
<span class="error">' . $errors["password"] . '</span><br>
<label for="name">Herhaal wachtwoord:</label><br>
<input type="password" id="name" name="password_re" ><br>

<input type="hidden" name="form_name" value="register"><br>
<input type="submit" value="Submit">
</form>
</div>


';
?>