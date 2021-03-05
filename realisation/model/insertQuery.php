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
    $numberOfRoom = $dataToSave['inputNumberOfRoom'];
    $strSep = '\'';
    $return = 45;

    for($i=1; $i < $numberOfRoom+1; $i++){
        $roomId = $dataToSave['inputIdRoom'.$i];
        $roomName = $dataToSave['inputRoomName'.$roomId];
        $availableSeats = $dataToSave['inputAvailableSeats'.$roomId];
        $roomType = $dataToSave['inputRoomType'.$roomId];

        $query = "UPDATE `pieces` SET `nom`=".$strSep.$roomName.$strSep.",`placesDisponibles`=".$availableSeats.",`type`=".$strSep.$roomType.$strSep." WHERE `idPiece`=".$roomId;


        executeQuery($query);
        $return = $query;
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