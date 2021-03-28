<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * Description : Contains all functions related to the bunker
 **/

function displayForm($get = null){
    require_once 'model/selectQuery.php';
    if($get != null){
        $data = getBunkerInformationForm($get);

        $basicsInformation = $data['basicsBunkerInformation'];
        $roomsInformation = $data['roomsInformation'];
        $data = array();
    }

    $data = getBaseInformationCheckForm();
    $bunkerName = $data['bunkerName'];
    $allBunkerName = $data['allBunkerName'];
    $issueType = $data['issueType'];

    require 'view/cpaCheckForm.php';
}

function saveFormData($data){
    require 'model/insertQuery.php';

    if (isset($data['inputNumberOfRoom'])){
        $return = saveVisitData($data);
        if($return != null){
            echo $return;
            $_SESSION['message'] = 'successSavingFormDataVisit';
            $_SESSION['bunkerName'] = $data['inputInformationBunkerName'];
            header("location:/?action=home");
        }
    }
    else{
        $_SESSION['message'] = "errorSaveData";
        require 'view/cpaCheckForm.php';
    }
}

/**
 * Function used to display global list of all bunker
 */
function displayGlobalList(){
    require_once 'model/selectQuery.php';

    $informationBunkers = getListBunkerInformation();
    $data = getInformationForFilter();
    $managers = $data['managers'];
    $municipality = $data['municipality'];
    $region = $data['region'];

    require 'view/globalList.php';
}

/**
 * Display list of bunker who need a visit
 * /!\ Function unused /!\
 */
function displayVisitList(){
    require_once 'model/selectQuery.php';

    $informationBunkers = getListBunkerInformation(0);
    $data = getInformationForFilter();
    $managers = $data['managers'];
    $municipality = $data['municipality'];
    $region = $data['region'];

    require 'view/visitList.php';

}

/**
 * This function is used to send notice by mail to the bunker manager and change status of the bunker and save the visit
 * @param $get
 * @param $post
 * @param null $counterInspection
 */
function sendVisitNotice($get, $post, $counterInspection = null){
    require_once 'model/mailSender.php';
    require_once 'model/selectQuery.php';

    $manager = $get['manager'];
    if($manager == null || $manager == ''){
        $manager = getManagerBunker($get['bunkerName']);
    }

    if($counterInspection != null){
        if(visitBunkerMail($_SESSION['userEmail'], $manager, $get['bunkerName'], $post['inputDateVisitMail'], true)){
            $_SESSION['message'] = "mailVisitSendingSuccess";
        }
        else{
            $_SESSION['message'] = "mailVisitSendingError";
        }
    }
    else{
        if(visitBunkerMail($_SESSION['userEmail'], $manager, $get['bunkerName'], $post['inputDateVisitMail'])){
            $_SESSION['message'] = "mailVisitSendingSuccess";
        }
        else{
            $_SESSION['message'] = "mailVisitSendingError";
        }
    }

    displayGlobalList();
}

function displayStats(){
    require_once 'model/selectQuery.php';

    $stats = getInformationStats();
    require 'view/statistic.php';
}
