<?php
global $errors;
global $name;
global $email;
echo '<div class="register-login">
<form class="form_register" method="post" action="\educom-webshop-basis/index.php">


<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="'; echo get_variable($data,"email"); echo '">
<span class="error">'; echo get_variable($data,"errors","email"); echo '</span><br>
<label for="name">Naam:</label><br>
<input type="text" id="name" name="name" value="'; echo get_variable($data,"name"); echo  '">
<span class="error">' ; echo get_variable($data,"errors","name"); echo '</span><br>


<label for="name">Wachtwoord:</label><br>
<input type="password" id="name" name="password" >
<span class="error">'; echo get_variable($data,"errors", "password"); echo '</span><br>
<label for="name">Herhaal wachtwoord:</label><br>
<input type="password" id="name" name="password_re" ><br>

<input type="hidden" name="page" value="register"><br>
<input type="submit" value="Submit">
</form>
</div>


';
?>