<?php

/**
 * Authors : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * ModifFile date : 10.02.2021
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <script rel="javascript" src="view/js/jquery.js"></script>
    <script rel="javascript" src="view/js/script.js"></script>
    <script rel="javascript" src="view/js/searchBox.js"></script>
    <meta charset="UTF-8">
    <title>Page d'accueil - CPA-CP</title>
</head>
<body>
    <div>
        <div class="text-center">
            <h1>Page d'accueil</h1>
        </div>

        <div class="text-center">
            <div class="btn-group-vertical" role="group">
                <a href="#" type="button" class="btn btn-primary btn-block text-decoration-none">Formulaire CPA</a>
                <a href="#" type="button" class="btn btn-primary btn-block text-decoration-none">Liste visites CPA</a>
                <a href="#" type="button" class="btn btn-primary btn-block text-decoration-none">Liste contre-visites CPA</a>
                <a href="#" type="button" class="btn btn-primary btn-block text-decoration-none">Statistiques CPA</a>
            </div>
        </div>
    </div>
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>