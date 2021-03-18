<?php

/**
 * Authors : Pedroletti Michael
 * CreationFile date : 18.02.2021
 * ModifFile date : 18.02.2021
 * Description File : Page to display the form needed to complete the cpa check
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script rel="javascript" src="view/js/jquery.js"></script>
    <script rel="javascript" src="view/js/script.js"></script>
    <script>
        function checkNameField(){
            var selectBunkerName = document.getElementById("selectBunkerName");
            var alertSelectBunkerName = document.getElementById("alertSelectBunkerName");
            var groupInputBunkerName = document.getElementById("groupInputBunkerName");
            var subBtn = document.getElementById("submitButton");
            var resetBtn = document.getElementById("resetButton");

            alertSelectBunkerName.style.display = "none";
            groupInputBunkerName.style.display = "none";

            if(selectBunkerName.value === "Sélectionner un abris"){
                alertSelectBunkerName.style.display = "";
                subBtn.disabled = true;
                subBtn.hidden = true;
                resetBtn.hidden = true;
            }
            else if(selectBunkerName.value === "Autre"){
                subBtn.disabled = false;
                subBtn.hidden = false;
                resetBtn.hidden = false;
                groupInputBunkerName.style.display = "";
                checkInputFieldName();

            }
            else{
                subBtn.disabled = true;
                subBtn.hidden = true;
                resetBtn.hidden = true;
                var actionButton = document.getElementById("actionButton");
                var action = "index.php?action=displayBunkerInformation&bunkerName="+selectBunkerName.value;

                actionButton.href = action;
            }

        }


        function checkInputFieldName(){
            var i = 0;
            var bunkerNames = <?= json_encode($bunkerName); ?>;
            var result = false;
            var inputBunkerName = document.getElementById("inputBunkerName");
            var alertInputBunkerName = document.getElementById("alertBunkerName");
            var subBtn = document.getElementById("submitButton");

            result = false;
            for(i=0; i <= bunkerNames.length; i++){
                if(inputBunkerName.value === bunkerNames[i]){
                    result = true;
                }
            }

            if(inputBunkerName.value === ''){
                result = true;
            }

            if(result){
                alertInputBunkerName.style.display = "";
                subBtn.disabled = true;
            }
            else{
                alertInputBunkerName.style.display = "none";
                subBtn.disabled = false;
            }
        }
    </script>
    <script>
        var i = 1;
        function addIssue(id, idPiece) {
            var issueBlock = document.getElementById(id);


            issueBlock.innerHTML +=
                '   <div class="pr-2 pt-3">'+
                '        <select class="form-control form form w-25 float-left" id="addIssue" name="'+idPiece+'addIssue'+i+'" onchange="">'+
                '           <option>Sélectionner un type de défauts</option>'+
                            <?php
                                foreach ($issueType as $issue){
                                    echo "'<option>".$issue['type']."</option>'+";
                                }
                            ?>
                '        </select>'+
                '    </div>'+
                '    <div class="pl-2 pt-3">'+
                '        <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="'+idPiece+'issueDescription'+i+'" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l\'entrée.">'+
                '    </div>'+
                '    <br>'
            ;
            i++;
        }
    </script>
    <script>
        function chkBoxCheck(){
            const form = document.getElementById("cpaForm");
            const chkBox = form.querySelectorAll("input[type='checkbox']");

            let result = false;

            for(const chk of chkBox){
                if(!chk.checked && !result){
                    result = true;
                }
            }

            if(!result){
                document.getElementById("submitButton").disabled = false;
                document.getElementById("lblChkBoxIssue").hidden = true;
            }
            else{
                document.getElementById("submitButton").disabled = true;
                document.getElementById("lblChkBoxIssue").hidden = false;
            }
        }
    </script>
    <meta charset="UTF-8">
    <title>Formulaire contrôles CPA - CPA-CP</title>
</head>
<body>
    <div class="container-fluid pt-3">
        <div class="text-center">
            <h1>Formulaire contrôles CPA</h1>
        </div>

        <!-- Messages -->
        <?php if (isset($_SESSION['message'])) : ?>
            <div class="modal fade" id="messages" tabindex="-1" role="dialog"
                 aria-labelledby="messages" aria-hidden="true">
                <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
                    <div class="modal-content w-100">
                        <div class="modal-body">
                            <div class="w-100">
                                <h6 class="float-left pt-2 text-center">
                                    <?php if ($_SESSION['message'] == "errorSaveData") {
                                        echo 'Erreur lors du traitement des données avant la sauvegarde vers la base de données, veuillez contacter le support.';
                                    } else {
                                        echo 'Erreur inconnue, veuillez contacter le support.';
                                    } ?>
                                </h6>
                                <button type="submit" class="btn btn-success float-right btn-close-phone" data-dismiss="modal">
                                    Fermer
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>$('.modal').modal('show')</script>
        <?php unset($_SESSION['message']); endif; ?>

        <form method="post" action="index.php?action=saveFormData" id="cpaForm" class="mb-4">
            <!-- Name part of the bunker -->
            <div class="d-inline-block w-50">
                <div class="form-group w-75 float-left pr-4" id="responsiveDisplay">
                    <div class="form-group">
                        <!-- to select an existing bunker -->
                        <label for="selectBunkerName" class="font-weight-bold">Sélectionner l'abris faisant l'objet d'une visite</label>
                        <select class="form-control" id="selectBunkerName" name="selectBunkerName" onchange="checkNameField()">
                            <option>Sélectionner un abris</option>
                            <?php
                            foreach ($bunkerName as $bunker){
                                echo "<option>".$bunker['nom']."</option>";
                            }
                            ?>
                            <option>Autre</option>
                        </select>

                        <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertSelectBunkerName" style="display: none;">
                            <strong>Attention!</strong> Veuillez sélectionner un abris
                        </div>
                    </div>

                    <!-- Button used to load information about a specific bunker -->
                    <a  id="actionButton" href="index.php?action=displayBunkerInformation&bunkerName=" class="btn btn-primary btn-block text-decoration-none form-control form form w-25 float-right">Charger l'abris</a>

                    <!-- to create a new one -->
                    <div class="form-group" id="groupInputBunkerName" style="display: none;">
                        <label for="inputBunkerName" class="font-weight-bold">Nom du nouvel abris<a style="color: #000000"> *</a></label>
                        <input type="text" class="form-control form form" id="inputBunkerName" name="inputBunkerName" aria-describedby="bunkerNameHelp" placeholder="Exemple : Abris21" onkeyup="checkInputFieldName()" value="">
                        <small id="bunkerNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement</small>

                        <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertBunkerName" style="display: none;">
                            <strong>Attention!</strong> Ce nom est déjà utilisé ou ne peut être utilisé. Veuillez en utiliser un autre !
                        </div>
                    </div>
                </div>

            </div>


            <!-- part reserved for room and information about bunker -->
            <?php if(isset($basicsInformation) && isset($roomsInformation) && $basicsInformation !=null && $roomsInformation != null) : ?>
                <div class="d-inline-block w-100 mb-5">
                    <div class="form-group w-25 float-left mt-3" id="informationBunkerName">
                        <label class=font-weight-bold>Nom de l'abris : </label> <?= $basicsInformation[0]['nom']; ?>
                        <input hidden type="text" name="inputInformationBunkerName" value="<?= $basicsInformation[0]['nom']; ?>">
                    </div>
                    <div class="form-group w-25 float-left mt-3" id="informationRegion">
                        <label class=font-weight-bold>Commune : </label> <?= $basicsInformation[0]['fkCommune']; ?>
                        <input hidden type="text" name="inputInformationRegion" value="<?= $basicsInformation[0]['fkCommune']; ?>">
                    </div>
                    <div class="form-group w-25 float-left mt-3" id="informationManager">
                        <label class=font-weight-bold>Responsable : </label> <?= $basicsInformation[0]['fkResponsable']['nom']." ".$basicsInformation[0]['fkResponsable']['prenom']; ?>
                        <input hidden type="text" name="inputInformationManager" value="<?= $basicsInformation[0]['fkResponsable']['mail']; ?>">
                    </div>
                    <div class="form-group w-25 float-left mt-3" id="informationStatus">
                        <label class=font-weight-bold>Statut de la visite : </label> <?php if($basicsInformation[0]['statutVisite']== 0){echo "visite nécessaire";}elseif($basicsInformation[0]['statutVisite'] == 1){echo "contre visite nécessaire";}else{echo "abris OK";} ?>
                        <input hidden type="text" name="inputInformationStatus" value="<?= $basicsInformation[0]['statutVisite']; ?>">
                    </div>

                    <!-- Hidden field to know how many room on the bunker -->
                    <input hidden type="text" class="form-control form form" id="inputNumberOfRoom" name="inputNumberOfRoom" value="<?= count($roomsInformation); ?>">
                </div>

                <div class="d-inline-block w-100 h" id="htmlRoomsSection">
                    <?php $i=1; foreach ($roomsInformation as $roomInformation) : if($i%2) :?>
                        <!-- Left room template information -->
                        <div class="form-group w-50 float-left pr-4 pl-4 mb-0 mt-0 border-right border-bottom border-left <?= ($i == 1) ? "border-top" : "" ?> border-dark" id="responsiveDisplay"> <!-- optimised method for the if -->
                    <?php else: ?>
                        <!-- Right room template information -->
                        <div class="form-group w-50 float-right pr-4 pl-4 mb-0 mt-0 border-bottom border-right border-left <?php if ($i == 2) : echo "border-top"; endif; ?> border-dark" id="responsiveDisplay">
                    <?php endif; ?>
                            <!-- Hidden field use to know the id of the room -->
                            <input hidden type="text" class="form-control form form" id="inputIdRoom" name="inputIdRoom<?= $i ?>" value="<?= $roomInformation['idPiece']; ?>">

                            <!-- Room Name -->
                            <div class="form-group w-50 float-left pr-1 mt-3">
                                <label for="inputRoomName" class="font-weight-bold">Nom de la pièce<a style="color: red"> *</a>:</label>
                                <input readonly type="text" class="form-control form form" id="inputRoomName" name="inputRoomName<?= $roomInformation['idPiece']; ?>" value="<?= $roomInformation['nom']; ?>" aria-describedby="inputRoomNameHelp" required>
                            </div>

                            <!-- Room available seats -->
                            <div class="form-group w-50 float-right pl-1 mt-3">
                                <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                                <input readonly type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats<?= $roomInformation['idPiece']; ?>" value="<?= $roomInformation['placesDisponibles']; ?>"  aria-describedby="inputAvailableSeatsHelp" min="0" max="10000" required>
                            </div>
                            <br>
                            <!-- Room type -->
                            <div class="form-group w-100 float-left pr-1">
                                <label for="inputRoomType" class="font-weight-bold">Types de pièces<a style="color: red"> *</a>:</label>
                                <input readonly type="text" class="form-control form form" id="inputRoomType" name="inputRoomType<?= $roomInformation['idPiece']; ?>" value="<?= $roomInformation['type']; ?>"  aria-describedby="inputRoomTypeHelp" required>
                            </div>

                            <!-- Part reserved for the possible issue we need to check -->
                            <div class="form-group w-100 float-left pr-1">
                                <?php $y = 1; foreach ($roomInformation['availableIssue'] as $issueAvailable) :?>
                                    <div class="form-group w-40 ml-2 <?= ($y%2) ? "float-left pr-1" : "float-right pl-1" ?> mt-3">
                                        <label class="form-check-label" for="<?=$issueAvailable['type'].$issueAvailable['fkDefauts'];?>"><?=$issueAvailable['type'];?></label>
                                        <input onclick="chkBoxCheck();" type="checkbox" class="form-check-input pl-3 ml-3" id="<?=$issueAvailable['type'].$issueAvailable['fkDefauts'];?>">
                                    </div>
                                <?php $y++; endforeach; ?>
                            </div>

                            <?php if(isset($roomInformation['spottedIssue'])) : ?>
                                <!-- Part reserved for counter inspection -->
                                <div class="form-group w-100 float-left pr-1">
                                    <?php $y = 1; foreach ($roomInformation['spottedIssue'] as $issueInformation) : ?>
                                        <div class="form-group w-40 ml-2 <?= ($y%2) ? "float-left pr-1" : "float-right pl-1" ?> mt-3">
                                            <label class="form-check-label"><?= $issueInformation['type']. " " .$issueInformation['globalDescription']. " " .$issueInformation['description']; ?></label>

                                        </div>
                                    <?php $y++; endforeach; ?>
                                </div>
                            <?php endif; ?>

                            <!-- Part reserved for issue -->
                            <div class="form-group w-100 float-left mt-3">
                                <!-- defaults description -->
                                <div class="w-100 d-inline-block">
                                    <div class="pr-2">
                                        <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Défaut(s) présent(s) dans la pièce :</label>
                                    </div>
                                    <div class="pl-2">
                                        <a type="button" onclick="addIssue('issueBlock<?= $roomInformation['idPiece']; ?>', '<?= $roomInformation['idPiece']; ?>')" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un défaut</a>
                                    </div>
                                </div>

                                <!-- defaults information -->
                                <div class="w-100 d-inline-block" id="issueBlock<?= $roomInformation['idPiece']; ?>">
                                    <div class="pr-2 mt-3">
                                        <!-- select a type of issue -->
                                        <select class="form-control form form w-25 float-left" id="addIssue" name="<?= $roomInformation['idPiece']; ?>addIssue0">
                                            <option>Sélectionner un type de défauts</option>
                                            <?php
                                            foreach ($issueType as $issue){
                                                echo "<option>".$issue['type']."</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="pl-2 mt-3">
                                        <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="<?= $roomInformation['idPiece']; ?>issueDescription0" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l\'entrée.">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i++; endforeach; ?>
                </div>
            <?php endif; ?>

            <div class="d-inline-block w-100">
                <!--Submit-->
                <button type='submit' <?php if(!isset($basicsInformation) && !isset($roomsInformation)) : echo "hidden"; endif; ?> id='submitButton' class='btn btn-primary mr-2 mt-3 mb-0' <?php if(isset($basicsInformation) && isset($roomsInformation)) : echo "disabled"; endif; ?>>Envoyer</button>

                <!--Cancel-->
                <button type="reset" <?php if(!isset($basicsInformation) && !isset($roomsInformation)) : echo "hidden"; endif; ?> id="resetButton" class="btn btn-danger mt-3 mb-0">Annuler</button>
            </div>
            <div class="d-inline-block w-100">
                <?php if(isset($basicsInformation) && isset($roomsInformation)) : ?>
                    <label id="lblChkBoxIssue" hidden class="font-weight-bold" style="color: red">Veuillez vérifier tous les points à vérifier de toutes les pièces.</label>
                <?php endif; ?>
            </div>
        </form>
    </div>
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
