<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_utilisateur.php';
    include './manager/manager_utilisateur.php';
    include './view/view_modifier_profil.html';
    

    /*---------------------------------- LOGIQUE ----------------------------------*/
    // on verifie si l'utilisateur est connecter
    if(isset($_SESSION['connecter'])){
        // déclaration des arguments de la fonction ecrireMessage() 
        $msg = "";
        $type = ""; 

        
        // preremplissage des champs
        echo 
        '<script>
            fillFields("'.$_SESSION['nom'].'", "'.$_SESSION['mail'].'");
        </script>';

        /**
         * Partie Modifier compte
         */
        // on vérifie si l'utilisateur a cliquer sur le bouton
        if(isset($_POST['update'])){
            // on met les champs nettoyer dans des variables
            $nom = convertToTitle(cleanInput($_POST['nom_util']));
            $email = cleanInput($_POST['email_util']);
            // on vérifie si les champs nettoyer ne sont pas vide
            if(!empty($nom) && !empty($email)){
                // on instancie un nouvel objet
                $util = new ManagerUtilisateur();
                
                // dans tous les cas ou il faut faire une modification
                // Nom != || Email != || (Nom != && Email !=)
                if($email == $_SESSION['mail'] && $nom != $_SESSION['nom'] || 
                $email != $_SESSION['mail'] && $nom == $_SESSION['nom'] ||
                $email != $_SESSION['mail'] && $nom != $_SESSION['nom']){
                    // on set le mail à l'objet
                    $util->setMailUtil($email);
                    // dans tous les cas ou le mail est différent
                    if($email != $_SESSION['mail']){
                        // on effectue une recherche d'un compte avec ce mail
                        $compte = $util->findUtilByMail($bdd);
                        // si un compte a été trouver
                        if($compte){
                            // on ne modifie pas le mail
                            $util->setMailUtil($_SESSION['mail']);
                        }
                    }
                    // on met à jour le token
                    $token = sha1("name:$nom&&email:$email");
                    // on set les autres attributs à modfier à l'objet
                    $util->setNomUtil($nom);
                    $util->setTokenUtil($token);
                    $util->setIdUtil($_SESSION['id']);
                    // on met à jour l'objet
                    $util->updateUtil($bdd);
                    // on récupère le compte
                    $compte = $util->findUtilById($bdd);
                    // on met à jour les variables de session
                    $_SESSION['nom'] = $compte->nom_util;
                    $_SESSION['mail'] = $compte->mail_util;
                    $_SESSION['token'] = $compte->token_util;
                    // preremplissage des champs avec les modification
                    echo 
                    '<script>
                        fillFields("'.$_SESSION['nom'].'", "'.$_SESSION['mail'].'");
                    </script>';
                    $msg = "Modification du profil réussi";
                    $type = "success";
                }
            }
            else{
                $msg = "Tous les champs doivent être rempli";
                $type = "warning";
            }
            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on refresh la page après 3s
            redirect("/newlife/profil", 3000);
        }


        /**
         * Partie Résilier compte
         */
        if(isset($_POST['delete'])){
            // on instancie un nouveau ManagerUtiisteur
            $util = new ManagerUtilisateur();
            // on set l'id de la session à l'objet
            $util->setIdUtil($_SESSION['id']);
            // on resilie le compte
            $util->resilierUtil($bdd);
            // on redirige vers la page deconnexion
            redirect("/newlife/deconnexion", 0);
        }
    }
    else{
        // on redirige vers la page d'accueil
        redirect("/newlife/", 0);
    }
?>