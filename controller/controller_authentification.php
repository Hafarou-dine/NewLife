<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_utilisateur.php';
    include './manager/manager_utilisateur.php';
    include './utils/infos_smtp.php';
    include './utils/smpt.php';
    include './view/view_authentification.html';


    /*---------------------------------- LOGIQUE ----------------------------------*/
    // on vérifie si l'utilisateur est connecter
    if(isset($_SESSION['connecter'])){
        // on redirige vers la page d'accueil
        redirect("/newlife/", 0);
    }
    else{
        // déclaration des arguments de la fonction ecrireMessage() 
        $msg = "";
        $type = "";
        
        // on verifie si l'utilisateur a cliquer sur le bouton
        if(isset($_POST['compte'])){
            // on recupere le champ en le nettoyant
            $email = cleanInput($_POST['email_util']);
            // on verifie que le mail nettoyer n'est pas vide
            if(!empty($email)){
                // on instancie un nouvel objet ManagerUtilisateur
                $util = new ManagerUtilisateur();
                // on set le mail à l'objet
                $util->setMailUtil($email);
                // on recherche le compte associer a cet email
                $compte = $util->findUtilByMail($bdd);
                // on vérifie si un compte a été trouver
                if($compte){
                    // on instancie un nouvel objet Messagerie
                    $mail = new Messagerie();
                    // on créer l'objet du mail
                    $sujet = "Réinitialisation du mot de passe";
                    // on créer le corp du mail
                    $body = 
                    '<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
                        <h3>Compte NewLife</h3>
                        <section id="corp">
                            <p>
                                Bonjour '.$compte->nom_util.',
                            </p>
                            <p>
                                Il semblerai que vous avez oublier votre mot de passe.
                                Merci de suivre le lien ci-dessous pour réinitialiser votre 
                                mot de passe.
                            </p>
                            <p>
                                <a href="http://localhost/newlife/nouveau-mot-de-passe?user='.$compte->token_util.'">
                                    Lien de réinitialisation
                                </a>
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
                    // on envoie le mail
                    $mail->sendMail($email, $sujet, $body, $smtp_id, $smtp_pwd);
                    $msg = "Un email de réinitialisation du mot de passe vous a été envoyer";
                    $type = "success";
                }
                else{
                    $msg = "Information incorrectes";
                    $type = "warning";
                }
            }else{
                $msg = "Tous les champs doivent être remplis";
                $type = "warning";
            }
            // affichage du message
            echo 
            '<script>
                ecrireMessage("'.$msg.'", "'.$type.'"); 
            </script>';
            // on redirige vers la page de connexion après 3s
            redirect("/newlife/authentification", 3000);
        }
    }
?>