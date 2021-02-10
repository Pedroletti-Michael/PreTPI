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
 * Get all users from DB
 */
function getAllUsers(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user ORDER BY lastname ASC';

    return executeQuerySelect($query);
}

/**
 * @return array|null
 */
function getAllAdmin(){
    $query = 'SELECT mail, lastname, firstname, type, user_id FROM user WHERE type = 1 ORDER BY lastname ASC';

    return executeQuerySelect($query);
}

/**
* This function is used to know if the user exist in our db.
* If the user exist -> function return true
* Else -> function return false
*/
function dbVerification($userMail){
  $queryResult = getAllUsers();

  //do the test to every user we have
  foreach ($queryResult as $value) {
    if ($userMail == $value[0]){
        return true;
    }
  }

  return false;
}

/**
* Function used to add an user into data base
* return the query result
*/
function adUserToDB($lastname, $firstname, $mail){
  $strSep = '\'';

  $query = "INSERT INTO user (lastname, firstname, mail) VALUES(".$strSep.$lastname.$strSep.",".$strSep.$firstname.$strSep.",".$strSep.$mail.$strSep.")";

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
    //TODO FONCTION A REVOIR ENTIERMENT AFIN DE CORRESPONDRE AUX ATTENTES
    if($userLogin == 'admin'){
        return "amdin@test.ch";
    }
    else{
        return false;
    }


}

/**
 * Get the type of the user
 * @param $userMail = mail of the user
 * @return = type of the user
 */
function getUserType($userMail){
    $strSep = '\'';

    $query = "SELECT type FROM `user` WHERE mail = ". $strSep.$userMail.$strSep;

    $result = executeQuery($query);
    return $result[0][0];
}
