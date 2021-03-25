<?php

/**
 * Author : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * ModifFile date : 10.02.2021
 **/

ob_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page d'accueil - CPA-CP</title>
    <script rel="javascript" src="view/js/jquery.js"></script>
    <script rel="javascript" src="view/js/jquery-3.6.0.min.js"></script>
    <script rel="javascript" src="view/js/script.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
</head>
<body>
    <div class="container-fluid pt-3 mt-3">
        <div class="text-center mt-3">
            <h1>Page d'accueil</h1>
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
                                    <?php if ($_SESSION['message'] == "successSavingFormDataVisit") {
                                        echo 'Succès lors de la sauvegarde des données du formulaire de visite de l\'abris se nommant : '.$_SESSION['bunkerName'];
                                        unset($_SESSION['bunkerName']);
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
            <script>$('#messages').modal('show')</script>
        <?php unset($_SESSION['message']); endif; ?>

        <div class="text-center">
            <div class="btn-group-vertical" role="group">
                <a href="/?action=displayForm" type="button" class="btn btn-primary btn-block text-decoration-none">Formulaire CPA</a>
                <a href="/?action=displayGlobalList" type="button" class="btn btn-primary btn-block text-decoration-none">Liste globale des abris</a>
                <a href="/?action=displayStats" type="button" class="btn btn-primary btn-block text-decoration-none">Statistiques CPA</a>
                <a href="/?action=displayUser" type="button" class="btn btn-primary btn-block text-decoration-none">Création d'utilisateur</a>
            </div>
        </div>
    </div>


</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
