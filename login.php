<?php
global $errors;
global $name;
global $email;
global $password;
echo '<div class="register-login">
<form class="form_login" method="post" action="\educom-webshop-basis/index.php">


<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="'. $email . '">
<span class="error">' . $errors["login"] . '</span><br>

<label for="name">Wachtwoord:</label><br>
<input type="password" id="name" name="password" value="'. $password . '">
<span class="error">' . $errors["login"] . '</span><br>

<input type="hidden" name="form_name" value="login"><br>
<input type="submit" value="Submit">
</form>
</div>
';
?>
