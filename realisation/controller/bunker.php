<?php
/**
 * Author : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * Description : Contains all functions related to the bunker
 **/

function displayForm(){
    $bunkerName = array('AbrisTest1', 'AbrisTest2');
    $issueType = array('électrique', 'eau', 'sanitaire', 'mobilier', 'portes', 'fenêtre');
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