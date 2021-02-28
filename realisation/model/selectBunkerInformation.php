<?php
/**
 * Author : Pedroletti Michael
 * Contact : michael@pedroletti.ch
 * Description : This file is used to send specific bunker data to the cpaCheckForm.
 */

//Data that we get from the form
$bunkerName = $_POST['bunkerName'];


//On this part we will get information that we will use after
require_once "selectQuery.php";

$data = getBunkerInformationForm($bunkerName);

//This contains basics information like, name, available seats
$basicBunkerInformation = $data['basicsBunkerInformation'];

//This contains all rooms with their information like, name of room, available seats and type of room
$rooms = $data['basicsRoomsInformation'];

$htmlRoomsSection = "";
$i = 2;
if(count($rooms) != 0) {
    foreach ($rooms as $room){
        if($i%2){
            $htmlRoomsSection .= '
                    <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                        <div class="form-group w-50 float-left pr-1">
                            <label for="inputRoomName" class="font-weight-bold">Nom de la piece<a style="color: red"> *</a>:</label>
                            <input type="text" class="form-control form form" id="inputRoomName" name="inputRoomName" value="'.$room['nom'].'" aria-describedby="inputRoomNameHelp" required>
                        </div>

                    <div class="form-group w-50 float-right pl-1">
                        <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                        <input type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats" value="'.$room['placesDisponibles'].'"  aria-describedby="inputAvailableSeatsHelp" min="1" max="10000" required>
                    </div>
                    <br>

                    <div class="form-group w-100 float-left mt-3">
                        <div class="w-100 d-inline-block">
                            <div class="pr-2">
                                <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Défaut(s) présent(s) dans la pièce :</label>
                            </div>
                            <div class="pl-2">
                                <a onclick="addIssue("issueBlock'.$room['idPiece'].'")" type="button" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un défaut</a>
                            </div>
                        </div>

                        <div class="w-100 d-inline-block" id="issueBlock'.$room['idPiece'].'">
                            <div class="pr-2">
                                <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">
                                    <option>Sélectionner un type de défauts</option>
                                    <?php
                                    foreach ($issueType as $issue){
                                        echo "<option>".$issue[\'type\']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="pl-2">
                                <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l\'entrée.">
                            </div>
                        </div>

                    </div>

                </div>
        ';
        }
        else{
            $htmlRoomsSection .='
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <!-- Room Name -->
                    <div class="form-group w-50 float-left pr-1">

                        <label for="inputRoomName" class="font-weight-bold">Nom de la pièce<a style="color: red"> *</a>:</label>
                        <input type="text" class="form-control form form" id="inputRoomName" name="inputRoomName" value="'.$room['nom'].'" aria-describedby="inputRoomNameHelp" required>
                    </div>

                    <!-- Room available seats -->
                    <div class="form-group w-50 float-right pl-1">
                        <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                        <input type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats" value="'.$room['placesDisponibles'].'"  aria-describedby="inputAvailableSeatsHelp" min="1" max="10000" required>
                    </div>
                    <br>

                    <!-- Part reserved for issue -->
                    <div class="form-group w-100 float-left mt-3">
                        <!-- defaults description -->
                        <div class="w-100 d-inline-block">
                            <div class="pr-2">
                                <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Défaut(s) présent(s) dans la pièce :</label>
                            </div>
                            <div class="pl-2">
                                <a onclick="addIssue("issueBlock'.$room['idPiece'].'")" type="button" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un défaut</a>
                            </div>
                        </div>

                        <!-- defaults information -->
                        <div class="w-100 d-inline-block" id="issueBlock'.$room['idPiece'].'">
                            <div class="pr-2">
                                <!-- select a type of issue -->
                                <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">
                                    <option>Sélectionner un type de défauts</option>
                                    <?php
                                    foreach ($issueType as $issue){
                                        echo "<option>".$issue[\'type\']."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="pl-2">
                                <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l\'entrée.">
                            </div>
                        </div>

                    </div>
                </div>
        ';
        }
        $i++;
    }
}
else{
    $htmlRoomsSection = "Aucune Pièce";
}




$htmlBunkerInformation = "<label class=font-weight-bold>Nom de l'abris : ".$bunkerName;



$htmlBunkerInformation = '
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                        <div class="form-group w-50 float-left pr-1">
                            <label for="inputRoomName" class="font-weight-bold">Nom de la pièce<a style="color: red"> *</a>:</label>
                            <input type="text" class="form-control form form" id="inputRoomName" name="inputRoomName" value="ah" aria-describedby="inputRoomNameHelp" required>
                        </div>

                    <div class="form-group w-50 float-right pl-1">
                        <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                        <input type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats" value="4"  aria-describedby="inputAvailableSeatsHelp" min="1" max="10000" required>
                    </div>
                    <br>

                    <div class="form-group w-100 float-left mt-3">
                        <div class="w-100 d-inline-block">
                            <div class="pr-2">
                                <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Defaut(s) present(s) dans la piece :</label>
                            </div>
                            <div class="pl-2">
                                <a onclick="addIssue(\'issueBlock1\')" type="button" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un defaut</a>
                            </div>
                        </div>

                        <div class="w-100 d-inline-block" id="issueBlock1">
                            <div class="pr-2">
                                <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">
                                    <option>Selectionner un type de défauts</option>
                                </select>
                            </div>
                            <div class="pl-2">
                                <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Probleme avec la prise directement a droite de l\'entree.">
                            </div>
                        </div>

                    </div>

                </div>
        ';



//$data = array("bunkerInformation" => $htmlBunkerInformation); // , "roomSection" => $htmlRoomsSection);

$data = $htmlBunkerInformation;

str_replace("\n", "", $data);

echo json_encode($data);
exit;
?>