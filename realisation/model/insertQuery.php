<?php
/**
 * Author : Pedroletti Michael
 * Contact : michael@pedroletti.ch
 * Creation Date : 5.03.21
 * Description File : I'm gonna stock all insert query that i need for the CPA Web Platform Project.
 */

/**
 * Function used to save data from the visit form
 */
function saveVisitData($dataToSave){
    $numberOfRoom = $dataToSave['inputNumberOfRoom'];

    for($i=1; $i == 5; $i++){
        $roomId = $dataToSave['inputIdRoom'.$i];
        var_dump($roomId);
        $roomName = "";
        $availableSeats = "";
        $roomType = "";

        $issueType = "";
        $issueDescription = "";
    }



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