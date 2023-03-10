<!DOCTYPE html>
<html lang="en">




<head>
    <title>Contact</title>
    <link rel="stylesheet" href="CSS/stylesheet.css">
</head>

<body class="standard_body">

    <?php

    function clean_and_check_input($variable_name) {
        # give errors to the missing variables
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
        $data = validate_specific_response($variable_name, $data);
        return $data;
    }

    function validate_specific_response($variable_name, $data) {
        if ($variable_name == "phone_number") {
            #check if the input is a correct phonenumber by checking for letters, special signs are allowed
            if (preg_match("/[a-z]/i", $data)){
                global $errors;
                $errors[$variable_name] = "Incorrect telefoonnummer";
                return $data;
            }
        }
        return $data;
    }

    # make variables and their errors in an array
    $address = $name = $email = $phone_number = $comment = $com_pref= "";
    $errors = array("address" =>"","name" =>"", "email"=>"", "phone_number" =>"", "comment" =>"", "com_pref" =>"");
    $valid = False;
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
        $address = clean_and_check_input("address");
        $name = clean_and_check_input("name");
        $email = clean_and_check_input("email");
        $phone_number = clean_and_check_input("phone_number");
        $comment = clean_and_check_input("comment");
        $com_pref = clean_and_check_input("com_pref");
        
        $valid = True;
        foreach($errors as $key => $error) {
            if ($error != ""){
                $valid = False;
                break;
            }
        }
        
    }

    ?>
    <div id="nav_bar">
        <ul>
            <li> <a href="\educom-webshop-basis/index.html">Home</a>  </li>
            <li> <a href="\educom-webshop-basis/about.html">About</a></li>
            <li> <a href="\educom-webshop-basis/contact.php">Contact</a></li>
        </ul>
    </div>

    <?php if (!$valid) { /* Show the next part only when $valid is false */ ?>
    <div class="contact_form">
    <form class="form_contact" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
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
        <input type="text" id="name" name="name" value="<?php echo $name?>">
        <span class="error"><?php echo $errors["name"];?></span><br>
        </div>
        <div class="form_item">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $email?>">
        <span class="error"><?php echo $errors["email"];?></span><br>
        </div>
        <div class="form_item">
        <label for="phone_number">Telefoonnummer:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo $phone_number?>">
        <span class="error"><?php echo $errors["phone_number"];?></span><br>
        </div>
        <label for="comment">Bericht:</label>
        <textarea id="comment" name="comment"><?php echo $comment?></textarea>
        <span class="error"><?php echo $errors["comment"];?></span>
        <p>Selecteer communicatievoorkeur:
        <span class="error"><?php echo $errors["com_pref"];?></span></p>
        <input type="radio" id="cm_email" name="com_pref" value="Email">
        <label for="">Email</label><br>
        <input type="radio" id="cm_phone" name="com_pref"  value="Telefoon">
        <label for="">Telefoon</label>
        <br><br>
        <input type="submit" value="Submit">
    </form>
    <?php } else { /* Show the next part only when $valid is true */ ?>
    <div class="thanks_message">
        <p>Bedankt</p>
        <p><?php echo $address ." ". $name?></p>
        <p>Email: <?php echo $email?></p>
        <p>Telefoonnummer: <?php echo $phone_number?></p>
        <p>Bericht: <br>
        <?php echo $comment?></p>
        <p>Communicatievoorkeur: <?php echo $com_pref?>
        <?php } /* End of conditional showing */ ?>
    </div>

    <footer class="standard_footer">
    <p>&copy;2023 Autheur: Jeroen van der Borgh</p>
    </footer>
</body>





</html>