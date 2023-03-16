<?php
#return true if there are no errors saved
function validate_input_fields($fields, $data){
    foreach ($fields as $key => $field){
        $data = validate_specific_response($field, clean_and_check_input($field,$data));
    } 
    return $data;
}


function is_valid($data){
    $valid = TRUE;
    $errors = $data["errors"];
    foreach( $errors as $key => $error) {
        if ($error != ""){
            $valid = False;
            break;
        }
    }
    return $valid;
}

function handle_form_contact($data){
    #check input and set errors is the errors array in $data
    $fields = array("address","name", "email", "phone_number", "comment","com_pref");
    $data = validate_input_fields($fields, $data);
    /*
    $data = validate_specific_response("address", clean_and_check_input("address",$data));
    $data = validate_specific_response("name", clean_and_check_input("name", $data));
    $data = validate_specific_response("email", clean_and_check_input("email", $data));
    $data= validate_specific_response("phone_number", clean_and_check_input("phone_number", $data));
    $data = validate_specific_response("comment", clean_and_check_input("comment", $data));
    $data = validate_specific_response("com_pref", clean_and_check_input("com_pref", $data));*/
    
    if (is_valid($data)) {
        $thanks = TRUE;
        
    } else {
        $thanks = FALSE;
    }
    $data["thanks"] = $thanks;
    return $data;
    
}

function does_email_exist($email){
    #check if email is already in use
    $login_file = fopen("data_text_files/logins.txt","r");
    fgets($login_file);
    while(!feof($login_file)) {
        $line = fgets($login_file);
        $line_seperated = explode("|",$line);
        if ($email == $line_seperated[0]){
            fclose($login_file);
            return TRUE;
        }  
    }
    fclose($login_file);
    return FALSE;
}

function save_user($email,$name,$password){
    $login_file = fopen("data_text_files/logins.txt","a");
    fwrite($login_file,implode("|",array("\n" . $email, $name, $password)));
    fclose($login_file);
}

function handle_form_register($data){
    $fields = array("name","email", "password", "password_re");
    $data = validate_input_fields($fields, $data);
    if ($data["password"] != $data["password_re"]) {
        $data["errors"]["password"] = "Herhaalde wachtwoord komt niet over een.";
    }
    if (is_valid($data)) {
        if (!does_email_exist($data["email"])){
            save_user($data["email"],$data["name"],$data["password"]);
        } else {
            $data["errors"]["email"] = "Email is al in gebruik.";
        }
        $data["page"] = "login";
        return $data;
    } else {
        return $data;
    }
}

function handle_form_login($data){
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

    if (is_valid()) {
        return "home";
    } else {
        return "login";
    }
}

#loguit a user by reseting the session variable
function logout_user($data){
    session_unset();
    $_SESSION["user_name"] = NULL;
    $_SESSION["user_email"] = NULL;
    $data["page"] = "home";
    return $data;
}

function clean_and_check_input($variable_name, $data) {
    # give errors to the missing variables
    if (empty($_POST[$variable_name])){
        $emty_error = "is verplicht";
        $data[$variable_name]= "";
        $data["errors"][$variable_name] = $emty_error;
    } else {
        #trim the data to protect against malicious input
        $input = $_POST[$variable_name];
        $input = trim($input);
        $input = stripslashes($input);
        $input = htmlspecialchars($input);
        $data[$variable_name]= $input;
        $data["errors"][$variable_name] = "";
    }
    
    return $data;
}


function validate_specific_response($variable_name, $data) {
    if ($variable_name == "phone_number") {
        #check if the input is a correct phonenumber by checking for letters, special signs are allowed
        if (preg_match("/[a-z]/i", $data["phone_number"])){
            $data["errors"][$variable_name] = "Incorrect telefoonnummer";
            return $data;
        }
    }
    return $data;
}
?>