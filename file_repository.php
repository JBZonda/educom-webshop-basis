<?php

# user files functions
function get_user_by_email($email){
    
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
}

function save_user($email, $name, $password){
    
}





?>