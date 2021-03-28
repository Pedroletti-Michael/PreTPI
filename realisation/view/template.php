<?php
/**
 * Authors : Pedroletti Michael
 * CreationFile date : 08.02.2021
 * ModifFile date : 10.02.2021
 **/
?>
<!DOCTYPE html>
<html>
    <head>
        <link rel="icon" type="image/png" href="view/images/logo.PNG">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Platforme web dédié pour le contrôle périodique effectué par la protection civile suisse">
        <link rel="stylesheet" type="text/css" href="view/css/styles.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap-grid.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" href="view/css/dashboard.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script rel="javascript" src="view/js/jquery.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script rel="javascript" src="view/js/script.js"></script>
    </head>
<body>
    <?php if (isset($_SESSION['sessionTime'])): ?>

        <div class="d-inline-block w-100 fixed-top p-0 shadow" style="background-color: #e30613; height: 48px;">
            <!-- Home button -->

            <div class="float-left text-center ml-3">
                <a class="responsive-phone-hidden text-decoration-none pt-0 mt-0" data-toggle="dropdown" ><button class="btn"><img class="border-dark border" src="view/images/logo.PNG" style="height: 30px; width: 30px"></button></a>
                <?php if(!isset($notDisplayDropdown)): ?>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/?action=home">Accueil</a></li>
                    <li><a class="dropdown-item" href="/?action=displayForm">Formulaire CPA</a></li>
                    <li><a class="dropdown-item" href="/?action=displayGlobalList">Liste des abris</a></li>
                    <li><a class="dropdown-item" href="/?action=displayStats">Statistiques</a></li>
                    <li><a class="dropdown-item" href="/?action=displayUser">Création d'utilisateur</a></li>
                </ul>
                <?php endif; ?>
            </div>
            <!-- Logout button -->
            <div class="float-right text-center mr-3" style="margin-top: 0.9rem !important;">
                <h6><a class="responsive-phone-hidden text-decoration-none" href="/?action=signOut" style="color: white;">Déconnexion</a></h6>
            </div>
            <!-- Display Username -->
            <div class="float-right text-center mr-3 display-laptop" style="margin-top: 0.9rem !important;">
                <h6>Bonjour, <?= $_SESSION['lastname']." ".$_SESSION['firstname']; ?></h6>
            </div>

            <!-- Title -->
            <div class="m-auto text-center h-100" style="width: 125px">
                <h4 class="m-auto font-weight-bold text-white" style="margin-top: 0.5rem!important">CPA-CP</h4>
            </div>

        </div>
    <?php endif; ?>
    <main id="main" role="main" class="h-100 w-100">
        <?= $contenu; ?>
    </main>
</body>

</html>
