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
            require 'view/home.php';
        }
    }
    else{
        $_SESSION['message'] = "errorSaveData";
        require 'view/cpaCheckForm.php';
    }
}


function displayGlobalList(){
    require_once 'model/selectQuery.php';

    $informationBunkers = getListBunkerInformation();
    $data = getInformationForFilter();
    $managers = $data['managers'];
    $municipality = $data['municipality'];
    $region = $data['region'];

    require 'view/globalList.php';
}

function displayVisitList(){
    require_once 'model/selectQuery.php';

    $informationBunkers = getListBunkerInformation(0);
    $data = getInformationForFilter();
    $managers = $data['managers'];
    $municipality = $data['municipality'];
    $region = $data['region'];

    require 'view/visitList.php';

}

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

