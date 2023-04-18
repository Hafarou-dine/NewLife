<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_utilisateur.php';
    include './manager/manager_utilisateur.php';
    include './view/view_modifier_mdp.html';

    
    /*---------------------------------- LOGIQUE ----------------------------------*/
    // déclaration des arguments de la fonction ecrireMessage() 
    $msg = "";
    $type = "";

    // on instancie un nouveau ManagerUtilisateur
    $user = new ManagerUtilisateur();

    if(isset($_GET['user']) && !empty(cleanInput($_GET['user']))){
        // on met le token dans une variable
        $token = cleanInput($_GET['user']);
        // on instancie un nouvel objet ManagerUtilisateur
        $util = new ManagerUtilisateur();
        // on set le token à l'objet
        $util->setTokenUtil($token);
        // on recherche un utilisateur associer au token
        $compte = $util->findUtilByToken($bdd);
        // on vérifie si un compte a été trouver
        if($compte){
            // on set l'id du compte à user
            $user->setIdUtil($compte->id_util);
        }
        else{
            // on redirige vers la page d'accueil
            redirect("/newlife/", 0);
        }
    }
    // sinon on vérifie si l'utilisateur est connecter
    else if(isset($_SESSION['connecter'])){
        // on instancie un nouvel objet ManagerUtilisateur
        $util = new ManagerUtilisateur();
        // on set l'id de la session à l'objet
        $util->setIdUtil($_SESSION['id']);            
        // on recherche un utilisateur associer à l'id
        $compte = $util->findUtilById($bdd);
        // on vérifie si un compte a été trouver
        if($compte){
            // on set l'id du compte à user
            $user->setIdUtil($compte->id_util);
        }
        else{
            // on redirige vers la page d'accueil
            redirect("/newlife/", 0);
        }
    }
    else{
        // on redirige vers la page d'accueil
        redirect("/newlife/", 0);
    }

    // on vérifie si l'utilisateur a cliquer sur le bouton 
    if(isset($_POST['change']) && !empty(cleanInput($_POST['new_pwd'])) 
    && !empty(cleanInput($_POST['confirm_new_pwd']))){
        // on met les inputs dans des varibles
        $mdp = cleanInput($_POST['new_pwd']);
        $confirm = cleanInput($_POST['confirm_new_pwd']);
        // on hash le mot de passe
        $hash = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 10));
        // on set le mot de passe hasher à user
        $user->setMdpUtil($hash);
        // on met à jour user
        $user->updatePwdUtil($bdd);
        $msg = "Mot de passe modifier";
        $type = "success";
        // on affiche le message
        echo 
        '<script>
            ecrireMessage("'.$msg.'", "'.$type.'"); 
        </script>';
        // on redirige vers la page d'accueill après 3s
        redirect("/newlife/", 3000);
    }
?>