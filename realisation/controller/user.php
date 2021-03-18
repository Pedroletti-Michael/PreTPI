<?php
/**
* Author : Pedroletti Michael
* CreationFile date : 08.02.2021
* Description : Contains all functions related to the user
**/

/**
 * Get datas user's VMs to display the user's VMs at the home page
 */
function displayHome()
{
    if(isset($_SESSION['sessionTime']) && $_SESSION['sessionTime'] != null){
        $_GET['action'] = "home";
        require_once "view/home.php";
    }
    else{
        displayLogin();
    }
}

/**
 * Display the sign in page
 */
function displayLogin()
{
    $_GET['action'] = "signIn";
    require 'view/login.php';
}

/**
 * Verify the datas's form VM order and if the login is correct, display the home page.
 * (Only if the user did not take any action before logging in).
 *
 * @param $loginRequest = The datas's form VM order (POST)
 */
function login($loginRequest)
{
  if (isset($loginRequest['userLogin']) && $loginRequest['userLogin'] != null && isset($loginRequest['userPassword']) && $loginRequest['userPassword'] != null)
     {
         $userLogin= $loginRequest['userLogin'];
         $userPwd = $loginRequest['userPassword'];

         require_once "model/userManager.php";
         $userInformation = userLogin($userLogin, $userPwd);

         if ($userInformation[0]['mail']!=null || $userInformation[0]['mail']!=false)
         {
             createSession($userInformation[0]);

             displayHome();
         }
         else
         {
             $_GET['action'] = "signIn";
             $_POST['error'] = "credentials";
             displayLogin();
         }
     }
     else
     {
         $_GET['action'] = "signIn";
         $_POST['error'] = "fieldEmpty";
         displayLogin();
     }
}

/**
 * Create the user's session (store the user's informations into the user's session)
 * @param $userEmail = The user's email address
 */
function createSession($userEmail)
{
    $_SESSION['userEmail'] = $userEmail['mail'];
    $_SESSION['firstname'] = $userEmail['prenom'];
    $_SESSION['lastname'] = $userEmail['nom'];

    $_SESSION['sessionTime'] = strtotime(date("Y-m-d H:i:s"));
}

/**
 * @return true or false depending if the user is connected and do nothing during 1 hour
 */
function testSessionTime(){
    if(isset($_SESSION['sessionTime']) == false || $_SESSION['sessionTime'] + 3600 < strtotime(date("Y-m-d H:i:s"))){
        signOut();
        return true;
    }
    else{
        $_SESSION['sessionTime'] = strtotime(date("Y-m-d H:i:s"));
        return false;
    }
}

/**
 * Disconnect the user, delete user's information and redirect the user to the sign in page
 */
function signOut()
{
    $_SESSION = array();
    session_destroy();

    displayLogin();
}

/**
 * Function serve to create a user
 */
function displayUser(){
    $_GET['action'] = 'displayUser';
    require 'view/creationUser.php';
}

/**
 * Function deserve
 */
function userCreation($info){
    require_once 'model/userManager.php';
    if(!userAlreadyExist($info['mail'])){
        // Add user to the db and if it's okay return to the form
        if(!addUserToDB($info['lastname'], $info['firstname'], $info['mail'], password_hash($info['password'], PASSWORD_DEFAULT))){
            $_SESSION['message'] = "addUserSuccesses";
            displayUser();
        }
        // else go back to the form with an error message
        else{
            $_SESSION['message'] = "addUserFailed";
            displayUser();
        }
    }
    else{
        $_SESSION['message'] = "userAlreadyExist";
        displayUser();
    }

}