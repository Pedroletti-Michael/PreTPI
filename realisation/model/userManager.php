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
    //TODO FONCTION A REVOIR ENTIERMENT AFIN DE CORRESPONDRE AUX ATTENTES
    if($userLogin == 'admin'){
        return "amdin@test.ch";
    }
    else{
        return false;
    }


}