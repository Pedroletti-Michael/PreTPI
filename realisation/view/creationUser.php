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
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
    <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
    <meta charset="UTF-8">
    <title>Page de de création d'utilisateur - CPA-CP</title>
</head>
<body>
    <div>
        <div class="text-center">
            <h1>Création d'utilisateur</h1>
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
                                    <?php if ($_SESSION['message'] == "addUserSuccesses") {
                                        echo 'Succès de l\'ajout de l\'utilisateur à la base de données.';
                                    } else if ($_SESSION['message'] == "addUserFailed") {
                                        echo 'Échec de l\'ajout de l\'utilisateur à la base de données. Veuillez contactez le support.';
                                    } else if ($_SESSION['message'] == "userAlreadyExist"){
                                        echo 'Échec de l\'ajout de l\'utilisateur à la base de données, l\'adresse e-mail est déjà utilisée.';
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

        <div class="text-center">
            <div class="btn-group-vertical" role="group">
                <form action="index.php?action=userCreation" method="post">

                    <!-- lastname -->
                    <div class="form-group" id="responsiveDisplay">
                        <label for="lastname" class="font-weight-bold">Nom de l'utilisateur<a style="color: red">*</a></label>
                        <input type="text" class="form-control form" id="lastname" name="lastname" aria-describedby="lastnameHelp" placeholder="Ex: Bergdorf" required>
                        <small id="lastnameHelp" class="form-text text-muted">Nom de famille de l'utilisateur.</small>
                    </div>

                    <!-- firstname -->
                    <div class="form-group" id="responsiveDisplay">
                        <label for="firstname" class="font-weight-bold">Prénom de l'utilisateur<a style="color: red">*</a></label>
                        <input type="text" class="form-control form" id="firstname" name="firstname" aria-describedby="firstnameHelp" placeholder="Ex: Jean" required>
                        <small id="firstnameHelp" class="form-text text-muted">Prénom de l'utilisateur</small>
                    </div>

                    <!-- mail -->
                    <div class="form-group" id="responsiveDisplay">
                        <label for="mail" class="font-weight-bold">E-mail de l'utilisateur<a style="color: red">*</a></label>
                        <input type="email" class="form-control form text-lowercase" id="mail" name="mail" aria-describedby="mailHelp" placeholder="Ex: jean.bergdorf@gmail.com" required>
                        <small id="mailHelp" class="form-text text-muted">E-mail que l'utilisateur utilise.</small>
                    </div>

                    <!-- password -->
                    <div class="form-group" id="responsiveDisplay">
                        <label for="password" class="font-weight-bold">Mot de passe<a style="color: red">*</a></label>
                        <input type="password" class="form-control form" id="password" name="password" aria-describedby="passwordHelp" required>
                        <small id="passwordHelp" class="form-text text-muted">Nous vous conseillons de mettre en mot de passe complexe, minimum 12 caractères, avec majuscules, minuscules, chiffres et caractères scpéciaux</small>
                    </div>

                    <!-- submit -->
                    <button type='submit' class='btn btn-primary'>Enregistrer</button>
                    <!-- cancel -->
                    <button type="reset" style="margin-bottom: 10px;" class="btn btn-danger">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</body>

<?php

$contenu = ob_get_clean();
require "template.php";

?>
