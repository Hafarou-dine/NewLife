<?php
    // ouverture de la session
    session_start();

    // import des fonctions utiles
    include './utils/fonctions.php';

    
    /**
     * Import de la connexion à la BDD
     */
    // on vérifie si l'utilisateur est un administrateur
    if(isset($_SESSION['droit']) && $_SESSION['droit'] == 1){
        // on importe le fichier de connexion avec le compte administrateur
        include './utils/connectBDDAdmin.php';
    }
    else{
        // sinon, on importe le fichier de connexion avec le compte utilisateur 
        include './utils/connectBDDUtil.php';
    }
     

    // Analyse de l'URL avec parse_url() et retourne ses composants
    $url = parse_url($_SERVER['REQUEST_URI']);
    // test soit l'url a une route sinon on renvoi à la racine
    $path = isset($url['path']) ? $url['path'] : '/';

    switch($path){
        case '/newlife/connexion':
            // header
            include './view/header_non_connecter.html';
            // controller
            include './controller/controller_connexion.php';
            // footer
            include './view/footer.html';
            break;

        
        case '/newlife/deconnexion':
            include './controller/controller_deconnexion.php';
            break;


        case '/newlife/authentification':
            // header
            include './view/header_non_connecter.html';
            // controller
            include './controller/controller_authentification.php';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/nouveau-mot-de-passe':
            // header
            if(isset($_SESSION['connecter'])){
                include './view/header_connecter.html';
            }
            else{
                include './view/header_non_connecter.html';
            }
            // controller
            include './controller/controller_modifier_mdp.php';
            // footer
            include './view/footer.html';
            break;

        
        case '/newlife/mon-compte':
            // header
            if(isset($_SESSION['connecter'])){
                include './view/header_connecter.html';
            }
            else{
                include './view/header_non_connecter.html';
            }
            // view
            include './view/view_mon_compte.html';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/profil':
            // header
            include './view/header_connecter.html';
            // controller
            include './controller/controller_modifier_profil.php';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/deposer-annonce':
            // header
            include './view/header_connecter.html';
            // controller
            include './controller/controller_deposer_annonce.php';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/modifier-annonce':
            // header
            include './view/header_connecter.html';
            // controller
            include './controller/controller_modifier_annonce.php';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/mes-annonces':
            // header
            include './view/header_connecter.html';
            // controller
            include './controller/controller_mes_annonces.php';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/contacter':
            include './controller/controller_contacter.php';
            break;


        case '/newlife/accueil':
            // header
            if(isset($_SESSION['connecter'])){
                include './view/header_connecter.html';
            }
            else{
                include './view/header_non_connecter.html';
            }
            // controller
            include './view/view_accueil.html';
            // footer
            include './view/footer.html';
            break;


        case '/newlife/':
            // header
            if(isset($_SESSION['connecter'])){
                include './view/header_connecter.html';
            }
            else{
                include './view/header_non_connecter.html';
            }
            // controller
            include './view/view_accueil.html';
            // footer
            include './view/footer.html';
            break;


        default :
            include './view/view_erreur.html';
            break;
        
    }
?>