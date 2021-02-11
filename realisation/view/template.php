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
        <link rel="icon" type="image/png" href="../images/favicon-32x32.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <script rel="javascript" src="view/js/jquery.js"></script>
        <link rel="stylesheet" type="text/css" href="view/css/styles.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap-grid.css">
        <link rel="stylesheet" href="view/bootstrap-4.4.1-dist/css/bootstrap-reboot.css">
        <link rel="stylesheet" href="view/css/dashboard.css">
        <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.bundle.js"></script>
        <script rel="javascript" src="view/bootstrap-4.4.1-dist/js/bootstrap.js"></script>
        <script rel="javascript" src="view/js/script.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
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
                <!-- Search form -->
                <div class="w-100 mt-5">
                    <form method="post" action="../index.php?action=research" class="btn-group search-responsive w-100">
                        <input class="form-control form-control-light w-100 rounded-0" style="font-size: 20px" name="inputResearch" type="text" placeholder="Recherche" aria-label="Recherche" <?php if(!isset($_SESSION['sessionTime']) && $_SESSION == null){echo 'disabled'; } ?>>
                    </form>
                </div>
                <hr color="lightgrey" style="height: 1px;" class="w-75">
                <div class="w-100 m-auto text-center pt-1">
                    <?php if ($_GET['action'] == "home"): ?>
                        <a href="index.php?action=home" class="alert-link active color-lightgrey text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Mes VM</a></h5></a>
                    <?php else : ?>
                        <a href="index.php?action=home" class="color-lightgrey text-decoration-none"><h5 class="color-lightgrey">Mes VM</h5></a>
                    <?php endif; ?>
                </div>
                <div class="w-100 m-auto text-center pt-1">
                    <?php if ($_GET['action'] == "form"): ?>
                        <a class="alert-link active color-lightgrey text-decoration-none" href="index.php?action=form"><h5 class="color-lightgrey"><a class="menu-phone-selected">Formulaire</a></h5></a>
                    <?php else : ?>
                        <a class="color-lightgrey text-decoration-none" href="index.php?action=form"><h5 class="color-lightgrey pb-0">Formulaire</h5></a>
                    <?php endif; ?>
                </div>
                <div class="w-100 fixed-bottom d-inline-block" style="bottom: 20px">
                    <div class="float-left w-50 text-decoration-none pl-2">
                        <a href="mailto:helpdesk@heig-vd.ch?subject=Plateforme GVM : [Titre de votre message]">
                            <h5 class="color-lightgrey">Contactez-nous</h5>
                        </a>
                    </div>
                    <div class="float-right w-50 text-decoration-none text-right pr-4">
                        <?php if ($_GET['action'] == "signIn"): ?>
                            <?php if(isset($_SESSION['sessionTime'])): ?>
                                <a href="index.php?action=signOut" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Déconnexion</a></h5></a>
                            <?php else : ?>
                                <a href="index.php?action=signIn" class="alert-link active text-decoration-none"><h5 class="color-lightgrey"><a class="menu-phone-selected">Se connecter</a></h5></a>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if(isset($_SESSION['sessionTime'])): ?>
                                <a href="index.php?action=signOut"><h5 style="color: lightgray">Déconnexion</h5></a>
                            <?php else : ?>
                                <a href="index.php?action=signIn"><h5 style="color: lightgray">Se connecter</h5></a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </nav>
    <!-------------------------- Gabarit desktop  ------------------------------->
        <div class="d-inline-block w-100 fixed-top p-0 shadow" style="background-color: #e30613; height: 48px;">
            <div class="float-left text-center ml-3" style="margin-top: 0.5rem !important;">
                <a class="responsive-phone-hidden text-decoration-none" href="index.php?action=home"><button class="btn"><i class="fa fa-home"></i></button></a>
            </div>
            <div class="float-right text-center mr-3" style="margin-top: 0.9rem !important;">
                <h6><a class="responsive-phone-hidden text-decoration-none" href="index.php?action=signOut" style="color: white;">Déconnexion</a></h6>
            </div>
            <div class="m-auto text-center h-100" style="width: 125px">
                <h4 class="m-auto font-weight-bold text-white" style="margin-top: 0.5rem!important">CPA-CP</h4>
            </div>

        </div>
    <?php endif; ?>
    <main id="main" role="main" class="h-100 w-100 mt-5">
        <?= $contenu; ?>
    </main>
</body>

</html>
