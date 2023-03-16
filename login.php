<?php
echo '<div class="register-login">
<form class="form_login" method="post" action="\educom-webshop-basis/index.php">


<label for="email">Email:</label><br>
<input type="email" id="email" name="email" value="'; echo get_variable($data,"email"); echo '">
<span class="error">'; echo get_variable($data,"errors","login"); echo'</span><br>

<label for="name">Wachtwoord:</label><br>
<input type="password" id="name" name="password" value="'; echo get_variable($data,"password"); echo '">
<span class="error">'; echo get_variable($data,"errors","login"); echo'</span><br>

<input type="hidden" name="page" value="login"><br>
<input type="submit" value="Submit">
</form>
</div>
';
?>
