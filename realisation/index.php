<?php
/**
* Authors : Pedroletti Michael
* CreationFile date : 08.02.2021
* Description : Serve to redirect the user depending of his actions
**/

session_start();

// Require all controller's files
$files = glob(__DIR__ . '/controller/*.php');
foreach ($files as $file)
{
    require($file);
}

// Redirect the user depending of his actions
if(isset($_GET['action']))
{
    $action = $_GET['action'];

    switch ($action)
    {
        case 'signIn':
            displayLogin();
            break;
        case 'signOut':
            signOut();
            break;
        case 'RequestLogin':
            login($_POST);
            break;
        case 'displayUser':
            displayUser();
            break;
        case 'userCreation':
            userCreation($_POST);
            break;
        case 'displayGlobalList':
            displayGlobalList();
            break;
        case 'displayForm':
            displayForm();
            break;
        case 'displayBunkerInformation':
            displayForm($_GET['bunkerName']);
            break;
        case 'saveFormData':
            saveFormData($_POST);
            break;
        case 'displayVisitList':
            displayVisitList();
            break;
        case 'sendVisitNotice':
            sendVisitNotice($_GET, $_POST);
            break;
        case 'sendCounterInspectionNotice':
            sendVisitNotice($_GET, $_POST, true);
            break;
        case 'home':
        default:
            if(testSessionTime()){break;}
            displayHome();
            break;
    }
}
else
{
    displayHome();
}
