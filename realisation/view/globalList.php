<?php

/**
 * Authors : Pedroletti Michael
 * CreationFile date : 15.02.2021
 * Description File : Page for display of global list of bunker
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script rel="javascript" src="view/js/jquery.js"></script>
    <script rel="javascript" src="view/js/script.js"></script>
    <script rel="javascript" src="view/js/filter.js"></script>
    <script rel="javascript" src="view/js/sortTable.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script>
        function changeUrlInformation(bunkerName, manager){
            var formMailVisit = document.getElementById("formMailVisit");
            var action;
            var statusDisplay = document.getElementById("displayStatus");

            if(statusDisplay.value === "yellow"){
                action = "index.php?action=sendVisitNotice&manager="+manager+"&bunkerName="+bunkerName;
            }
            else if(statusDisplay.value === "red"){
                action = "index.php?action=sendCounterInspectionNotice&manager="+manager+"&bunkerName="+bunkerName;
            }
            else{
                action = "#";
            }

            formMailVisit.action = action;
        }
    </script>
    <meta charset="UTF-8">
    <title>Liste globale des abris - CPA-CP</title>
</head>
<body>
<!-- MODAL SECTION -->
<!-- Messages -->
<?php if (isset($_SESSION['message'])) : ?>
    <div class="modal fade" id="messages" tabindex="-1" role="dialog"
         aria-labelledby="messages" aria-hidden="true">
        <div class="modal-dialog m-auto w-470-px" role="document" style="top: 45%;">
            <div class="modal-content w-100">
                <div class="modal-body">
                    <div class="w-100">
                        <h6 class="float-left pt-2 text-center">
                            <?php if ($_SESSION['message'] == "mailVisitSendingSuccess") {
                                echo 'Succès de l\'envoie de l\'email d\'avis de visite.';
                            } elseif ($_SESSION['message'] == "mailVisitSendingError"){
                                echo 'Erreur lors de l\'envoie de l\'email d\'avis de visite';
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

<!-- Municipality Modal Window -->
<div class="modal fade" id="modalMunicipality" tabindex="-1" role="dialog" aria-labelledby="modalMunicipality"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="w-100 p-3">
                <div class="w-100 float-left p-1">
                    <p>Différents filtres disponibles pour les municipalités</p>
                </div>
                <div class="w-50 float-left p-1">
                    <?php $i=0; foreach($municipality as $value) : ?>
                        <?php if($i%2 != 1): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 2, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                    <?php $i++; endforeach; ?>
                </div>
                <div class="w-50 float-right p-1">
                    <?php $i=0; $value =""; foreach($municipality as $value) : ?>
                        <?php if($i%2): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 2, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                    <?php $i++; endforeach; ?>
                    <button type="button" class="btn btn-primary w-100 h-33" onclick="filterByName('', 2, 'global')">
                        <h5>Toutes</h5>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Region Modal Window -->
<div class="modal fade" id="modalRegion" tabindex="-1" role="dialog" aria-labelledby="modalRegion"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="w-100 p-3">
                <div class="w-100 float-left p-1">
                    <p>Différents filtres disponibles pour les régions</p>
                </div>
                <div class="w-50 float-left p-1">
                    <?php $i=0; foreach($region as $value) : ?>
                        <?php if($i%2 != 1): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 3, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                </div>
                <div class="w-50 float-right p-1">
                    <?php $i=0; $value =""; foreach($region as $value) : ?>
                        <?php if($i%2): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 3, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                    <button type="button" class="btn btn-primary w-100 h-33" onclick="filterByName('', 2, 'global')">
                        <h5>Toutes</h5>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Managers Modal Window -->
<div class="modal fade" id="modalManagers" tabindex="-1" role="dialog" aria-labelledby="modalManagers"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="w-100 p-3">
                <div class="w-100 float-left p-1">
                    <p>Différents filtres disponibles pour les responsables d'abris</p>
                </div>
                <div class="w-50 float-left p-1">
                    <?php $i=0; foreach($managers as $value) : ?>
                        <?php if($i%2 != 1): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 5, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                </div>
                <div class="w-50 float-right p-1">
                    <?php $i=0; $value =""; foreach($managers as $value) : ?>
                        <?php if($i%2): ?>
                            <button type="button" class="btn btn-primary w-100 h-33"
                                    onclick="filterByName('<?=$value[0];?>', 5, 'global')">
                                <h5><?=$value[0];?></h5>
                            </button>
                        <?php endif; ?>
                        <?php $i++; endforeach; ?>
                    <button type="button" class="btn btn-primary w-100 h-33" onclick="filterByName('', 2, 'global')">
                        <h5>Tous</h5>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Mail Modal Window -->
<div class="modal fade" id="modalMail" tabindex="-1" role="dialog" aria-labelledby="modalMail"
     aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="w-100 p-3">
                <div class="w-100 float-left p-1">
                    <p>Envoi de l'email pour l'abris : </p><a id="mailBunkerName"></a>
                </div>
                <div class="w-100 float-left p-1">
                    <form action="#" id="formMailVisit" method="post">
                        <div class="w-100 float-left p-1 mt2">
                            <label for="inputDateVisitMail" class="font-weight-bold form form float-left mr-2">Veuillez sélectionner la date et l'heure à laquel vous souhaitez procéder à la visite de l'abris <a style="color: red"> *</a></label>
                        </div>
                        <div class="w-100 float-left p-1 mt2">
                            <input type="datetime-local" class="form-control form form w-100 float-left" id="inputDateVisitMail" name="inputDateVisitMail" required value="<?= date('Y-m-d').'T'.date('H:i'); ?>">
                        </div>
                        <div class="w-100 float-left mt-3">
                            <!--Cancel-->
                            <button type="reset" id="resetButton" class='btn btn-danger mt-2 mb-3' data-dismiss="modal">Annuler</button>

                            <!--Submit-->
                            <button type='submit' id='submitButton' class='btn btn-primary mt-2 mb-3'>Envoyer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





<div class="container-fluid pt-3">
    <div class="text-center pb-3">
        <h1>Liste globale des abris</h1>
    </div>

    <div class="table-responsive-xl">
        <div class="d-inline-block w-100">
            <div class="form-group float-left mt-3 mb-3" style="width: 88%;">
                <table class="table table-hover allVM" id="globalListTable">
                    <thead class="thead-dark sticky-top">
                    <tr>
                        <th scope="col">Statut</th>
                        <th scope="col" onclick="sortTable(1, 'global')">Nom
                            <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" id="1_none_all">
                                <path fill-rule="evenodd"
                                      d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>
                            <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_up_all">
                                <path fill-rule="evenodd"
                                      d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                            <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="1_down_all">
                                <path fill-rule="evenodd"
                                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </th> <!-- Nom -->
                        <th scope="col" onclick="sortTable(2, 'global')">Commune
                            <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" id="2_none_all">
                                <path fill-rule="evenodd"
                                      d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>
                            <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_up_all">
                                <path fill-rule="evenodd"
                                      d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                            <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="2_down_all">
                                <path fill-rule="evenodd"
                                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                                 viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                                 data-target="#modalMunicipality">
                                <path fill-rule="evenodd"
                                      d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </th> <!-- Communes -->
                        <th scope="col" onclick="sortTable(3, 'global')">Région
                            <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" id="3_none_all">
                                <path fill-rule="evenodd"
                                      d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>
                            <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="3_up_all">
                                <path fill-rule="evenodd"
                                      d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                            <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="3_down_all">
                                <path fill-rule="evenodd"
                                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                                 viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                                 data-target="#modalRegion">
                                <path fill-rule="evenodd"
                                      d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </th> <!-- Région -->
                        <th scope="col" onclick="sortNumberTable(4, 'global')">Places disponibles
                            <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" id="4_none_all">
                                <path fill-rule="evenodd"
                                      d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>
                            <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_up_all">
                                <path fill-rule="evenodd"
                                      d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                            <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="4_down_all">
                                <path fill-rule="evenodd"
                                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                        </th> <!-- Places disponibles-->
                        <th scope="col" onclick="sortTable(5, 'global')">Responsable
                            <svg class="bi bi-chevron-expand" width="18" height="18" viewBox="0 0 16 16" fill="currentColor"
                                 xmlns="http://www.w3.org/2000/svg" id="5_none_all">
                                <path fill-rule="evenodd"
                                      d="M3.646 9.146a.5.5 0 0 1 .708 0L8 12.793l3.646-3.647a.5.5 0 0 1 .708.708l-4 4a.5.5 0 0 1-.708 0l-4-4a.5.5 0 0 1 0-.708zm0-2.292a.5.5 0 0 0 .708 0L8 3.207l3.646 3.647a.5.5 0 0 0 .708-.708l-4-4a.5.5 0 0 0-.708 0l-4 4a.5.5 0 0 0 0 .708z"/>
                            </svg>
                            <svg class="bi bi-chevron-up" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="5_up_all">
                                <path fill-rule="evenodd"
                                      d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z"/>
                            </svg>
                            <svg class="bi bi-chevron-down" style="display: none;" width="18" height="18" viewBox="0 0 16 16"
                                 fill="currentColor" xmlns="http://www.w3.org/2000/svg" id="5_down_all">
                                <path fill-rule="evenodd"
                                      d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z"/>
                            </svg>
                            <svg type="button" class="bi bi-justify float-right mt-1" width="1em" height="1em"
                                 viewBox="0 0 10 10" fill="currentColor" xmlns="http://www.w3.org/2000/svg" data-toggle="modal"
                                 data-target="#modalManagers">
                                <path fill-rule="evenodd"
                                      d="M2 12.5a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5zm0-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z"
                                      clip-rule="evenodd"/>
                            </svg>
                        </th> <!-- Responsable -->
                        <th scope="col" hidden class="emailGloablListClass">E-mail</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($informationBunkers as $value):
                        if ($value['statutVisite'] != null) :
                            ?>
                            <tr>
                                <td style="width: 100px; background-color: <?php
                                switch($value['statutVisite']){
                                    case 0 :
                                        echo "orange";
                                        break;
                                    case 1 :
                                        echo "darkred";
                                        break;
                                    case 2 :
                                        echo "green";
                                        break;
                                    case 4 :
                                        echo "red";
                                        break;
                                    case 3 :
                                    default :
                                        echo "yellow";
                                        break;
                                }
                                ?>"></td>
                                <td><?php echo $value['nom']?></td>
                                <td><?php echo $value['fkCommune']?></td>
                                <td><?php echo $value['region']?></td>
                                <td><?php echo $value['placesDisponibles']?></td>
                                <td><?php echo $value['fkResponsable']['nom']." ".$value['fkResponsable']['prenom']; ?></td>
                                <td hidden class="emailGloablListClass"><button type="button" class="btn btn-secondary btn-sm" onclick='changeUrlInformation("<?= $value['nom'];?>", "<?= $value['fkResponsable']['mail'];?>");' data-toggle="modal" data-target="#modalMail">Envoyer</button></td>
                            </tr>
                        <?php
                        endif;
                    endforeach;
                    ?>
                    </tbody>
                </table>
            </div>

            <div class="form-group float-right text-right w-10 mt-3 mb-3 ">
                <div class="w-100">
                    <!-- Bunker who need a visit -->
                    <a onclick="filterByName('yellow', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerCounterInspectionFilterButton">
                            <span class="badge badge-primary" id="bunkerVisit" style="background-color: yellow"> </span>
                            Abris nécessitant une visite
                        </button>
                    </a>
                    <!-- Bunker who need a visit -->
                    <a onclick="filterByName('orange', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerCounterInspectionFilterButton">
                            <span class="badge badge-primary" style="background-color: orange" id="bunkerVisit"> </span>
                            Abris ayant une visite planifiée
                        </button>
                    </a>
                    <!-- Bunker who need a counter inscpection -->
                    <a onclick="filterByName('red', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerCounterInspectionFilterButton">
                            <span class="badge badge-primary" id="bunkerCounterInspection" style="background-color: red;"> </span>
                            Abris nécessitant une contre visite
                        </button>
                    </a>
                    <!-- Bunker who need a counter inscpection -->
                    <a onclick="filterByName('darkred', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerCounterInspectionFilterButton">
                            <span class="badge badge-primary" id="bunkerCounterInspection" style="background-color: darkred"> </span>
                            Abris ayant une contre visite planifiée
                        </button>
                    </a>
                    <!-- Bunker who is ok -->
                    <a onclick="filterByName('green', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerOkFilterButton">
                            <span class="badge badge-primary" id="bunkerOk" style="background-color: green"> </span>
                            Abris OK
                        </button>
                    </a>
                    <!-- All bunkers -->
                    <a onclick="filterByName('all', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerAllFilterButton">
                            <span class="badge badge-primary" id="bunkerAll"> </span>
                            Tous les abris
                        </button>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<input hidden type="text" value="" id="displayStatus">
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
