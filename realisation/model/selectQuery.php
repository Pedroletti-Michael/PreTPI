<?php
/**
 * Author : Pedroletti Michael
 * Contact : michael@pedroletti.ch
 * Creation Date : 14.02.21
 * Description File : I'm gonna stock in this file all the query that I need to do for db.
 */

require_once 'dbConnector.php';


function getBunkerInformationForm($bunkerName){
    $result = array('basicsBunkerInformation', 'basicsRoomsInformation');

    //Get basics information about a specific bunker
    $resultListBunker = getListBunkerInformation('specific', $bunkerName);

    //Get basics information about rooms of an bunker
    $resultRooms = getRoomsInformationForSpecificBunker($resultListBunker[0]);

    $result = array('basicsBunkerInformation' => $resultListBunker, 'roomsInformation' => $resultRooms);

    return $result;
}

function getRoomsInformationForSpecificBunker($idBunker){
    $query = "SELECT `idPiece`,`nom`,`placesDisponibles`,`type` FROM `pieces` WHERE `fkAbris` = ".$idBunker[0];

    return executeQuery($query);
}

function getBaseInformationCheckForm(){
    $result = array("bunkerName", "issueType");

    //Prepare query to get issue type
    $query = "SELECT `type` FROM `defauts`";
    //Get issue type
    $result['issueType'] = executeQuery($query);

    //Prepare query to get bunker name
    $query = "SELECT `nom` FROM `abris` WHERE `statutVisite` = 1 OR `statutVisite` = 0";
    //Get bunkerName
    $result['bunkerName'] = executeQuery($query);

    return $result;
}


/**
 * Function used to get the list of bunker with complete information for display.
 * With param status we can choose which list we want to get
 */
function getListBunkerInformation($status = 99, $name = null){
    $strSep = '\'';

    if ($status == 0) {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`responsable` FROM `abris` WHERE `statutVisite` = 0";
    } elseif ($status == 1) {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`responsable` FROM `abris` WHERE `statutVisite` = 1";
    } elseif ($status == 2) {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`responsable` FROM `abris` WHERE `statutVisite` = 2";
    } elseif ($status == 'specific') {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`responsable` FROM `abris` WHERE `nom` = " . $strSep . $name . $strSep;
    } else {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`responsable` FROM `abris`";
    }

    //get bunker information depends on which query is used
    $bunkerInformation = executeQuery($query);
    $query = "";

    $query = "SELECT `idCommune`, `nom`, `region` FROM `communes`";

    //get region information
    $regionInformation = executeQuery($query);
    $query = "";

    //this section gonna check all bunker information to replace the "fkCommune" field to change with the real value like "nom" in table "communes"
    $i = 0;
    foreach ($bunkerInformation as $bunker){
        foreach ($regionInformation as $region){
            if ($bunker['fkCommune'] == $region['idCommune']){
                $bunkerInformation[$i]['fkCommune'] = $region['nom'];
                $bunkerInformation[$i] += ['region' => $region['region']];
            }
        }

        //prepare the table for next step with adding the field 'placesDisponibles'
        $bunkerInformation[$i] += ['placesDisponibles' => 0];
        $i ++;
    }

    $query = "SELECT `fkAbris`,`placesDisponibles` FROM `pieces`";

    $roomInformation = executeQuery($query);
    $query = "";

    $i = 0;
    foreach ($bunkerInformation as $bunker){
        foreach ($roomInformation as $room){
            if($room['fkAbris'] == $bunker['idAbris']){
                $bunkerInformation[$i]['placesDisponibles'] += $room['placesDisponibles'];
            }
        }
        $i++;
    }

    return $bunkerInformation;
}

/**
 * This function used to get different information used for filter in all list page
 * return : table of information
 */
function getInformationForFilter(){
    $result = array("municipality", "region", "managers");

    //Prepare query to get all name of different municipality
    $query = "SELECT DISTINCT nom FROM communes";
    //Get municipality
    $result['municipality'] = executeQuery($query);

    //Prepare query to get all name of different region
    $query = "SELECT DISTINCT region FROM communes";
    //Get region
    $result['region'] = executeQuery($query);

    //Prepare query to get all name of different managers available
    $query = "SELECT DISTINCT responsable FROM abris";
    //Get managers
    $result['managers'] = executeQuery($query);

    return $result;
}

function getManagerBunker($bunkerName){
    $strSep = '\'';

    $query = "SELECT responsable FROM abris WHERE nom =".$strSep.$bunkerName.$strSep;

    return executeQuery($query);
}

function getInformationStats(){
    $query = "";
}