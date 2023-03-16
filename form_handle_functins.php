<?php
#return true if there are no errors saved
function error_check(){
    global $errors;
    $valid = True;
    foreach($errors as $key => $error) {
        if ($error != ""){
            $valid = False;
            break;
        }
    }
    return $valid;
}

function handle_form_contact(){
    global $errors;
    global $name;
    global $email;
    global $phone_number;
    global $comment;
    global $address;
    global $thanks;
    global $errors;
    global $com_pref;
    #check input and set errors is the $errors array
    $address = validate_specific_response("address", clean_and_check_input("address"));
    $name = validate_specific_response("name", clean_and_check_input("name"));
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $phone_number = validate_specific_response("phone_number", clean_and_check_input("phone_number"));
    $comment = validate_specific_response("comment", clean_and_check_input("comment"));
    $com_pref = validate_specific_response("com_pref", clean_and_check_input("com_pref"));
    
    if (error_check()) {
        $thanks = True;
        return "contact";
    } else {
        return "contact";
    }
}

function handle_form_register(){
    global $name;
    global $email;
    global $errors;
    global $password;
    $name = validate_specific_response("name", clean_and_check_input("name"));
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $password = validate_specific_response("password", clean_and_check_input("password"));
    $password_re = clean_and_check_input("password_re");
    
    if ($password != $password_re) {
        $errors["password"] = "Herhaalde wachtwoord komt niet over een.";
    }

    #check if email is already in use
    $login_file = fopen("data_text_files/logins.txt","r");
    fgets($login_file);
    while(!feof($login_file)) {
        $line = fgets($login_file);
        $line_seperated = explode("|",$line);
        if ($email == $line_seperated[0]){
            $errors["email"] = "Email is al in gebruik.";
            break;
        }
             
    }
    fclose($login_file);

    if (error_check()) {

        $login_file = fopen("data_text_files/logins.txt","a");
        fwrite($login_file,implode("|",array("\n" . $email, $name, $password)));
        fclose($login_file);
        $_SESSION["user_name"] = $name;
        $_SESSION["user_email"] = $email;
        return "login";
    } else {
        return "register";
    }

    return "register";
}

function handle_form_login(){
    echo "in handle";
    global $email;
    global $errors;
    global $password;
    $email = validate_specific_response("email", clean_and_check_input("email"));
    $password = validate_specific_response("password", clean_and_check_input("password"));
    
    #check the login data, and login if correct
    $login_file = fopen("data_text_files/logins.txt","r");
        fgets($login_file);
        while(!feof($login_file)) {
        $line = fgets($login_file);
        $line = rtrim($line,"\r\n");
        $line_seperated = explode("|",$line);
            if ($email == $line_seperated[0]){
                if ($password == $line_seperated[2]){
                    #login
                    $_SESSION["user_name"] = $line_seperated[1];
                    $_SESSION["user_email"] = $line_seperated[0];
                    break;
                }
                #password is not correct
                $errors["login"] = "incorrecte login";
                break;
            }
        }
        #email is not registered
        if (feof($login_file)){
            $errors["login"] = "incorrecte login";
        }
        fclose($login_file);

    print_r($errors);
    if (error_check()) {
        return "home";
    } else {
        return "login";
    }
}

#loguit a user by reseting the session variable
function handle_form_logout(){
    session_unset();
    $_SESSION["user_name"] = NULL;
    $_SESSION["user_email"] = NULL;
    return "home";
}

function clean_and_check_input($variable_name) {
    # give errors to the missing variables
    if (empty($_POST[$variable_name])){
        $emty_error = "is verplicht";
        global $errors;
        $errors[$variable_name] = $emty_error;
        return "";
    } else {
        #trim the data to protect against malicious input
        $data = $_POST[$variable_name];
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
    }
    
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
?>