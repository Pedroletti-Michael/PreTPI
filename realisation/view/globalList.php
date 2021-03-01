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
    <meta charset="UTF-8">
    <title>Liste globale des abris - CPA-CP</title>
</head>
<body>
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
        <table class="table table-hover allVM">
            <thead class="thead-dark sticky-top">
            <tr>
                <th scope="col">Statut</th>
                <th scope="col">Nom</th>
                <th scope="col">Commune</th>
                <th scope="col">Places disponibles</th>
                <th scope="col">Responsable</th>
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
</div>
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
