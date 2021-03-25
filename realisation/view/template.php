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
    <!-------------------------- Gabarit for phones ------------------------------->
        <nav class="display-phone w-100">
            <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom w3-center" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="closePhoneMenu()" id="buttonClose">
                <svg class="bi bi-x m-auto" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
                    <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
                    <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
                </svg>
            </button>
            <button type="button" class="rounded-circle bg-dark m-auto fixed-bottom" style="height: 55px; width: 55px;bottom: 10px!important;" onclick="openPhoneMenu()" id="buttonOpen">
                <svg class="bi bi-filter mt-1" width="40px" height="40px" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg" style="color: lightgray;">
                    <path fill-rule="evenodd" d="M6 10.5a.5.5 0 01.5-.5h3a.5.5 0 010 1h-3a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h7a.5.5 0 010 1h-7a.5.5 0 01-.5-.5zm-2-3a.5.5 0 01.5-.5h11a.5.5 0 010 1h-11a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
                </svg>
            </button>
            <div class="w3-sidebar w3-bar-block w3-card w3-animate-bottom w-100" style="display:none;bottom: 0; z-index: 999" id="phoneMenu">
                <hr color="lightgrey" style="height: 1px;" class="w-75">
                <div class="w-100 m-auto text-center pt-1">
                    <?php if ($_GET['action'] == "home"): ?>
                        <a href="/?action=home" class="alert-link active color-lightgrey text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Accueil</a></h5></a>
                    <?php else : ?>
                        <a href="/?action=home" class="color-lightgrey text-decoration-none"><h5 class="color-lightgrey">Accueil</h5></a>
                    <?php endif; ?>
                </div>
                <div class="w-100 m-auto text-center pt-1">
                    <?php if ($_GET['action'] == "form"): ?>
                        <a class="alert-link active color-lightgrey text-decoration-none" href="/?action=displayForm"><h5 class="color-lightgrey"><a class="menu-phone-selected">Formulaire</a></h5></a>
                    <?php else : ?>
                        <a class="color-lightgrey text-decoration-none" href="/?action=displayForm"><h5 class="color-lightgrey pb-0">Formulaire</h5></a>
                    <?php endif; ?>
                </div>
                <div class="w-100 fixed-bottom d-inline-block" style="bottom: 20px">
                    <div class="float-left w-50 text-decoration-none pl-2">
                        <a href="mailto:helpdesk@test.ch?subject=CPA : [Titre de votre message]">
                            <h5 class="color-lightgrey">Contactez-nous</h5>
                        </a>
                    </div>
                    <div class="float-right w-50 text-decoration-none text-right pr-4">
                        <?php if ($_GET['action'] == "signIn"): ?>
                            <?php if(isset($_SESSION['sessionTime'])): ?>
                                <a href="/?action=signOut" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Déconnexion</a></h5></a>
                            <?php else : ?>
                                <a href="/?action=signIn" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Se connecter</a></h5></a>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if(isset($_SESSION['sessionTime'])): ?>
                                <a href="/?action=signOut"><h5 style="color: lightgray">Déconnexion</h5></a>
                            <?php else : ?>
                                <a href="/?action=signIn"><h5 style="color: lightgray">Se connecter</h5></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    <!-------------------------- Gabarit desktop  ------------------------------->
        <div class="d-inline-block w-100 fixed-top p-0 shadow" style="background-color: #e30613; height: 48px;">
            <!-- Home button -->

            <div class="float-left text-center ml-3">
                <a class="responsive-phone-hidden text-decoration-none pt-0 mt-0" data-toggle="dropdown" ><button class="btn"><img class="border-dark border" src="view/images/logo.PNG" style="height: 30px; width: 30px"></button></a>
                <?php if(!isset($notDisplayDropdown)): ?>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="/?action=home">Accueil</a></li>
                    <li><a class="dropdown-item" href="/?action=displayForm">Formulaire CPA</a></li>
                    <li><a class="dropdown-item" href="/?action=displayGlobalList">Liste des abris</a></li>
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
