<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './utils/infos_smtp.php';
    include './utils/smpt.php';
    include './view/view_contacter.html';


    /*---------------------------------- LOGIQUE ----------------------------------*/
    // déclaration des arguments de la fonction ecrireMessage() 
    $msg = "";
    $type = ""; 


    // on verifie si on a cliquer sur le bouton
    if(isset($_POST['send'])){
        // on met le contenu des champs dans des variables en s'assurant de les avoir nettoyer avant
        $nom  = convertToTitle(cleanInput($_POST['username']));
        $email = cleanInput($_POST['email']);
        $message = cleanInput($_POST['message']);
        // on vérifie si les champs nettoyer ne sont pas vide
        if(!empty($nom) && !empty($email) && !empty($message)){
            // on instancie un nouvel objet Messagerie
            $mail = new Messagerie();
            // on créer le corp du mail
            $body = 
            '<body style="font-family: Arial, Helvetica, sans-serif; font-size: 14px;">
                <h3>Demande de contact</h3>
                <section>
                    <p>
                        Message de : '.$nom.' - '.$email.'
                    </p>
                    <p>
                        '.$message.'
                    </p>
                    <p>
                        Cordialement,<br>
                        '.$nom.'
                    </p>
                </section>
            </body>';
            // on définit l'objet du mail
            $objet = 'Demande de contact';
            // on envoie le mail
            $mail->sendMail($smtp_id, $objet, $body, $smtp_id, $smtp_pwd);
            $msg = "Votre demande de contact a été envoyer";
            $type = "success";
        }
        else{
            $msg = "Tous les champs doivent être remplis";
            $type = "warning";
        }
        echo 
        '<script>
            ecrireMessage("'.$msg.'", "'.$type.'"); 
        </script>';
        // on redirige vers la page d'accueil après 3s
        redirect("/newlife/", 3000);
    }
?>