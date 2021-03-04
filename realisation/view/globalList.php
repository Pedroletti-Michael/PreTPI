<?php

/**
 * Authors : Pedroletti Michael
 * CreationFile date : 15.02.2021
 * ModifFile date : 18.02.2021
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
    <meta charset="UTF-8">
    <title>Liste globale des abris - CPA-CP</title>
</head>
<body>
<!-- MODAL SECTION -->
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





<div class="container-fluid pt-3">
    <div class="text-center pb-3">
        <h1>Liste globale des abris</h1>
    </div>

    <div class="table-responsive-xl">
        <div class="form-group w-50 float-left mt-3 mb-3">
            <div class="form-group w-33 float-left text-center" style="background-color: yellow; font-size: medium">
                <label class="mr-3" >Visite à faire</label>
            </div>
            <div class="form-group w-33 float-left text-center" style="background-color: red; font-size: medium">
                <label class="mr-3" style="color: white">Contre visite à faire</label>
            </div>
            <div class="form-group w-33 float-left text-center" style="background-color: green; font-size: medium">
                <label class="mr-3" style="color: white">Visite effectuée, abris en ordre</label>
            </div>

        </div>

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
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($informationBunkers as $value):
                        if ($value['statutVisite'] != null) :
                            ?>
                            <tr>
                                <td style="width: 100px; background-color: <?php
                                switch($value['statutVisite']){
                                    case 1 :
                                        echo "red";
                                        break;
                                    case 2 :
                                        echo "green";
                                        break;
                                    case 0 :
                                    default :
                                        echo "yellow";
                                        break;
                                }
                                ?>"></td>
                                <td><?php echo $value['nom']?></td>
                                <td><?php echo $value['fkCommune']?></td>
                                <td><?php echo $value['region']?></td>
                                <td><?php echo $value['placesDisponibles']?></td>
                                <td><?php echo $value['responsable']?></td>
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
                            <span class="badge badge-primary" id="bunkerVisit"> </span>
                            Abris nécessitant une visite
                        </button>
                    </a>
                    <!-- Bunker who need a counter inscpection -->
                    <a onclick="filterByName('red', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerCounterInspectionFilterButton">
                            <span class="badge badge-primary" id="bunkerCounterInspection"> </span>
                            Abris nécessitant une contre visite
                        </button>
                    </a>
                    <!-- Bunker who is ok -->
                    <a onclick="filterByName('green', 0, 'global')">
                        <button type="button" class="btn btn-secondary w-100 rounded-0 mb-0 text-left" id="bunkerOkFilterButton">
                            <span class="badge badge-primary" id="bunkerOk"> </span>
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
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
