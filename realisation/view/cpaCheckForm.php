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

            alertSelectBunkerName.style.display = "none";
            groupInputBunkerName.style.display = "none";

            if(selectBunkerName.value === "Sélectionner un abris"){
                alertSelectBunkerName.style.display = "";
                subBtn.disabled = true;
            }
            else if(selectBunkerName.value === "Autre"){
                groupInputBunkerName.style.display = "";
                checkInputFieldName();

            }
            else{
                subBtn.disabled = false;
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
        function addIssue() {
            var issueBlock = document.getElementById("issueBlock");

            issueBlock.innerHTML +=
                '   <div class="pr-2 mb-2">'+
                '        <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">'+
                '           <option>Sélectionner un type de défauts</option>'+
                            <?php
                                foreach ($issueType as $issue){
                                    echo "'<option>".$issue."</option>'+";
                                }
                            ?>
                '        </select>'+
                '    </div>'+
                '    <div class="pl-2">'+
                '        <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l\'entrée.">'+
                '    </div>'+
                '    <br>'
            ;
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

        <form method="post" action="../index.php?action=RequestVM" class="mb-4">

            <!-- Name part of the bunker -->
            <div class="d-inline-block w-100">
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <div class="form-group">
                        <!-- to select an existinf bunker -->
                        <label for="selectBunkerName" class="font-weight-bold">Sélectionner l'abris faisant l'objet d'une visite</label>
                        <select class="form-control" id="selectBunkerName" name="selectBunkerName" onchange="checkNameField()">
                            <option>Sélectionner un abris</option>
                            <?php
                            foreach ($bunkerName as $bunker){
                                echo "<option>".$bunker."</option>";
                            }
                            ?>
                            <option>Autre</option>
                        </select>

                        <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertSelectBunkerName" style="display: none;">
                            <strong>Attention!</strong> Veuillez sélectionner un abris
                        </div>
                    </div>

                    <!-- to create a new one -->
                    <div class="form-group" id="groupInputBunkerName" style="display: none;">
                        <label for="inputBunkerName" class="font-weight-bold">Nom du nouvel abris<a style="color: #000000"> *</a></label>
                        <input type="bunkerName" class="form-control form form" id="inputBunkerName" name="inputBunkerName" aria-describedby="bunkerNameHelp" placeholder="Exemple : Abris21" required onkeyup="checkInputFieldName()" value="">
                        <small id="bunkerNameHelp" class="form-text text-muted">15 caractères maximum. Lettres, chiffres et trait d'union uniquement</small>

                        <div class="alert alert-warning w-100 align-middle text-center mt-2 mb-0" id="alertBunkerName" style="display: none;">
                            <strong>Attention!</strong> Ce nom est déjà utilisé ou ne peut être utilisé. Veuillez en utiliser un autre !
                        </div>
                    </div>
                </div>
            </div>

            <!-- part reserved for room and information about bunker -->
            <div class="d-inline-block w-100">
                <!-- Bunker name -->
                <div class="form-group w-100 float-left mt-3">
                    <label class="font-weight-bold">Nom de l'abris : <?= /*$selectedBunkerName;*/"test"; ?></label>
                </div>
            </div>
            <div class="d-inline-block w-100">
                <div class="form-group w-50 float-left pr-4" id="responsiveDisplay">
                    <!-- base template -->
                    <div class="form-group w-50 float-left pr-1">
                        <!-- Room Name -->
                        <label for="inputRoomName" class="font-weight-bold">Nom de la pièce<a style="color: red"> *</a>:</label>
                        <input type="text" class="form-control form form" id="inputRoomName" name="inputRoomName" value="Cuisine" aria-describedby="inputRoomNameHelp" required>
                    </div>
                    <div class="form-group w-50 float-right pl-1">
                        <!-- Room available seats -->
                        <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                        <input type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats" value="42"  aria-describedby="inputAvailableSeatsHelp" min="1" max="10000" required>
                    </div>
                    <br>
                    <div class="form-group w-100 float-left mt-3">
                        <!-- defaults description -->
                        <div class="w-100 d-inline-block">
                            <div class="pr-2">
                                <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Défaut(s) présent(s) dans la pièce :</label>
                            </div>
                            <div class="pl-2">
                                <a onclick="addIssue()" type="button" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un défaut</a>
                            </div>
                        </div>

                        <!-- defaults information -->
                        <div class="w-100 d-inline-block" id="issueBlock">
                            <div class="pr-2">
                                <!-- select a type of issue -->
                                <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">
                                    <option>Sélectionner un type de défauts</option>
                                    <?php
                                    foreach ($issueType as $issue){
                                        echo "<option>".$issue."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="pl-2">
                                <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l'entrée.">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group w-50 float-right pl-4" id="responsiveDisplay">
                    <!-- base template -->
                    <div class="form-group w-50 float-left pr-1">
                        <!-- Room Name -->
                        <label for="inputRoomName" class="font-weight-bold">Nom de la pièce<a style="color: red"> *</a>:</label>
                        <input type="text" class="form-control form form" id="inputRoomName" name="inputRoomName" value="Cuisine" aria-describedby="inputRoomNameHelp" required>
                    </div>
                    <div class="form-group w-50 float-right pl-1">
                        <!-- Room available seats -->
                        <label for="inputAvailableSeats" class="font-weight-bold">Places disponibles<a style="color: red"> *</a>:</label>
                        <input type="number" class="form-control form form" id="inputAvailableSeats" name="inputAvailableSeats" value="42"  aria-describedby="inputAvailableSeatsHelp" min="1" max="10000" required>
                    </div>
                    <br>
                    <div class="form-group w-100 float-left mt-3">
                        <!-- defaults description -->
                        <div class="w-100 d-inline-block">
                            <div class="pr-2">
                                <label for="inputDefaults" class="font-weight-bold form form w-25 float-left mr-2">Défaut(s) présent(s) dans la pièce :</label>
                            </div>
                            <div class="pl-2">
                                <a onclick="addIssue()" type="button" class="btn btn-primary btn-block text-decoration-none form-control form form w-75 float-right">Ajouter un défaut</a>
                            </div>
                        </div>

                        <!-- defaults information -->
                        <div class="w-100 d-inline-block" id="issueBlock">
                            <div class="pr-2">
                                <!-- select a type of issue -->
                                <select class="form-control form form w-25 float-left" id="addIssue" name="addIssue" onchange="">
                                    <option>Sélectionner un type de défauts</option>
                                    <?php
                                    foreach ($issueType as $issue){
                                        echo "<option>".$issue."</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="pl-2">
                                <input type="text" class="form-control form form w-75 float-right" id="issueDescription" name="issueDescription" value="" aria-describedby="issueDescriptionHelp" placeholder="Exemple : Problème avec la prise directement a droite de l'entrée.">
                            </div>
                        </div>
                    </div>
                </div>
            </div>




            <!--Submit-->
            <button type='button' id='submitButton' class='btn btn-primary' disabled>Envoyer</button>

            <!--Cancel-->
            <button type="reset" class="btn btn-danger float-right">Annuler</button>
        </form>

    </div>

</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
