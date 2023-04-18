<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_utilisateur.php';
    include './manager/manager_utilisateur.php';
    include './utils/infos_smtp.php';
    include './utils/smpt.php';
    include './view/view_connexion.html';


    /*---------------------------------- LOGIQUE ----------------------------------*/
    // on verifie si l'utilisateur est connecter
    if(isset($_SESSION['connecter'])){
        // on redirige vers la page principale
        redirect("/newlife/", 0);
    }
    else{
        // déclaration des arguments de la fonction ecrireMessage() 
        $msg = "";
        $type = ""; 

        /**
         * Partie Inscription
         */
        // on vérifie si l'utilisateur a cliquer sur le bouton s'inscrire
        if(isset($_POST['create'])){
            // on met le contenu des champs dans des variables en s'assurant des les avoir nettoyer avant
            $nom = convertToTitle(cleanInput($_POST['nom_user']));
            $email = cleanInput($_POST['email_user']);
            $mdp = cleanInput($_POST['mdp_user']);
            $confirm = cleanInput($_POST['confirm_mdp_user']);
            // on vérifie que les champs nettoyer ne sont pas vide
            if(!empty($nom) && !empty($email) && !empty($mdp) && !empty($confirm)){
                // on verfifie si les deux champs mot de passe sont identique
                if($mdp === $confirm){
                    // on instancie un nouvel objet ManagerUtilisateur
                    $util = new ManagerUtilisateur();
                    // on set le mail saisie à l'objet
                    $util->setMailUtil($email);
                    // on recherche un compte associé à cet email
                    $compte = $util->findUtilByMail($bdd);
                    // si aucun compte correspondant n'a été trouver
                    if(!$compte){
                        // on hash le mot de passe avec l'algorithme de cryptage BYCRYPTE
                        $hash = password_hash($mdp, PASSWORD_BCRYPT, array('cost' => 10));
                        // on créer le token avec l'algorithme de chiffrement sha1
                        $token = sha1("name:$nom&&email:$email");
                        // on set les autres attributs à l'objet
                        $util->setNomUtil($nom);
                        $util->setMdpUtil($hash);
                        $util->setTokenUtil($token);
                        // on ajoute créer l'utilisateur
                        $util->addUtil($bdd);
                        /*---------- Envoie mail de confirmation ----------*/
                        // on instancie un nouvel objet Messagerie
                        $mail = new Messagerie();
                        // sujet du mail
                        $sujet = "Confirmation de votre compte";
                        // corp du mail
                        $body = 
                        '<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
                            <h3>Compte NewLife</h3>
                            <section>
                                <p>
                                    Bonjour '.$nom.',<br>
                                    Merci d’avoir rejoint NewLife. 
                                </p>
                        
                                <p>
                                    Nous aimerions vous confirmer que votre compte a été créé avec succès. 
                                    Pour accéder au portail client, cliquez sur le lien ci-dessous.
                                </p>
                        
                                <p>
                                    <a href="http://localhost/newlife/connexion?user='.$token.'">Lien de confirmation</a>
                                </p>
                                
                                <p>
                                    Si vous rencontrez des difficultés pour vous connecter à votre compte, 
                                    contactez-nous à '.$smtp_id.'.
                                </p>

                                <p>
                                    Cordialement,<br>
                                    L’équipe de NewLife
                                </p>
                            </section>
                        </body>';
                        // on envoie le message
                        $mail->sendMail($email, $sujet, $body, $smtp_id, $smtp_pwd);
                        $msg = "Merci d'avoir rejoint NewLife. 
                        Un mail de confirmation vous a été envoyer";
                        $type = "success";
                    }
                    else{
                        $msg = "Informations incorrectes";
                        $type = "warning";
                    }  
                }

                else{
                    $msg = "Les deux mots de passe doivent être identique";
                    $type = "warning";
                }
            }
            else{
                $msg = "Tous les champs doivent être remplis";
                $type = "warning";
            }
            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on refresh la page après 3s
            redirect("/newlife/connexion", 3000);
        }

        /**
         * Partie Vérification     
         */
        // on verifie si le token est définie et non vide
        if(isset($_GET['user']) && !empty(cleanInput($_GET['user']))){
            // on met le token dans une variable
            $token = cleanInput($_GET['user']);
            // on instancie un nouvel objet ManagerUtlisateur
            $util = new ManagerUtilisateur();
            // on set le token à l'objet
            $util->setTokenUtil($token);
            // on recherche le compte associer au token
            $compte = $util->findUtilByToken($bdd);
            // on vérifie si un compte a été trouver
            if($compte){
                // on vérifie si le compte n'a pas déjà été vérifier
                if(!$compte->valide_util){
                    // on verifie le compte
                    $util->checkMailUtil($bdd);
                    $msg = "Merci d'avoir vérifier votre compte, vous pouvez vous connecter à présent";
                    $type = "success";
                }
                else{
                    $msg = "Votre a déjà été vérifier, vous pouvez vous connecter";
                    $type = "success";
                    // on redirige vers la page de connexion
                    redirect("/newlife/connexion", 3000);
                }
            }
            else{
                // on redirige vers la page de connexion
                redirect("/newlife/connexion", 0);
            } 
            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on refresh la page après 3s
            redirect("/newlife/connexion", 3000);
        }


        /**
         * Partie Connexion
         */
        // on vérifie si l'utilisateur a cliquer sur le bouton se connecter
        if(isset($_POST['connect'])){
            // on met le contenu des champs dans des variables en s'assurant de les avoir nettoyer avant
            $email = cleanInput($_POST['email_util']);
            $mdp = cleanInput($_POST['mdp_util']);
            // on vérifier si les champs nettoyer ne sont pas vide
            if(!empty($email) && !empty($mdp)){
                // on instancie un nouvel objet ManagerUtilisateur
                $util = new ManagerUtilisateur();
                // on set le mail saisie dans l'objet
                $util->setMailUtil($email);
                // on recherche le compte associe au mail saisie par l'utilisateur
                $compte = $util->findUtilByMail($bdd);
                // on vérifie si la recherche a renvoyer un résultat non vide
                if($compte){
                    // on vérifie si le compte été vérifier
                    if($compte->valide_util){
                        // on verfie la correspondance des mot de passes avec password_verify
                        if(password_verify($mdp, $compte->mdp_util)){
                            // creer les variables de session avec les attributs de $compte
                            $_SESSION['id'] = $compte->id_util;
                            $_SESSION['nom'] = $compte->nom_util;
                            $_SESSION['mail'] = $compte->mail_util;
                            $_SESSION['token'] = $compte->token_util;
                            $_SESSION['droit'] = $compte->id_droit;
                            $_SESSION['connecter'] = true;
                            // on redirige vers la page d'accueil
                            redirect("/newlife/accueil", 0);
                        }
                        else{
                            $msg = "Informations incorrectes";
                            $type = "warning";
                        }
                    }
                    else{
                        $msg = "Un mail de confirmation vous a été envoyer. 
                        Veuillez confirmer votre compte pour pouvoir vous connecter";
                        $type = "success";
                    }
                }
                else{
                    $msg = "Informations incorrectes";
                    $type = "warning";
                }
            }
            else{
                $msg = "Tous les champs doivent être remplis";
                $type = "warning";
            }

            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on refresh la page après 3s
            redirect("/newlife/connexion", 3000);

        }
    }
?>