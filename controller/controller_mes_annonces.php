<?php
    /*---------------------------------- IMPORTS ----------------------------------*/
    include './model/model_annonce.php';
    include './manager/manager_annonce.php';
    include './view/view_mes_annonces.html';


    /*---------------------------------- LOGIQUE ----------------------------------*/
    // on vérifie si l'utilisateur est connecter
    if(isset($_SESSION['connecter'])){
        /**
         * Affichage des elements
         */
        // on instancie un nouvel objet managerAnnonce
        $annonce = new ManagerAnnonce();
        // on set l'id_util de l'objet avec l'id de le sessio
        $annonce->setIdUtil($_SESSION['id']);
        // on récupére la liste des annonce se l'utilisateur
        $all = $annonce->findAnnonceByUtil($bdd);
        // si le resultat n'est pas vide
        if($all){
            // traitement pour chaque annonce de la liste
            foreach($all as $one){
                echo
                '<div class="visuel">
                <div class="text">
                <h2 class="titre">'.$one->titre_ann.'</h2>
                <div class="prix"><strong>Prix</strong> : '.$one->prix_ann.'€</div>
                <div class="description">
                    <strong>Déscription</strong> : '.$one->descr_ann.'
                </div>';

                if($one->vendu){
                    echo '<div class="vendu"><strong>Vendu</strong></div>';
                }

                echo 
                '</div>
                <div class="boutons">
                <a class="icon" href="">
                    <img src="https://img.icons8.com/ios/25/null/visible--v1.png"/>
                </a>';

                if(!$one->vendu){
                    echo 
                    '<a class="icon" href="/newlife/modifier-annonce?annonce='.$one->id_ann.'">
                        <img src="https://img.icons8.com/emoji/25/null/fountain-pen-emoji.png"/>
                    </a>';
                }

                echo 
                '<a class="icon" href="/newlife/mes-annonces?delete='.$one->id_ann.'">
                    <img src="https://img.icons8.com/ios-filled/25/null/multiply.png"/>
                </a>
                </div>
                </div>';
            }
        }
        else{
            echo '<h2>Vous n\'avez pas encore ajouter d\'annonce</h2>';
        }
        // fermeture div container
        echo '</div>';


        /**
         * Supprimer une annonce
         */
        if(isset($_GET['delete']) && !empty($_GET['delete'])){
            // on met l'id dans une variable
            $id = $_GET['delete'];
            // on instancie un nouvel objet
            $annonce = new ManagerAnnonce();
            // on set l'id de l'annonce dans l'objet
            $annonce->setIdAnn($id);
            // on supprime l'annonce
            $annonce->setAnnonceToNotVisible($bdd);
            redirect('/newlife/mes-annonces', 0);
            // header('Location:/newlife/mes-annonces');
        }
    }
    else{
        // on redirige vers la page d'accueil
        redirect("/newlife/", 0);
    }
?>