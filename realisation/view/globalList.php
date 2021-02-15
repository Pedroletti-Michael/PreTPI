<?php

/**
 * Authors : Pedroletti Michael
 * CreationFile date : 15.02.2021
 * ModifFile date : 15.02.2021
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
<div>
    <div class="text-center">
        <h1>Liste globale des abris</h1>
    </div>

    <div class="table-responsive-xl">
        <table class="table table-hover allVM">
            <thead class="thead-dark sticky-top">
            <tr>
                <th scope="col">Statut</th>
                <th scope="col">Nom</th>
                <th scope="col">Commune</th>
                <th scope="col">Région</th>
                <th scope="col">Places disponibles</th>
                <th scope="col">Responsable</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($renewalVM as $value): //TODO CHANGE VALUE TO WORK
                ?>
                <tr>
                    <td><?php echo $value['name']?></td>
                    <td><?php echo $value['usageType']?></td>
                    <td><?php echo $value['cpu']?></td>
                    <td><?php echo $value['ram']?></td>
                    <td><?php echo $value['disk']?></td>
                    <td><?php echo $value['network']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
</div>
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
