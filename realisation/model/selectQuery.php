<?php
/**
 * Author : Pedroletti Michael
 * Contact : michael@pedroletti.ch
 * Creation Date : 14.02.21
 * Description File : I'm gonna stock in this file all the query that I need to do for db.
 */

require_once 'dbConnector.php';

/**
 * Get bunker information needed to display on the CPA FORM for the visit part
 * param : $bunkerName : name of the bunker that we need to get the information
 * return : array with all the necessary information
 */
function getBunkerInformationForm($bunkerName){
    $result = array('basicsBunkerInformation', 'basicsRoomsInformation');

    //Get basics information about a specific bunker
    $resultListBunker = getListBunkerInformation('specific', $bunkerName);

    //Get basics information about rooms of an bunker
    $resultRooms = getRoomsInformationForSpecificBunker($resultListBunker[0]);

    //Get available issue a specific room and add it to the $resultRooms array
    $i = 0;
    // Get all available issue
    foreach ($resultRooms as $room){
        $resultAvailableIssue = getAvailableRoomIssue($room['idPiece']);
        $resultRooms[$i] += ['availableIssue' => $resultAvailableIssue];

        // When the bunker as a counter inspection planed we get all issue for all room
        if($resultListBunker[0]['statutVisite'] == 1){
            //function who get all issue
            $resultSpottedIssue = getSpottedIssueForRoom($room['idPiece']);
            $resultRooms[$i] += ['spottedIssue' => $resultSpottedIssue];
        }

        $i++;
    }

    $result = array('basicsBunkerInformation' => $resultListBunker, 'roomsInformation' => $resultRooms);

    return $result;
}

/**
 * param $idRoom id of the room that we need to get issue information
 * return all information about issue of a specified room
 */
function getSpottedIssueForRoom($idRoom){
    $query = "SELECT `idPiecesDefauts`, `fkDefauts`, `type`, defauts.description AS globalDescription, pieces_defauts.description FROM `pieces_defauts` INNER JOIN `defauts` ON `fkDefauts` = `idDefauts` WHERE `fkPieces` =".$idRoom;

    return executeQuery($query);
}

/**
 * This function is used to get all information about all room of a specified bunker
 * param $idBunker = id of the specific bunker
 * return : return basics informations for all room of a specified bunker
 */
function getRoomsInformationForSpecificBunker($idBunker){
    $query = "SELECT `idPiece`,`nom`,`placesDisponibles`,`type` FROM `pieces` WHERE `fkAbris` = ".$idBunker[0];

    return executeQuery($query);
}

/**
 * This function is used to get all available issue about a specified room.
 * param : $roomId = id of the room
 * return : Return all available issue
 */
