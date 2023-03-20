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

function handle_form_register($data){
    $fields = array("name","email", "password", "password_re");
    $data = validate_input_fields($fields, $data);
    if ($data["password"] != $data["password_re"]) {
        $data["errors"]["password"] = "Herhaalde wachtwoord komt niet over een.";
    }
    if (is_valid($data)) {
        if (!does_email_exist($data["email"])){
            save_user($data["email"],$data["name"],$data["password"]);
            $data["page"] = "login";
        } else {
            $data["errors"]["email"] = "Email is al in gebruik.";
            $data["page"] = "register";
        }
        
        return $data;
    } else {
        return $data;
    }
}

function handle_form_login($data){
    $fields = array("email", "password");
    $data = validate_input_fields($fields, $data);

    #check the login data, and login if correct

    if (does_email_exist($data["email"])){
        $user_data = get_user_data_from_email($data["email"]);
        if ($data["password"] == $user_data["password"]){
            login_user($user_data["email"],$user_data["name"]);
        } else {
            $data["errors"]["login"] = "Login is incorrect.";
        }
    } else {
        $data["errors"]["login"] = "Login is incorrect.";
    }

    if (is_valid($data)) {
        $data["page"] = "home";
        return $data;
    } else {
        $data["page"] = "login";
        return $data;
    }
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