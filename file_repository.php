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

function save_user($email,$name,$password){
    $login_file = fopen("data_text_files/logins.txt","a");
    fwrite($login_file,implode("|",array("\n" . $email, $name, $password)));
    fclose($login_file);
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

function get_user_data_from_email($email){
    $login_file = fopen("data_text_files/logins.txt","r");
    fgets($login_file);
    while(!feof($login_file)) {
        $line = fgets($login_file);
        $line = rtrim($line,"\r\n");
        $line_seperated = explode("|",$line);
            if ($email == $line_seperated[0]){
                $user_data["email"] = $line_seperated[0];
                $user_data["name"] = $line_seperated[1];
                $user_data["password"] = $line_seperated[2];
                fclose($login_file);
                return $user_data;
            }
    }
    #email is not registered -> error handeling in future
    if (feof($login_file)){
        return FALSE;
    }
}



?>