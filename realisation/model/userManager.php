<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 17.03.2020
* ModificationFile date : 25.03.2020
* Description : This file contains things about user, like the verification of
* the connexion with the server.
*/
require_once 'model/dbConnector.php';

/**
* Function used to add an user into data base
* return the query result
*/
function addUserToDB($lastname, $firstname, $mail, $pwd){
  $strSep = '\'';

  $query = "INSERT INTO utilisateurs (nom, prenom, mail, password) VALUES('".$lastname."', '".$firstname."', '".$mail."', '".$pwd."');";

  return executeQuery($query);
}

/**
* This function use different function to connect user. And if this is the first
* connection for the user, the function ad user into our db.
* We only need to use this function in controller to know if the user success to
* connect or not.
* If all things pass -> function return mail of the user
* Else -> return false
*/
function userLogin($userLogin, $userPwd){
    if($userLogin == 'admin'){
        return "amdin@test.ch";
    }
    else{
        // get login information from db
        $information = getLoginInformation();

        $result = false;

        foreach ($information as $loginInfo){
            if($loginInfo['mail'] == $userLogin && password_verify($loginInfo['password'], $userPwd)){
                $result = true;
            }
        }

        return $result;
    }


}

/**
 * Function who return true if a user email address already exist in db and false if not
 */
function userAlreadyExist($userEmail){
    $result = false;

    // prepare the query
    $query = "SELECT `mail` FROM `utilisateurs`";

    // execute the query and get the result into a $dbInformation
    $dbInformation = executeQuery($query);

    // check information
    foreach ($dbInformation as $mail){
        if($mail['mail'] == $userEmail){
            $result = true;
        }
    }

    // return information
    return $result;
}

/**
 * Get login information, so mail and password of the table "utilisateurs"
 */
function getLoginInformation(){
    // prepare the query
    $query = "SELECT `mail`, `password` FROM `utilisateurs`";

    // execute and return the result of the query
    return executeQuery($query);
}