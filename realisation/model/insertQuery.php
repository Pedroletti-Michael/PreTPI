<?php
/**
 * Author : Pedroletti Michael
 * Contact : michael@pedroletti.ch
 * Creation Date : 5.03.21
 * Description File : I'm gonna stock all insert query that i need for the CPA Web Platform Project.
 */
require_once 'dbConnector.php';

/**
 * Function used to save data from the visit form
 */
function saveVisitData($dataToSave){
    require_once 'selectQuery.php';
    $numberOfRoom = $dataToSave['inputNumberOfRoom'];
    $strSep = '"';
    $return = 45;
    $idVisit = $dataToSave['visitID'];

    for($i=1; $i < $numberOfRoom+1; $i++){
        $roomId = $dataToSave['inputIdRoom'.$i];

        //Check if any new issue is added
        if(isset($dataToSave[$roomId.'countOfNewIssue']) && $dataToSave[$roomId.'countOfNewIssue'] != 0){
            $countNewIssue = $dataToSave[$roomId.'countOfNewIssue'];
            for ($y=0;$y<$countNewIssue;$y++){
                $desc = $dataToSave[$roomId.'issueDescription'.($y+1)];
                $defaultID= getIDDefault($dataToSave[$roomId.'addIssue'.($y+1)])[0]['idDefauts'];
                //Save new issue into db
                $query = "INSERT INTO `pieces_defauts`(`fkPieces`, `fkDefauts`, `fkVisite`, `description`) VALUES (".$roomId.",".$defaultID.",".$idVisit.",".$strSep.$desc.$strSep.")";
                var_dump($query);
                executeQuery($query);
            }
        }

        if(isset($dataToSave[$roomId.'numberOfIssue'])){
            $numberOfSpottedIssue = $dataToSave[$roomId.'numberOfIssue'];
            for($y = 1; $y < $numberOfSpottedIssue+1; $y++){
                //Test if the checkbox is on
                if(isset($dataToSave[$roomId.'spottedIssue'.$y])){
                    //if the checkbox is on that say that the issue is solve, so we change the status of the issue
                    $query = "UPDATE `pieces_defauts` SET `statut`=1 WHERE `idPiecesDefauts`=".$dataToSave[$roomId.'idRoomIssue'.$y];
                    executeQuery($query);
                }
                else{
                    $return = 404;
                }
            }
        }


    }


    //Change status of the visit
    $query = "UPDATE `visite` SET `statutVisite`=0 WHERE `idVisite`=".$idVisit;
    executeQuery($query);
    if($return != 404){
        //Change bunker status on "bunker OK"
        $query = "UPDATE `abris` SET `statutVisite`=2 WHERE `idAbris`=".$dataToSave['inputInformationBunkerID'];
        executeQuery($query);

        $return = "bunkerOK";
    }
    else{
        //Change bunker status on "counter inspection needed"
        $query = "UPDATE `abris` SET `statutVisite`=4 WHERE `idAbris`=".$dataToSave['inputInformationBunkerID'];
        executeQuery($query);

        $return = "counterInspection";
    }

    return $return;
}

/**
 * Function used to save data from the counter inspection form
 */
function saveCounterInspectionData(){

}

/**
 * Function used to save data from the new bunker form
 */
function saveNewBunker(){

}


/**
 * @param $bunkerName : it's the id of the bunker that we want to change the status
 * @param $status : status that we want to update to
 * @return bool : return true or false in function of what we get
 */
function changeBunkerStatus($bunkerName, $status){
    $strSep = '\'';
    $return = true;
    $query = null;

    switch($status){
        case 0:
            $query = "UPDATE `abris` SET `statutVisite`=0 WHERE `nom`=".$strSep.$bunkerName.$strSep;
            break;
        case 1:
            $query = "UPDATE `abris` SET `statutVisite`=1 WHERE `nom`=".$strSep.$bunkerName.$strSep;
            break;
        case 2:
            $query = "UPDATE `abris` SET `statutVisite`=2 WHERE `nom`=".$strSep.$bunkerName.$strSep;
            break;
        case 3:
            $query = "UPDATE `abris` SET `statutVisite`=3 WHERE `nom`=".$strSep.$bunkerName.$strSep;
            break;
        case 4:
            $query = "UPDATE `abris` SET `statutVisite`=4 WHERE `nom`=".$strSep.$bunkerName.$strSep;
            break;
        default:
            $return = false;
            break;
    }

    if($query != null){
        executeQuery($query);
    }

    return $return;
}

/**
 * Function used to save visit information into the DB
 * @param $bunkerName
 * @param $visitDate
 * @param $type
 */
function saveVisitInformation($bunkerName, $visitDate, $type){
    $strSep = '\'';

    //Get ID of Manager who send the notice and the bunker concerned to insert these data into the DB
    $managerID = getManagerID($_SESSION['userEmail']);
    $bunkerID = getBunkerID($bunkerName);

    $query = "INSERT INTO `visite`(`fkExpert`, `fkAbris`, `dateVisite`, `type`) VALUES (".$managerID[0]['idUtilisateur'].",".$bunkerID[0]['idAbris'].",FROM_UNIXTIME(".strtotime($visitDate)."),".$type.")";

    executeQuery($query);
}