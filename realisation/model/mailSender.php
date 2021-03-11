<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 11.03.2021
 * Description : Contains all functions for sending mails
 */

/**
 * function used to send the mail and return true or false
 * @param $to = the user who receive the mail
 * @param $subject = subject of the mail
 * @param $message = the message of the mail
 * @param $headers = the headers of the mail
 * @return bool = True = successfully sending | False = Failed to send
 */
function sendMail($to, $subject, $message, $headers){
    if (mail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}

/**
 * This function deserve to send mail to user who send the request mail and the manager of the bunker to notice
 * him that the visit will be on the date that the requester choose
 * @param $userMail = mail of the requester
 * @param $manager = mail of the bunker manager
 * @param $bunkerName = name of the bunker
 * @param $date = date of the visite
 * @return bool
 */
function visitBunkerMail($userMail, $manager, $bunkerName, $date){
    $to  = $userMail . ', ' . $manager;

    // subject
    $subject = 'Avis de visite de l\'abris : '.$bunkerName;

    $message = "
        Bonjour,
        <br><br>
        Nous vous informons par ce mail que nous allons venir visiter l'arbis : ". $bunkerName ."
        <br><br>
        Nous viendrons visiter l'abris le ".$date.", dans la journée. Nous vous prions donc de vous préparer à notre arrivée.
        <br><br>
        Meilleures salutations,
        <br><br>
        ".$userMail."
        ";

    // To send HTML mail, the Content-type header must be set
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

    // Additional headers
    $headers .= 'To: '. $manager ."\r\n";
    $headers .= 'BCC: '.$userMail."\r\n";
    $headers .= 'From: '.$userMail."\r\n";

    if(sendMail($to, $subject, $message, $headers)){
        return true;
    }
    else{
        return false;
    }
}