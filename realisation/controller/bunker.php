<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * Description : Contains all functions related to the bunker
 **/

function displayForm($get = null){
    require_once 'model/selectQuery.php';
    if($get != null){
        $data = getBunkerInformationForm($get['bunkerName']);

        $basicsInformation = $data['basicsBunkerInformation'];
        $roomsInformation = $data['roomsInformation'];
        $data = array();
    }

    $data = getBaseInformationCheckForm();
    $bunkerName = $data['bunkerName'];
    $issueType = $data['issueType'];

    require 'view/cpaCheckForm.php';
}

function displayGlobalList(){
    require_once 'model/selectQuery.php';

    $informationBunkers = getListBunkerInformation();

    require 'view/globalList.php';
}

function displayBunkerWhoNeedVisit(){
    $bunkerNeeded = 1;

}

function displayBunkerWhoNeedCounterInspection(){
    $bunkerNeeded = 2;
}