function getAvailableRoomIssue($roomId){
    $query = "SELECT `fkDefauts`, `type`, `description` FROM `defauts_possibles` INNER JOIN `defauts` ON `fkDefauts` = `idDefauts` WHERE `fkPieces` =".$roomId;

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

    if ($status == 0) { // visit planned
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris` WHERE `statutVisite` = 0";
    } elseif ($status == 1) { // counter inspection planned
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris` WHERE `statutVisite` = 1";
    } elseif ($status == 2) { // bunker ok
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris` WHERE `statutVisite` = 2";
    } elseif ($status == 3) { // visit needed
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris` WHERE `statutVisite` = 3";
    } elseif ($status == 4) { // counter inspection needed
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris` WHERE `statutVisite` = 4";
    }elseif ($status == 'specific') {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable`, `statutVisite` FROM `abris` WHERE `nom` = " . $strSep . $name . $strSep;
    } else {
        $query = "SELECT `idAbris`,`fkCommune`,`nom`,`statutVisite`,`fkResponsable` FROM `abris`";
    }

    //get bunker information depends on which query is used
    $bunkerInformation = executeQuery($query);
    $query = "";

    $query = "SELECT `idCommune`, `nom`, `region` FROM `communes`";

    //get region information
    $regionInformation = executeQuery($query);
    $query = "";

    $query = "SELECT `idUtilisateur`, `nom`, `prenom`, `mail` FROM `utilisateurs`";

    $managers = executeQuery($query);

    //this section gonna check all bunker information to replace the "fkCommune" field to change with the real value like "nom" in table "communes"
    $i = 0;
    foreach ($bunkerInformation as $bunker){
        foreach ($regionInformation as $region){
            if ($bunker['fkCommune'] == $region['idCommune']){
                $bunkerInformation[$i]['fkCommune'] = $region['nom'];
                $bunkerInformation[$i] += ['region' => $region['region']];
            }
        }

        foreach ($managers as $manager){
            if ($manager['idUtilisateur'] == $bunker['fkResponsable']){
                $bunkerInformation[$i]['fkResponsable'] = $manager;
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
        $query = "SELECT idVisite FROM visite WHERE statutVisite=1 AND fkAbris=".$bunker['idAbris'];
        $idVisit = executeQuery($query);
        $query ="";

        if(isset($idVisit[0]['idVisite'])){
            $bunkerInformation[$i] += ['visitID' => $idVisit[0]['idVisite']];
        }
        else{
            $bunkerInformation[$i] += ['visitID' => "noVisitPlanned"];
        }

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
    $query = "SELECT DISTINCT `communes`.`nom` FROM abris INNER JOIN `communes` ON `fkCommune` = `idCommune`";
    //Get municipality
    $result['municipality'] = executeQuery($query);

    //Prepare query to get all name of different region
    $query = "SELECT DISTINCT region FROM abris INNER JOIN `communes` ON `fkCommune` = `idCommune`";
    //Get region
    $result['region'] = executeQuery($query);

    //Prepare query to get all name of different managers available
    $query = "SELECT DISTINCT `utilisateurs`.`nom`, prenom, mail FROM abris INNER JOIN `utilisateurs` ON `fkResponsable` = `idUtilisateur` WHERE `utilisateurs`.`role` =0";
    //Get managers
    $result['managers'] = executeQuery($query);

    return $result;
}

function getManagerBunker($bunkerName){
    $strSep = '\'';

    $query = "SELECT fkResponsable FROM abris WHERE nom =".$strSep.$bunkerName.$strSep;
    $return = executeQuery($query);
    $query = '';

    $query = "SELECT `idUtilisateur`, `nom`, `prenom`, `mail` FROM `utilisateurs`";

    $managers = executeQuery($query);

    $i = 0;
    foreach ($return as $bunker){
        foreach ($managers as $manager){
            if ($manager['idUtilisateur'] == $bunker['fkResponsable']){
                $return[$i]['fkResponsable'] = $manager;
            }
        }

        $i ++;
    }

    return $return;
}

function getManagerID($managerName){
    $strSep = '\'';

    $query = "SELECT `idUtilisateur` FROM `utilisateurs` WHERE `mail`=".$strSep.$managerName.$strSep;

    return executeQuery($query);
}

function getBunkerID($bunkerName){
    $strSep = '\'';

    $query = "SELECT `idAbris` FROM `abris` WHERE `nom`=".$strSep.$bunkerName.$strSep;

    return executeQuery($query);
}

function getInformationStats(){
    //Query used to select count of bunker by region
    $query = "SELECT communes.region, COUNT(idAbris) AS countRegion FROM abris INNER JOIN communes WHERE fkCommune = idCommune GROUP BY communes.region";
    $countBunkerRegion = executeQuery($query);
    $countMax = 0;
    foreach ($countBunkerRegion as $a){
        $countMax+=$a['countRegion'];
    }
    $i=0;
    $lastOne = array_pop($countBunkerRegion);
    $lastOne['countRegion'] = 100;
    foreach ($countBunkerRegion as $regionCounter){
        $countBunkerRegion[$i]['countRegion'] = round((($regionCounter['countRegion']/$countMax)*100), 2);
        $lastOne['countRegion'] -= round((($regionCounter['countRegion']/$countMax)*100), 2);
        $i++;
    }
    array_push($countBunkerRegion, $lastOne);

    //Query used to select count of visit by region
    $query = "SELECT region, COUNT(idAbris) AS countVisit FROM abris INNER JOIN visite ON abris.idAbris = visite.fkAbris INNER JOIN communes ON abris.fkCommune = communes.idCommune WHERE visite.type = 0 GROUP BY communes.region";
    $countVisitRegion = executeQuery($query);
    $countMax = 0;
    foreach ($countVisitRegion as $a){
        $countMax+=$a['countVisit'];
    }
    $i=0;
    $lastOne = array_pop($countVisitRegion);
    $lastOne['countVisit'] = 100;
    foreach ($countVisitRegion as $visitCount){
        $countVisitRegion[$i]['countVisit'] = round((($visitCount['countVisit']/$countMax)*100), 2);
        $lastOne['countVisit'] -= round((($visitCount['countVisit']/$countMax)*100), 2);
        $i++;
    }
    array_push($countVisitRegion, $lastOne);

    //Query used to select count of counter inspection by region
    $query = "SELECT region, COUNT(idAbris) AS countCounterInspection FROM abris INNER JOIN visite ON abris.idAbris = visite.fkAbris INNER JOIN communes ON abris.fkCommune = communes.idCommune WHERE visite.type = 1 GROUP BY communes.region";
    $countCounterInspectionRegion = executeQuery($query);
    $countMax = 0;
    foreach ($countCounterInspectionRegion as $a){
        $countMax+=$a['countCounterInspection'];
    }
    $i=0;
    foreach ($countCounterInspectionRegion as $counterInspectionCount){
        $countCounterInspectionRegion[$i]['countCounterInspection'] = round((($counterInspectionCount['countCounterInspection']/$countMax)*100), 2);
        $i++;
    }

    //Query used to select number of visit, counter inspection and date with region
    $query = "SELECT communes.region, visite.type, visite.dateVisite FROM abris INNER JOIN visite ON abris.idAbris = visite.fkAbris INNER JOIN communes ON abris.fkCommune = communes.idCommune";
    $tableStats = executeQuery($query);

    return array("countBunkerRegion"=>$countBunkerRegion, "countVisitRegion"=>$countVisitRegion, "countCounterInspectionRegion"=>$countCounterInspectionRegion,"tableStats"=>$tableStats);
}